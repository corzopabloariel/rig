<?php

namespace App\Http\Controllers;

use App\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $help = "<table class='table'>";
            $help .= "<thead>";
                $help .= "<th class='w-25'>Código</th>";
                $help .= "<th class='w-75'>Descripción</th>";
            $help .= "</thead>";
            $help .= "<tbody>";
                $help .= "<tr>";
                    $help .= "<td>EMAIL.STAT</td>";
                    $help .= "<td>Texto enviado al cliente tras dar de alta una declaración.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>USER.ACT</td>";
                    $help .= "<td>Texto de notificación de Usuario con declaración activa.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>EMAIL.HASH</td>";
                    $help .= "<td>Primer texto enviado al cliente.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>TXT.1.LOG</td>";
                    $help .= "<td>Texto que reemplaza el formulario de acceso.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>TXT.LOGIN</td>";
                    $help .= "<td>Texto en formulario inicial.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>TXT.PASS</td>";
                    $help .= "<td>Texto en formulario de establecimiento de contraseña.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>TXT.STA%</td>";
                    $help .= "<td>Textos en la declaración.</td>";
                $help .= "</tr>";
            $help .= "</tbody>";
        $help .= "</table>";
        if (isset($request->search))
            $texts = Text::where("code", "LIKE", "%{$request->search}%")->orderBy("code")->paginate(PAGINATE);
        else
            $texts = Text::orderBy("code")->paginate(PAGINATE);

        $data = [
            "view" => "element",
            "url_search" => \URL::to(\Auth::user()->redirect() . "/texts"),
            "elements" => $texts,
            "entity" => "text",
            "placeholder" => "Código",
            "section" => "Textos",
            "help" => $help
        ];
        if (isset($request->search))
            $data["search"] = $request->search;
        return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (new \App\Http\Controllers\Auth\BasicController)->store($request, null, new Text);
        $aux = json_decode($data, true);
        (new \App\Log)->create("texts", $aux["data"]["id"], "Nuevo registro", \Auth::user()->id, "C");
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Text  $text
     * @return \Illuminate\Http\Response
     */
    public function show(Text $text)
    {
        return $text;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Text  $text
     * @return \Illuminate\Http\Response
     */
    public function edit(Text $text)
    {
        return $text;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Text  $text
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Text $text)
    {
        (new \App\Log)->create("texts", $text->id, "Modificación del registro", \Auth::user()->id, "U");
        return (new \App\Http\Controllers\Auth\BasicController)->store($request, $text, new Text);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Text  $text
     * @return \Illuminate\Http\Response
     */
    public function destroy(Text $text)
    {
        (new \App\Log)->create("texts", $operation->id, "Baja del registro", \Auth::user()->id, "D");
        return (new \App\Http\Controllers\Auth\BasicController)->delete($label, (new Label)->getFillable());
    }
}
