<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
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
                    $help .= "<td>MSSG.SUCCESS</td>";
                    $help .= "<td>Etiqueta OK en declaración.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>LBL.EMAIL.LOGIN</td>";
                    $help .= "<td>Email del login.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>LBL.EMAIL.ACCESS</td>";
                    $help .= "<td>Email del login al panel.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>LBL.PASS.ACCESS</td>";
                    $help .= "<td>Contraseña del login al panel.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>LBL.PASS.LOGIN</td>";
                    $help .= "<td>Contraseña del formulario para establecer contraseña.</td>";
                $help .= "</tr>";
                $help .= "<tr>";
                    $help .= "<td>LBL.ACCEPT</td>";
                    $help .= "<td>Aceptar declaración jurada.</td>";
                $help .= "</tr>";
            $help .= "</tbody>";
        $help .= "</table>";
        if (isset($request->search))
            $labels = Label::where("code", "LIKE", "%{$request->search}%")->orderBy("code")->paginate(PAGINATE);
        else
            $labels = Label::orderBy("code")->paginate(PAGINATE);

        $data = [
            "view" => "element",
            "url_search" => \URL::to(\Auth::user()->redirect() . "/labels"),
            "elements" => $labels,
            "entity" => "label",
            "placeholder" => "Código",
            "section" => "Etiquetas",
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
        return (new \App\Http\Controllers\Auth\BasicController)->store($request, null, new Label);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return $label;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        return $label;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        return (new \App\Http\Controllers\Auth\BasicController)->store($request, $label, new Label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        return (new \App\Http\Controllers\Auth\BasicController)->delete($label, (new Label)->getFillable());
    }
}
