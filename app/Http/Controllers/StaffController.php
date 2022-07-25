<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import Database Schema.
use Illuminate\Support\Facades\Schema;

// Import Modal.
use App\Models\Staff;
use App\Models\Department;

// Import Validation File. 
use App\Http\Requests\FormValidation;

// Import library for send mail.
use Mail;

class StaffController extends Controller
{
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
        
        $user = Staff::firstWhere(["stf_username"=>$usrName, "stf_pass"=>$pwd, "dept_id"=>$roll]);
        // dd($user['deleted_at']);
        if($user){
            if($user['deleted_at'] == "Yes"){
                return redirect()->back()->with(["status"=>"Your account has been deleted."]);
            }
            $request->session()->put([
                "userId" => $user->id,
                "name" => $user->stf_name,
                "userName" => $user->stf_username,
                "userEmail" => $user->stf_email,
                "roll" => $user->dept_id,
                "img" => $user->stf_img,
                "login" => "YES"
            ]);
            // dd($request->session()->get('img'));
            return view("dashboard");
        }

        // route() return the controller on route.
        // return redirect(route("login"))->with(["status"=>"Oops! Your login credential invalid..."]);

        // back() return the same page.
        return redirect()->back()->with(["status"=>"Oops! Your login credential invalid..."]);
        // dd($request->session()->get("roll"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // This function use for get all data from staff table.
        try {
            /**
               * Fetch all column name from database table.
                *If we want to do this so first import Schmea using this use Illuminate\Support\Facades\Schema;.
            */
            
            $staff = new Staff;
            $table = $staff->getTable();
            $columns = Schema::getColumnListing($table);
            
            // Remove prefix from column name.
            $columns = str_replace("stf_", "", $columns);
            $columns = str_replace("_at", "", $columns);
            
            // Remove fields name from list/table
            $j=0;
            for ($i=0; $i < count($columns); $i++) { 
                if($columns[$i] == "username" || $columns[$i] == "pass" || $columns[$i] == "deleted" || $columns[$i] == "img"){
                    continue;
                }else{
                    $tablCol[$j] = $columns[$i];
                }
                $j++;
            }

            // insert data into array on last position.
            if($i == count($columns)){
                $tablCol[$j] = "department name";
            }

            // fetch data from two table using eloquent model.
            // $datas = Staff::with('department')->get();
            
            // // Fetch all column value form database table. using custome pagination
            // // $datas = Staff::all()->where("deleted_at", "No");
            $datas = ($request->perPage == "") ? Staff::with('department')->where('deleted_at', 'No')->paginate(5) : Staff::with('department')->where('deleted_at', 'No')->paginate($request->perPage);
            // dd($datas);
            
            // dd($datas);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("doctorNew"))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(["status"=>"Data not found.", "url"=>"staffList"]);
        }

        // // checking data is empty or not.
        // if(!count($datas)){
            
        // }
        
        // Fetch data one array and assign in another array.
        foreach ($datas as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->stf_name;
            $values[$key][] = $value->stf_email;
            $values[$key][] = $value->stf_phone;
            $values[$key][] = $value->stf_age;
            $values[$key][] = $value->stf_zip;
            $values[$key][] = $value->stf_city;
            $values[$key][] = $value->stf_block;
            $values[$key][] = $value->stf_district;
            $values[$key][] = $value->stf_region;
            $values[$key][] = $value->stf_state;
            $values[$key][] = $value->stf_contry;
            $values[$key][] = $value->stf_about;
            $values[$key][] = $value->stf_twitter;
            $values[$key][] = $value->stf_facebook;
            $values[$key][] = $value->stf_instagram;
            $values[$key][] = $value->stf_linkedin;
            $values[$key][] = $value->department_id;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
            $values[$key][] = $value->department->dept_name;
        }
        // dd($datas->links());
       return view('staff.list_staff', ['columns'=>$tablCol, 'values'=>$values, 'urls'=>['pageTitle'=>'Staff', 'pageRoute'=>'staffNew', 'edit'=>'staffEdit', 'delete'=>'staffDelete', 'sts'=>'staffStatus', 'paginate'=>'staffList', 'srcName'=>'staffSearch', 'pageLink'=>$datas->links()]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // This function show the form which is use for instert data into database.
        $departments = Department::all();
        return view('staff.new_staff', ['departments'=>$departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(FormValidation $req)
    {  
        // dd($req->all());
        //This function store data in data base.
        // Validation
        $req->validated();
     
        // File upload;
        $fileName = $req->file('image')->getClientOriginalName();
        $uplaodFile = $req->file('image')->storeAs('AllFiles', $fileName);

        // If generate any exception in code so try to handle this.
        try {        
                
            // Create username and password.
            $username = str_replace(' ', '_', $req->name) . '_' . rand(100, 1000);

            // This function create in Helper.
            $password = getRandString();
            
            // Insert data
            $staff = new Staff;

            $staff->stf_name = $req->name;
            $staff->stf_about = $req->about;
            $staff->stf_email = $req->email;
            $staff->stf_username = $username;
            $staff->stf_pass = $password;
            $staff->stf_phone = $req->phone;
            $staff->stf_img = $req->image;
            $staff->stf_age = $req->age;
            $staff->stf_zip = $req->zip;
            $staff->stf_city = $req->city;
            $staff->stf_block = $req->block;
            $staff->stf_district = $req->district;
            $staff->stf_region = $req->region;
            $staff->stf_state = $req->state;
            $staff->stf_contry = $req->contry;
            $staff->stf_twitter = $req->twitter;
            $staff->stf_facebook = $req->facebook;
            $staff->stf_instagram = $req->instagram;
            $staff->stf_linkedin = $req->linkedin;
            $staff->dept_id = $req->department;
            $staff->stf_img = $fileName;
            $staff->save();

            // Send email code here...
            
            /*/**
             * This code will work when some setting do by developer:-
             * 1. .env = MAIL_MAILER=smtp
                            MAIL_HOST=smtp.gmail.com
                            MAIL_PORT=587
                            MAIL_USERNAME=here a email required which will send the mail.
                            MAIL_PASSWORD=here your email password
                            MAIL_ENCRYPTION=tls
                            MAIL_FROM_ADDRESS=MAIL_USERNAME same email here..
                2. second thing: go in your gmail account's setting which is define in MAIL_USERNAME and here
                    Forwarding and POP/IMAP->IMAP access do enable and save changes.
                    Then go in Manage your Google Account->Security and here Less secure app access also enable.
            */

            /*    // Retrive data for sending role with the email.
                $roll = Department::find($req->department);
                
                $data = ['name'=>$req->name,'username'=>$username, 'password'=>$password, 'roll'=>ucwords($roll->dept_name)];
                // dd($data);
                $user['to'] = $req->email;
                Mail::send('emails/sendingMail', $data, function($message) use($user){
                    $message->to($user['to']);
                    $message->subject('Your username and password');
                });
            */

        } catch (\Throwable $th) {
            // return redirect(route("staffNew"))->with(["status"=>$th->getMessage()]);
            return redirect(route("error"))->with(["status"=>"Data is incorrect form.", "url"=>"staffNew"]);
        }

        return redirect(route("staffNew"))->with(["status"=>"New employee is created."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function statusChange($stats=null, $id=null)
    {
        //Change Status.
        try {
            if($stats == 'activate'){
                Staff::where('id', $id)->update(['status'=>'deactivate']);
            }else{
                Staff::where('id', $id)->update(['status'=>'activate']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'staffList']);
        }
        return redirect(route('staffList'))->with(['status'=>'Status change successfully...', 'url'=>'staffList']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id=null)
    {
        //fetch data using id.
        $datas = Staff::find($id);
        // fetch all data.
        // dd($datas);
        $departments = Department::all();
        return view('staff.staffEdit', ['datas'=>$datas, 'departments'=>$departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        //
        //This function store data in data base.
        // Validation
        $request->validate([
            "name"           =>     "required",
            "email"          =>     "required|email",
            "phone"          =>     "required|digits:10",
            "department"     =>     "required",
            "zip"            =>     "required|digits:6",
            "city"           =>     "required",
            "district"       =>     "required",
            "state"          =>     "required",
            "contry"         =>     "required",
        ]);

        $img_name = "";
        if($request->file('image') == ''){
            $img_name = $request->input("hid_image");
        }else{
            $img_name = $request->file('image')->getClientOriginalName();
            $uplaodFile = $request->file('image')->storeAs("AllFiles", $img_name);
        }
        
        // Update data using eloquent method.
        try {
            Staff::where('id', $id)->update(
                [
                    
                    "stf_name"      => $request->name,
                    "stf_about"      => $request->about,
                    "stf_email"     => $request->email,
                    "stf_phone"     => $request->phone,
                    "stf_age"       => $age = ($request->age != "") ? $request->age : $request->hid_age,
                    "stf_zip"       => $request->zip,
                    "stf_city"      => $request->city,
                    "stf_block"     => $request->block,
                    "stf_district"  => $request->district,
                    "stf_region"    => $request->region,
                    "stf_state"     => $request->state,
                    "stf_contry"    => $request->contry,
                    "stf_twitter"    => $request->twitter,
                    "stf_facebook"    => $request->facebook,
                    "stf_instagram"    => $request->instagram,
                    "stf_linkedin"    => $request->linkedin,
                    "stf_img"       => $img_name,
                ]
            );
            return redirect(route("staffEdit", $id))->with('status', "Data updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("staffEdit"))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(['status'=>'Something went wrong please try again...', 'url'=>'staffEdit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id=null)
    {
        // dd($id);
        // Update deleted at.
        try {
            Staff::where('id',$id)->update(['deleted_at'=>'Yes']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'staffList']);
        }
        return redirect(route('staffList'))->with(['status'=>'Employee deleted successfully...', 'url'=>'staffList']);
    }

    public function allDoctors(Request $request, $id = null)
    {
        // dd($request->perPage);
        // This function use for get all data from staff table.
        try {
            /*
                Fetch all column name from database table.
                If we want to do this so first import Schmea using this use Illuminate\Support\Facades\Schema;.
            */
            
            $staff = new Staff;
            $table = $staff->getTable();
            $columns = Schema::getColumnListing($table);
            
            // Remove prefix from column name.
            $columns = str_replace("stf_", "", $columns);
            $columns = str_replace("_at", "", $columns);
            // Remove fields name from list/table
            $j=0;
            for ($i=0; $i < count($columns); $i++) { 
                if($columns[$i] == "username" || $columns[$i] == "pass" || $columns[$i] == "deleted" || $columns[$i] == "img"){
                    continue;
                }else{
                    $tablCol[$j] = $columns[$i];
                }
                $j++;
            }

            // insert data into array on last position.
            if($i == count($columns)){
                $tablCol[$j] = "department name";
            }

            // Fetch all column value form database table. using custome pagination
            // $datas = Staff::where(["dept_id"=>2, "deleted_at"=>"No"])->get();
            $datas = ($request->perPage == "") ? Staff::with('department')->where(["department_id"=>2, "deleted_at"=>"No"])->paginate(5) : Staff::with('department')->where(["department_id"=>2, "deleted_at"=>"No"])->paginate($request->perPage);
                        
            // $datas = Staff::all()->where("dept_id",$id)->where("deleted_at","No");
            // dd($datas);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("docList"))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(["status"=>"Data not found.", "url"=>"staffList"]);
        }

        foreach ($datas as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->stf_name;
            $values[$key][] = $value->stf_email;
            $values[$key][] = $value->stf_phone;
            $values[$key][] = $value->stf_age;
            $values[$key][] = $value->stf_zip;
            $values[$key][] = $value->stf_city;
            $values[$key][] = $value->stf_block;
            $values[$key][] = $value->stf_district;
            $values[$key][] = $value->stf_region;
            $values[$key][] = $value->stf_state;
            $values[$key][] = $value->stf_contry;
            $values[$key][] = $value->stf_about;
            $values[$key][] = $value->stf_twitter;
            $values[$key][] = $value->stf_facebook;
            $values[$key][] = $value->stf_instagram;
            $values[$key][] = $value->stf_linkedin;
            $values[$key][] = $value->department_id;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
            $values[$key][] = $value->department->dept_name;
        }
        $pgnt ='docList';
        // dd($pgnt);
       return view('staff.all_doctor', ['columns'=>$tablCol, 'values'=>$values, 'urls'=>['pageTitle'=>'Staff', 'pageRoute'=>'staffNew', 'edit'=>'staffEdit', 'delete'=>'staffDelete', 'sts'=>'staffStatus', 'paginate'=>$pgnt, 'tableName'=>'Staff', 'columnName'=>"stf_name", 'srcName'=>'staffSearch', 'pageLink'=>$datas->links()]]);
    }

    public function searchRecord(Request $req)
    {
        try {
            $data = json_decode($req->input("data"));
            $records = Staff::where('deleted_at', 'No')->where("stf_name", 'like', '%'.$data->searchText.'%')->paginate(100);
            $urls = [
                'edit'=>'staffEdit', 
                'delete'=>'staffDelete', 
                'sts'=>'staffStatus', 
                'srcName'=>'staffSearch'
            ];
        } catch (\Throwable $th) {
            // throw $th->getMessage();
            return $th->getMessage();
            // return redirect(route("doctorNew"))->with(["status"=>$th->getMessage()]);
        }

        // checking data is empty or not.
        if(!count($records)){
            return response()->json([
                "status" => "false",
            ]); 
        }
        
        // Fetch data one array and assign in another array.
        foreach ($records as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->stf_name;
            $values[$key][] = $value->stf_email;
            $values[$key][] = $value->stf_phone;
            $values[$key][] = $value->stf_age;
            $values[$key][] = $value->stf_zip;
            $values[$key][] = $value->stf_city;
            $values[$key][] = $value->stf_block;
            $values[$key][] = $value->stf_district;
            $values[$key][] = $value->stf_region;
            $values[$key][] = $value->stf_state;
            $values[$key][] = $value->stf_contry;
            $values[$key][] = $value->dept_id;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
        }

        // This method send a view with ajax request as response.
        $returnHTML = view('commonView.createTable')->with(['values'=>$values, 'urls'=>$urls])->render();
        return response()->json([
            "status" => "success",
            "records" => $returnHTML,
        ]);            
    }

    // All profile settings
    public function profile($id=null)
    {
        # code...
        //fetch data using id.
        $datas = Staff::find($id);
        // dd($datas);
        return view('staff.profile')->with('datas', $datas);
    }

    public function updateProfile(Request $request, $id=null)
    {
        // dd($request->all());
        //
        //This function store data in data base.
        // Validation
        $request->validate([
            "name"           =>     "required",
            "email"          =>     "required|email",
            "phone"          =>     "required|digits:10",
            "zip"            =>     "required|digits:6",
            "city"           =>     "required",
            "district"       =>     "required",
            "state"          =>     "required",
            "contry"         =>     "required",
        ]);

        // dd($request->all());
        $img_name = "";
        if($request->file('image') == ''){
            $img_name = $request->input("hid_image");
        }else{
            $img_name = $request->file('image')->getClientOriginalName();
            $uplaodFile = $request->file('image')->storeAs("AllFiles", $img_name);
        }
        
        // Update data using eloquent method.
        try {
            Staff::where('id', $id)->update(
                [
                    "stf_name"      => $request->name,
                    "stf_about"      => $request->about,
                    "stf_email"     => $request->email,
                    "stf_phone"     => $request->phone,
                    "stf_age"       => $age = ($request->age != "") ? $request->age : $request->hid_age,
                    "stf_zip"       => $request->zip,
                    "stf_city"      => $request->city,
                    "stf_block"     => $request->block,
                    "stf_district"  => $request->district,
                    "stf_region"    => $request->region,
                    "stf_state"     => $request->state,
                    "stf_contry"    => $request->contry,
                    "stf_twitter"    => $request->twitter,
                    "stf_facebook"    => $request->facebook,
                    "stf_instagram"    => $request->instagram,
                    "stf_linkedin"    => $request->linkedin,
                    "stf_img"       => $img_name,
                ]
            );
            return redirect(route("profile", $id))->with('status', "Password updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("profile",$id))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(['status'=>'Something went wrong please try again...', 'url'=>'dashboard']);
        }
    }

    public function changePassword(Request $request, $id=null)
    {
        // dd($request->all());
        // Update data using eloquent method.
        try {
            Staff::where('id', $id)->update(
                [
                    "stf_pass"       => $request->input("newpassword"),
                ]
            );
            return redirect(route("profile", $id))->with('status', "Password updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("profile",$id))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(['status'=>'Something went wrong please try again...', 'url'=>'dashboard']);
        }
    }
}
