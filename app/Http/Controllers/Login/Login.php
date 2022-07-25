<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Exceptions\InvalidOrderException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view
        if($request->session()->has("login")){
            return redirect(route("dashboard"));
        }

        $departments = Department::all();
        
        return view("login")->with(['departments'=>$departments, 'rte'=>'admin']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * If we change any column in backend and apply isDirty method with coloumn name this method check from database and 
     * return true false.
     * $result = $user->isDirty('username');
     * $user->username = "";
     * $result = $user->isDirty('username');
     */
    public function login(Request $request)
    {
        // Let's session start here...
        $usrName = $request->input("username");
        $pwd = $request->input("password");
        $roll = $request->input("roll");
        
        $user = User::firstWhere(["username"=>$usrName, "password"=>$pwd, "roll"=>$roll]);
        if($user){
            $request->session()->put([
                "userId" => $user->id,
                "name" => $user->name,
                "userName" => $user->username,
                "userEmail" => $user->email,
                "roll" => $user->roll,
                "img" => $user->user_img,
                "login" => "YES"
            ]);
            // dd($request->session()->get('name'));
            return view("dashboard");
        }

        // route() return the controller on route.
        // return redirect(route("login"))->with(["status"=>"Oops! Your login credential invalid..."]);

        // back() return the same page.
        return redirect()->back()->with(["status"=>"Oops! Your login credential invalid..."]);
        // dd($request->session()->get("roll"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
