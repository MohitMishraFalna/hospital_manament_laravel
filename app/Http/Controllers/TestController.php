<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

// Import Modal
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // This function use for get all data from Test table.
        try {
            /*
                Fetch all column name from database table.
                If we want to do this so first import Schmea using this use Illuminate\Support\Facades\Schema;.
            */
            
            $department = new Test;
            $table = $department->getTable();
            $columns = Schema::getColumnListing($table);

            // Remove prefix.
            $columns = str_replace('test_', '', $columns);
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
            $datas = ($request->perPage == "") ? Test::where('deleted_at', 'No')->paginate(5) : Test::where('deleted_at', 'No')->paginate($request->perPage);
            
            // dd($datas);
        } catch (\Throwable $th) {
            //throw $th;
            // return redirect(route("departmentNew"))->with(["status"=>$th->getMessage()]);
            return redirect(route("error"))->with(["status"=>"Data not found.", "url"=>"testList"]);
        }

        foreach ($datas as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->test_name;
            $values[$key][] = $value->test_price;
            $values[$key][] = $value->test_range;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
        }        

        return view('Test.list_test', ['columns'=>$tableCol, 'values'=>$values, 'urls'=>['pageTitle'=>'Test', 'pageRoute'=>'testNew', 'edit'=>'testEdit', 'delete'=>'testDelete', 'sts'=>'testStatus', 'paginate'=>'testList', 'srcName'=>'testSearch', 'pageLink'=>$datas->links('pagination::bootstrap-4')]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // This function show the form which is use for instert data into database.
        return view('Test.new_test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This function store data in data base.
        // Validation
        $validated = $request->validate([
            'name' => 'required'
        ]);
        
        $testRange = $request->range . '-' . $request->end_range;
        // Insert data
        $test = new Test;
        
        // If generate any exception in code so try to handle this.
        try {
            $test->test_name = $request->name;
            $test->test_price = $request->test_price;
            $test->test_range = $testRange;
            $test->save();
        } catch (\Throwable $th) {
            return redirect(route("testNew"))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(["status"=>"Data is incorrect form.", "url"=>"testNew"]);
        }

        return redirect(route("testNew"))->with(["status"=>"Test is created."]);
        // return view("new_test");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function statusChange($stats=null, $id=null)
    {
        // dd($id);
        //Change Status.
        try {
            if($stats == 'activate'){
                Test::where('id', $id)->update(['status'=>'deactivate']);
            }else{
                Test::where('id', $id)->update(['status'=>'activate']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'testlist']);
        }
        return redirect(route('testList'))->with(['status'=>'Status change successfully...', 'url'=>'testList']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id=null)
    {
        //fetch data using id.
        $datas = Test::find($id);
        return view('Test.testEdit', ['datas'=>$datas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        //
        //This function store data in data base.
        // Validation
        $validated = $request->validate([
            'name' => 'required',
            'test_price' => 'required',
            'range' => 'required'
        ]);
        // dd($request->all());
        // Update data using eloquent method.
        try {
            Test::where('id', $id)->update(['test_name'=> $request->input("name"), "test_price"=>$request->input("test_price"), "test_range"=>$request->input("range")]);
            return redirect(route("testEdit", $id))->with('status', "Data updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("testEdit", $id))->with(["status"=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id=null)
    {
        // Update deleted at.
        try {
            Test::where('id',$id)->update(['deleted_at'=>'Yes']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'testList']);
        }
        return redirect(route('testList'))->with(['status'=>'Item deleted successfully...', 'url'=>'testList']);
    }

    public function searchRecord(Request $req)
    {
        try {
            $data = json_decode($req->input("data"));
            $records = Test::where('deleted_at', 'No')->where("dept_name", 'like', '%'.$data->searchText.'%')->paginate(100);
            $urls = [
                'edit'=>'testEdit', 
                'delete'=>'departmentDelete', 
                'sts'=>'departmentStatus', 
                'srcName'=>'departmentSearch'
            ];
        } catch (\Throwable $th) {
            // throw $th->getMessage();
            return $th->getMessage();
            // return redirect(route("testNew"))->with(["status"=>$th->getMessage()]);
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
