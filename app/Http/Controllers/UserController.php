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
        if (isset($request->search)) {
            $s = $request->search;
            $users = User::withTrashed()->where("id", "!=", \Auth::user()->id)->where("profile", "NOT LIKE", "user")
                ->whereRaw("CONCAT_WS(' ', `nombre`) LIKE '%{$request->search}%'")
                ->where("id", "!=", \Auth::user()->id)->where("profile", "NOT LIKE", "user")
                ->orderBy("profile")->orderBy("comitente")->paginate(PAGINATE);
        } else
            $users = User::withTrashed()->where("id", "!=", \Auth::user()->id)->where("profile", "NOT LIKE", "user")->orderBy("profile")->orderBy("comitente")->paginate(PAGINATE);
        $data = [
            "view" => "element.users",
            "url_search" => \URL::to(\Auth::user()->redirect() . "/users"),
            "elements" => $users,
            "entity" => "user",
            "placeholder" => "Nombre completo",
            "section" => "Usuarios"
        ];
        if (isset($request->search))
            $data["search"] = $request->search;
        return view('home',compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request)
    {
        if (isset($request->search)) {
            $s = $request->search;
            $users = User::withTrashed()->where("profile", "LIKE", "user")
                ->whereRaw("CONCAT_WS(' ', `nombre`, `comitente`) LIKE '%{$request->search}%'")
                ->where("profile", "LIKE", "user")
                ->orderBy("profile")->orderBy("comitente")->paginate(PAGINATE);
        } else
            $users = User::withTrashed()->where("profile", "LIKE", "user")->orderBy("comitente")->paginate(PAGINATE);
        $data = [
            "view" => "element.users",
            "url_search" => \URL::to(\Auth::user()->redirect() . "/clients"),
            "elements" => $users,
            "entity" => "client",
            "notForm" => 1,
            "placeholder" => "Nombre completo o comitente",
            "section" => "Clientes"
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
    public function datos()
    {
        $user = \Auth::user();
        $user["emails"] = $user->emails;
        $data = [
            "element" => $user,
            "view" => "element.user",
            "entity" => "user"
        ];
        return view('home',compact('data'));
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
            (new \App\Log)->create("users", $user->id, "Nuevo registro", \Auth::user()->id, "C");
            if ($data) {
                for ($i = 0; $i < count($emails); $i++) {
                    $e = \App\Email::where("email", $emails[$i])->first();
                    if (empty($e))
                        $e = \App\Email::create(["email" => $emails[$i]]);
                    \App\EmailUser::create(["email_id" => $e->id, "user_id" => $user->id]);
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

    public function password(Request $request, User $user)
    {
        \DB::beginTransaction();
        try {
            if (empty($request->pass))
                return json_encode(["error" => 1, "msg" => "La contraseña no puede estar vacia"]);
            $user->fill(["password" => \Hash::make($request->pass)]);
            $user->save();
        } catch (\Throwable $th) {
            \DB::rollback();
            return json_encode(["error" => 1, "msg" => $th->errorInfo[2]]);
        }
        \DB::commit();
        return json_encode(["success" => true, "error" => 0, "msg" => "Contraseña cambiada"]);
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
        (new \App\Log)->create("users", $user->id, "Modificación del registro", \Auth::user()->id, "U");
        \DB::beginTransaction();
        try {
            $data = json_decode($data, true);
            $emails = $data["data"]["emails"];
            unset($data["data"]["emails"]);
            if (empty($data["data"]["password"]))
                $data["data"]["password"] = $user->password;
            $user->fill($data["data"]);
            $user->save();
            \App\EmailUser::where('user_id', $user->id)->delete();
            if ($data) {
                for ($i = 0; $i < count($emails); $i++) {
                    $e = \App\Email::where("email", $emails[$i])->first();
                    if (empty($e))
                        $e = \App\Email::create(["email" => $emails[$i]]);
                    \App\EmailUser::create(["email_id" => $e->id, "user_id" => $user->id]);
                }
            }
        } catch (\Throwable $th) {
            \DB::rollback();
            return json_encode(["error" => 1, "msg" => $th->errorInfo[2]]);
        }
        \DB::commit();
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
        (new \App\Log)->create("users", $user->id, "Baja del registro", \Auth::user()->id, "D");
        return (new \App\Http\Controllers\Auth\BasicController)->delete($user, (new User)->getFillable());
    }
}
