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
    public function index()
    {
        $texts = Text::orderBy("code")->paginate(PAGINATE);

        $data = [
            "view" => "element",
            "url_search" => \Auth::user()->redirect() . "/texts",
            "elements" => $texts,
            "entity" => "text",
            "placeholder" => "Código",
            "section" => "Textos"
        ];
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
        (new \App\Log)->create("texts", $aux["data"]["id"], "Nuevo registro", Auth::user()->id, "C");
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
        (new \App\Log)->create("texts", $text->id, "Modificación del registro", Auth::user()->id, "U");
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
        (new \App\Log)->create("texts", $operation->id, "Baja del registro", Auth::user()->id, "D");
        return (new \App\Http\Controllers\Auth\BasicController)->delete($label, (new Label)->getFillable());
    }
}
