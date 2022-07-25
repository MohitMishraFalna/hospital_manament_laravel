<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

// Import Modal
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // This function use for get all data from Department table.
        try {
            /*
                Fetch all column name from database table.
                If we want to do this so first import Schmea using this use Illuminate\Support\Facades\Schema;.
            */
            
            $department = new Department;
            $table = $department->getTable();
            $columns = Schema::getColumnListing($table);

            // Remove prefix.
            $columns = str_replace('_at', '', $columns);

            // Remove fields name from list/table
            $j = 0;
            for ($i=0; $i < count($columns); $i++) { 
                if($columns[$i] == 'deleted'){
                    continue;
                }else{
                    $tableCol[$j] = $columns[$i];
                }
                $j++;
            }

            // Fetch all column value form database table.
            $datas = ($request->perPage == "") ? Department::where('deleted_at', 'No')->paginate(5) : Department::where('deleted_at', 'No')->paginate($request->perPage);
            
            // dd($datas);
        } catch (\Throwable $th) {
            //throw $th;
            // return redirect(route("departmentNew"))->with(["status"=>$th->getMessage()]);
            return redirect(route("error"))->with(["status"=>"Data not found.", "url"=>"list"]);
        }

        foreach ($datas as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->dept_name;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
        }        

        return view('Department.list_department', ['columns'=>$tableCol, 'values'=>$values, 'urls'=>['pageTitle'=>'Department', 'pageRoute'=>'departmentNew', 'edit'=>'departmentEdit', 'delete'=>'departmentDelete', 'sts'=>'departmentStatus', 'paginate'=>'list', 'srcName'=>'departmentSearch', 'pageLink'=>$datas->links('pagination::bootstrap-4')]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // This function show the form which is use for instert data into database.
        return view('Department.new_department');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        //This function store data in data base.
        // Validation
        $validated = $request->validate([
            'name' => 'required'
        ]);

        // Insert data
        $department = new Department;
        
        // If generate any exception in code so try to handle this.
        try {
            $department->dept_name = $request->name;
            $department->save();
        } catch (\Throwable $th) {
            // return redirect(route("new"))->with(["status"=>$th->getMessage()]);
            return redirect(route("error"))->with(["status"=>"Data is incorrect form.", "url"=>"departmentNew"]);
        }

        return redirect(route("departmentNew"))->with(["status"=>"Department is created."]);
        // return view("new_department");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function statusChange($stats=null, $id=null)
    {
        //Change Status.
        try {
            if($stats == 'activate'){
                Department::where('id', $id)->update(['status'=>'deactivate']);
            }else{
                Department::where('id', $id)->update(['status'=>'activate']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'list']);
        }
        return redirect(route('list'))->with(['status'=>'Status change successfully...', 'url'=>'list']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id=null)
    {
        //fetch data using id.
        $datas = Department::find($id);
        return view('department.departmentEdit', ['datas'=>$datas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        //
        //This function store data in data base.
        // Validation
        $validated = $request->validate([
            'name' => 'required'
        ]);

        // Update data using eloquent method.
        try {
            Department::where('id', $id)->update(['dept_name'=> $request->input("name")]);
            return redirect(route("departmentEdit", $id))->with('status', "Data updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("error"))->with(['status'=>'Something went wrong please try again...', 'url'=>'departmentEdit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id=null)
    {
        // Update deleted at.
        try {
            Department::where('id',$id)->update(['deleted_at'=>'Yes']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'list']);
        }
        return redirect(route('list'))->with(['status'=>'Item deleted successfully...', 'url'=>'list']);
    }

    public function searchRecord(Request $req)
    {
        try {
            $data = json_decode($req->input("data"));
            $records = Department::where('deleted_at', 'No')->where("dept_name", 'like', '%'.$data->searchText.'%')->paginate(100);
            $urls = [
                'edit'=>'departmentEdit', 
                'delete'=>'departmentDelete', 
                'sts'=>'departmentStatus', 
                'srcName'=>'departmentSearch'
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
            $values[$key][] = $value->dept_name;
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
}
