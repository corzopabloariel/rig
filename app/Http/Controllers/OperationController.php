<?php

namespace App\Http\Controllers;

use App\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search))
            $operations = Operation::where("name", "LIKE", "%{$request->search}%")->orderBy("name")->paginate(PAGINATE);
        else
            $operations = Operation::orderBy("name")->paginate(PAGINATE);

        $data = [
            "view" => "element",
            "url_search" => \URL::to(\Auth::user()->redirect() . "/operations"),
            "elements" => $operations,
            "entity" => "operation",
            "placeholder" => "Nombre",
            "section" => "Operaciones"
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
        $data = (new \App\Http\Controllers\Auth\BasicController)->store($request, null, new Operation, null, false, ["code" => (new Operation)->generateCode()]);
        $aux = json_decode($data, true);
        (new \App\Log)->create("operations", $aux["data"]["id"], "Nuevo registro", \Auth::user()->id, "C");
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        return $operation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        return $operation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        (new \App\Log)->create("operations", $operation->id, "Modificación del registro", \Auth::user()->id, "U");
        return (new \App\Http\Controllers\Auth\BasicController)->store($request, $operation, new Operation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        (new \App\Log)->create("operations", $operation->id, "Baja del registro", \Auth::user()->id, "D");
        return (new \App\Http\Controllers\Auth\BasicController)->delete($operation, (new Operation)->getFillable());
    }
}
