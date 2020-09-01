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

    public function datos(Request $request)
    {
        if (empty($request->all())) {
            $datos = \App\Rig::first();
            if(empty($datos)) {
                $datos = \App\Rig::create([
                    "texts" => [],
                    "images" => []
                ]);
            }
            $data = [
                "view" => "rig",
                "elements" => $datos,
                "section" => "Datos básicos"
            ];
            return view('home',compact('data'));
        }

        $data = \App\Rig::first();
        $aux = (new Auth\BasicController)->store($request, $data, new \App\Rig, null, true);
        $OBJ = json_decode($aux, true);
        if ($OBJ["error"] == 0) {
            if ($OBJ["success"]) {
                $data->fill($OBJ["data"]);
                $data->save();
            }
        }
        return $aux;
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
            "statements" => \Auth::user()->statements,
            "forms" => \App\Form::orderBy("order")->get(),
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
                "view" => "form",
                "section" => "Formulario"
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

    public function statements(Request $request)
    {
        $dataRequest = $request->all();
        if (empty($dataRequest)) {
            $data = [
                "statements" => \App\Statement::withTrashed()->paginate(),
                "view" => "statements",
                "section" => "Declaraciones"
            ];
            return view('home',compact('data'));
        }
    }

    public function logs(Request $request)
    {
        $dataRequest = $request->all();
        $data = [
            "logs" => \App\Log::paginate(),
            "view" => "logs",
            "section" => "Logs del Sistema"
        ];
        return view('home',compact('data'));
    }
}
