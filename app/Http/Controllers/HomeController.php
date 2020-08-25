<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = ["view" => "home"];
        return view('home',compact('data'));
    }

    public function client()
    {
        $data = [
            "view" => "home",
            "operations" => \App\Operation::orderBy("name")->get(),
            "texts" => \App\Text::where("code", "LIKE", "TXT.STA%")->pluck("data", "code")
        ];
        return view('home',compact('data'));
    }

    public function forms(Request $request)
    {
        $dataRequest = $request->all();
        if (empty($dataRequest)) {
            $data = [
                "forms" => \App\Form::orderBy("order")->get()->toArray(),
                "view" => "form"
            ];
            return view('home',compact('data'));
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::beginTransaction();
        \DB::table('forms')->truncate();
        try {
            for ($i = 0; $i < count($dataRequest["order"]); $i++) {
                if (empty($dataRequest["type"][$i]) || empty($dataRequest["name"][$i]))
                    continue;
                \App\Form::create([
                    "order" => empty($dataRequest["order"][$i]) ? null : $dataRequest["order"][$i],
                    "type" => $dataRequest["type"][$i],
                    "name" => $dataRequest["name"][$i],
                    "required" => isset($dataRequest["required"][$i]) ? 1 : 0
                ]);
            }
        } catch (Exception $e) {
            \DB::rollback();
            return back();
        }
        \DB::commit();
        return back();
    }
}
