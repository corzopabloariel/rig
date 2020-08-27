<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where("id", "!=", \Auth::user()->id)->where("profile", "NOT LIKE", "user")->orderBy("profile")->orderBy("comitente")->paginate(PAGINATE);
        $data = [
            "view" => "element.users",
            "url_search" => \Auth::user()->redirect() . "/users",
            "elements" => $users,
            "entity" => "user",
            "placeholder" => "Nombre completo o Email",
            "section" => "Usuarios"
        ];
        return view('home',compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request)
    {
        $users = User::where("id", "!=", \Auth::user()->id)->where("profile", "LIKE", "user")->orderBy("comitente")->paginate(PAGINATE);
        $data = [
            "view" => "element.users",
            "url_search" => \Auth::user()->redirect() . "/clients",
            "elements" => $users,
            "entity" => "client",
            "notForm" => 1,
            "placeholder" => "Nombre completo, comitente o Email",
            "section" => "Clientes"
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
        $data = (new \App\Http\Controllers\Auth\BasicController)->store($request, null, new User, null, true);
        try {
            $data = json_decode($data, true);
            $emails = $data["data"]["emails"];
            unset($data["data"]["emails"]);
            $user = User::create($data["data"]);
            if ($data) {
                for ($i = 0; $i < count($emails); $i++) {
                    $emails[$i]["user_id"] = $user->id;
                    \App\Email::create($emails[$i]);
                }
            }
        } catch (\Throwable $th) {
            return json_encode(["error" => 1, "msg" => $th->errorInfo[2]]);
        }
        return json_encode(["success" => true, "error" => 0, "data" => $data["data"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user["emails"] = $user->emails;
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user["emails"] = $user->emails;
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = (new \App\Http\Controllers\Auth\BasicController)->store($request, $user, new User, null, true);
        try {
            $data = json_decode($data, true);
            $emails = $data["data"]["emails"];
            unset($data["data"]["emails"]);
            if (empty($data["data"]["password"]))
                $data["data"]["password"] = $user->password;
            $user->fill($data["data"]);
            $user->save();
            \App\Email::where('user_id', $user->id)->delete();
            if ($data) {
                for ($i = 0; $i < count($emails); $i++) {
                    $emails[$i]["user_id"] = $user->id;
                    \App\Email::create($emails[$i]);
                }
            }
        } catch (\Throwable $th) {
            return json_encode(["error" => 1, "msg" => $th->errorInfo[2]]);
        }
        return json_encode(["success" => true, "error" => 0, "data" => $data["data"]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
