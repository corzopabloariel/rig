<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ClientMail;
use App\Mail\NoticeMail;

class FormController extends Controller
{
    public function access(Request $request)
    {
        $requestData = $request->all();
        $privateKey = \App\Rig::first()->captcha["private"];
        $validator = Validator::make($requestData, ["email" => "required|email"]);
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
            $search = self::search($request->email);
            if ($search) {
                $search = explode(";", $search);
                $link = null;
                $user = \App\User::where("comitente", $search[3])->first();
                if (!$user) {
                    $data = [];
                    if (!empty($search[0]))
                        $data["name"] = trim($search[0]);
                    if (!empty($search[1]))
                        $data["lastname"] = trim($search[1]);
                    $data["comitente"] = trim($search[3]);
                    $data["profile"] = "user";
                    $data["password"] = \Hash::make($search[3]);
                    $link = "{$data["password"]}===..//";
                    $user = \App\User::create($data);
                    (new \App\Log)->create("users", $user->id, "Nuevo registro", NULL, "C");
                } else {
                    $data = [];
                    if (!empty($search[0]))
                        $data["name"] = trim($search[0]);
                    if (!empty($search[1]))
                        $data["lastname"] = trim($search[1]);
                    $data["password"] = \Hash::make($search[3]);
                    $link = "{$data["password"]}===..//";
                    $user->fill($data);
                    $user->save();
                    (new \App\Log)->create("users", $user->id, "Modificación del registro", NULL, "U");
                }
                \App\Email::where('user_id', $user->id)->delete();
                $emails = explode("/", $search[2]);
                for ($i = 0; $i < count($emails); $i++) {
                    $e = \App\Email::where("email", $emails[$i])->first();
                    if (empty($e))
                        \App\Email::create(["email" => $emails[$i], "user_id" => $user->id]);
                }
                $emails = $user->emails;
                foreach($emails AS $email) {
                    $txt = textPrint("EMAIL.HASH");
                    $link = \URL::to("/") . "?hash={$link}&email={$email}";
                    $link = "<a target='blank' href='{$link}'>{$link}</a>";
                    $txt = str_replace("EMAIL.HASH", $link, $txt);
                    Mail::to($email)->send( new ClientMail([
                        "hash" => "{$link}.{$email}",
                        "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                        "txt" => $txt,
                        "subject" => "Acceso a R.I.G."
                    ]));
                    (new \App\Log)->create("email", null, "Envio p/ acceso a {$email}", null, "N");
                }
            }
            return json_encode(["error" => 0, "success" => true, "txt" => textPrint("TXT.1.LOG")]);
        }
        //(new \App\Log)->create("email", null, "Baja del registro", null, "N");
    }

    public function search($email) {
        $filename = public_path() . "/_txt/file.txt";
        if (file_exists($filename)) {
            $file = fopen($filename , "r");
            while (!feof($file)) {
                $row = trim(fgets($file));
                if( empty($row))
                    continue;
                if (strpos($row, $email) !== false)
                    return $row;
            }
        }
        return false;
    }
}
