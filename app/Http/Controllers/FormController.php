<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Mail\ClientMail;
use App\Mail\NoticeMail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Validation\Rule;

class FormController extends Controller
{
    public function statements(Request $request) {
        $elements = $request->all();
        $privateKey = \App\Rig::first()->captcha["private"];
        $captcha = $elements["token"];
        unset($elements["token"]);
        if(!$captcha){
            return ["error" => 1 , "mssg" => "Captcha no verificado"];
            exit;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $privateKey, 'response' => $captcha);
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            if (!isset($elements["accept"])) {
                return json_encode(["error" => 1, "mssg" => "Acepte la declaración"]);
            }
            unset($elements["accept"]);
            $forms = \App\Form::orderBy("order")->get();
            $validate = [];
            foreach ($forms AS $form) {
                if ($form->type == "input:number")
                    $validate[$form->name] = "numeric";
                if ($form->type == "input:email")
                    $validate[$form->name] = "email";
                if (!$form->required)
                    continue;
                switch($form->type) {
                    case 'input:text':
                    case 'input:phone':
                    case 'input:check':
                    case 'textarea':
                        $validate[$form->name] = "required";
                    break;
                    case 'input:number':
                        $validate[$form->name] = "required|numeric";
                    break;
                    case 'input:email':
                        $validate[$form->name] = "required|email";
                    break;
                }
            }

            if (isset($elements["data"])) {
                $validator = Validator::make($elements["data"], $validate);
                if ($validator->fails())
                    return json_encode(["error" => 1, "msg" => "Datos inválidos. Verifique y reintente"]);
            }

            $validator = Validator::make($elements, ["operation_id" => "required|exists:operations,id"]);
            if ($validator->fails())
                return json_encode(["error" => 1, "msg" => "Datos inválidos. Verifique y reintente"]);
            if (isset($elements["check"])) {
                for ($i = 0; $i < count($elements["check"]); $i++) {
                    if (isset($elements["data"][$elements["check"][$i]]))
                        $elements["data"][$elements["check"][$i]] = true;
                    else
                        $elements["data"][$elements["check"][$i]] = false;
                }
                unset($elements["check"]);
            }
            unset($elements["_token"]);
            $statement_text = $elements["statement_text"];
            unset($elements["statement_text"]);
            \DB::beginTransaction();
            try {
                $elements["user_id"] = \Auth::user()->id;
                $email = \Auth::user()->emails()->first();
                $elements["data"]["_extras"] = [];
                $elements["data"]["_extras"]["email"] = $email->email;
                $elements["data"]["_extras"]["statement_text"] = $statement_text;
                $statement = \App\Statement::create($elements);
                $txt = textPrint("EMAIL.STAT");// Alta de declaración jurada
                $date = date("d/m/Y H:i:s", strtotime($statement->created_at));
                $add = "";
                $add .= "<p><strong>Fecha de declaración:</strong> {$date}</p>";
                $add .= "<p><strong>Operación:</strong> {$statement->operation->name}</p>";
                if (isset($elements["data"]) && count($elements["data"]) > 1) {
                    $add .= "<table style='margin: auto; width: 450px;'>";
                        $add .= "<thead>";
                            $add .= "<th>Dato</th>";
                            $add .= "<th>Valor</th>";
                        $add .= "</thead>";
                        $add .= "<tbody>";
                        foreach($elements["data"] AS $k => $v) {
                            if ($k == "_extras")
                                continue;
                            $add .= "<tr>";
                                $add .= "<td>{$k}</td>";
                                $add .= "<td>{$v}</td>";
                            $add .= "</tr>";
                        }
                        $add .= "</tbody>";
                    $add .= "</table>";
                }
                if (!empty($elements["obs"]))
                    $add .= "<p><strong>Observaciones:</strong> {$elements["obs"]}</p>";
                try {
                    $pdf = PDF::loadView('pdf/statement', ["data" => $statement_text . "<br/><br/>{$add}"]);
                    Mail::to($email->email)->send(new ClientMail([
                        "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                        "txt" => $txt . $add,
                        "subject" => "Declaración jurada R.I.G."
                    ], $pdf->output()));
                    // ADJUNTAR PDF
                } catch (\Throwable $th) {
                    Mail::to($email->email)->send(new ClientMail([
                        "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                        "txt" => $txt . $add,
                        "subject" => "Declaración jurada R.I.G."
                    ]));
                    Mail::to(NOTICE)->send(new NoticeMail([
                        "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                        "data" => [
                            "err" => $th
                        ]
                    ]));
                }
            } catch (Exception $e) {
                \DB::rollback();
                Mail::to(NOTICE)->send(new NoticeMail([
                    "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                    "data" => [
                        "err" => $th
                    ]
                ]));
                return ["error" => 1 , "mssg" => "Error"];
            }
            \DB::commit();
            (new \App\Log)->create("email", null, "Envio de declaración jurada a {$email}", \Auth::user()->id, "N");
            return json_encode(["error" => 0, "success" => true, "txt" => labelElement("MSSG.SUCCESS")]);
        }
    }

    public function home(Request $request)
    {
        if (!isset($request->hash))
            return view('access');
        else {
            $hash = explode("===..//email=", $request->hash);
            $email = \App\Email::where("email", $hash[1])->first();
            $users = $email->users;
            if ($users->isNotEmpty()) {
                $user = $users->where("tipo", $request->tipo)->first();
                if(\Hash::check(strval($user->comitente), $hash[0])) {
                    // LIMPIO remember_token
                    Session::put('user', $user);
                    Session::put('email', $email);
                    return view('auth.passwords.confirm');
                }
            }
            return redirect("/")->withErrors(['mssg' => "Datos incorrectos o no encontrados"]);
        }
    }

    public function password(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, ["password" => "required"]);
        $user = Session::get('user');
        $email = Session::get('email');
        if ($validator->fails())
            return back()->withErrors(['mssg' => "Ingrese una contraseña válida"]);
        if ($email) {
            $usersEmail = $email->users()->where("users.id", "!=", $user->id)->get();
            if ($usersEmail->isNotEmpty()) {
                foreach($usersEmail AS $userEmail) {
                    if(\Hash::check($request->password, $userEmail->password))
                        return back()->withErrors(['mssg' => "Establezca otra contraseña"]);
                }
            }
        }
        if (Session::get('user')) {
            $email = $user->emails()->first();
            if (empty($email))
                return back()->withErrors(['mssg' => "Ocurrió un error. No tiene emails registrados"]);
            Session::forget('user');
            Session::forget('email');
            $data = [
                "remember_token" => null,
                "password" => \Hash::make($request->password)
            ];
            $user->fill($data);
            $user->save();

            $requestUsuario = new \Illuminate\Http\Request();
            $requestUsuario->setMethod('POST');
            $requestUsuario->request->add(['email' => $email->email, 'password' => $request->password]);
            return (new Auth\LoginController)->login($requestUsuario);
        } else
            return back()->withErrors(['mssg' => "Ocurrió un error"]);
    }

    public function access(Request $request)
    {
        $requestData = $request->all();
        $privateKey = \App\Rig::first()->captcha["private"];
        $validator = Validator::make($requestData, ["tipo" => "required|" . Rule::in(\App\User::$tipo), "email" => "required|email"]);
        if ($validator->fails())
            return json_encode(["error" => 1, "mssg" => "Email no válido."]);
        $captcha = $requestData["token"];
        if(!$captcha){
            return ["error" => 1 , "mssg" => "Captcha no verificado"];
            exit;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $privateKey, 'response' => $captcha);
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            $email = \App\Email::where("email", $request->email)->first();
            if ($email) {
                $usersEmail = $email->users;
                if ($usersEmail->isNotEmpty()) {
                    $userEmail = $usersEmail->where("tipo", $request->tipo)->first();
                    if ($userEmail) {
                        $statement = $userEmail->statements()->orderBy("id", "DESC")->first();
                        if ($statement) {
                            $url = \URL::to('login');
                            $txt = "<p>Última declaración: " . date("d/m/Y H:i:s", strtotime($statement->created_at)) . "</p>";
                            $txt .= textPrint("USER.ACT");
                            $txt = str_replace("__LINK__", "<a class='text-primary' href='{$url}'>LINK</a>", $txt);
                            return ["error" => 0, "success" => false, "txt" => $txt];
                        }
                    }
                }
            }
            $search = self::search(strtolower($request->email), $request->tipo);
            \DB::beginTransaction();
            try {
                /**
                 * 0.TIPO
                 * 1.NUMERO ->comitente
                 * 2.NOMBRE
                 * 3.DOMICILIO
                 * 4.POST
                 * 5.LOCALIDAD
                 * 6.PAIS
                 * 7.TELEFONO
                 * 8.CUIT
                 * 9.DOCU
                 * 10.NUMERO_DOC
                 * 11.FEC_ALTA
                 * 12.E_MAIL
                 * 13.MGER
                 * 14.ULT_MOVI
                 * 15.ESTADO
                 * 16.NACIONALIDAD
                 * 17.FEC_BAJA
                 */
                if ($search) {
                    $search = explode("\t", $search);
                    $search = array_map("self::clear", $search);
                    $link = null;
                    $user = \App\User::where("comitente", $search[1])->where("tipo", $search[0])->first();
                    $data = [];
                    $data["nombre"] = $search[2];
                    $data["comitente"] = $search[1];
                    $data['tipo'] = $search[0];
                    $data['domicilio'] = $search[3];
                    $data['post'] = $search[4];
                    $data['localidad'] = $search[5];
                    $data['pais'] = $search[6];
                    $data['telefono'] = $search[7];
                    $data['cuit'] = $search[8];
                    $data['docu'] = $search[9];
                    $data['numero_doc'] = $search[10];
                    $data["profile"] = "user";
                    $data["password"] = "SIN PASS";
                    $data["remember_token"] = \Hash::make($search[1]);
                    $link = "{$data["remember_token"]}===..//";
                    if (!$user) {
                        $user = \App\User::create($data);
                        (new \App\Log)->create("users", $user->id, "Nuevo registro", NULL, "C");
                    } else {
                        $user->fill($data);
                        $user->save();
                        (new \App\Log)->create("users", $user->id, "Modificación del registro", NULL, "U");
                    }
                    $emails = explode(";", $search[12]);
                    for ($i = 0; $i < count($emails); $i++) {
                        $e = \App\Email::where("email", $emails[$i])->first();
                        if (empty($e))
                            $e = \App\Email::create(["email" => $emails[$i]]);
                        \App\EmailUser::create(["email_id" => $e->id, "user_id" => $user->id]);
                    }
                    $emails = $user->emails;
                    foreach($emails AS $email) {
                        $txt = textPrint("EMAIL.HASH");
                        $linkEmail = \URL::to("/") . "?hash={$link}email={$email->email}&tipo={$search[0]}";
                        $linkEmail = "<a target='blank' href='{$linkEmail}'>{$linkEmail}</a>";
                        $txt = str_replace("EMAIL.HASH", $linkEmail, $txt);
                        Mail::to($email->email)->send( new ClientMail([
                            "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                            "txt" => $txt,
                            "subject" => "Acceso a R.I.G."
                        ]));
                        (new \App\Log)->create("email", null, "Envio p/ acceso a {$email->email}", null, "N");
                    }
                }// else
                    //return json_encode(["error" => 0, "success" => false, "mssg" => "Datos no encontrados"]);
            } catch (Exception $e) {
                \DB::rollback();
                return ["error" => 1 , "mssg" => "Error"];
            }
            \DB::commit();
            return json_encode(["error" => 0, "success" => true, "txt" => textPrint("TXT.1.LOG")]);
        }
        //(new \App\Log)->create("email", null, "Baja del registro", null, "N");
    }

    public function clear($e) {
        $e = trim($e);
        return empty($e) ? null : $e;
    }

    public function search(...$args) {
        $txt = file_get_contents(public_path() . "/_txt/CLIENTE.TXT");
        if (strpos($txt, $args[0]) === false && strpos($txt, $args[1]) === false)
            return false;
        $filename = public_path() . "/_txt/CLIENTE.TXT";
        if (file_exists($filename)) {
            $file = fopen($filename , "r");
            while (!feof($file)) {
                $row = trim(fgets($file));
                if( empty($row))
                    continue;
                if (strpos($row, $args[0]) !== false && strpos($row, $args[1]) !== false)
                    return $row;
            }
        }
        return false;
    }
}
