<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

// Import Modal
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // This function use for get all data from Post table.
        try {
            /*
                Fetch all column name from database table.
                If we want to do this so first import Schmea using this use Illuminate\Support\Facades\Schema;.
            */
            
            $department = new Post;
            $table = $department->getTable();
            $columns = Schema::getColumnListing($table);

            // Remove prefix.
            $columns = str_replace('post_', '', $columns);
            $columns = str_replace('_at', '', $columns);

            // Remove fields name from list/table
            $j = 0;
            for ($i=0; $i < count($columns); $i++) { 
                if($columns[$i] == 'deleted' || $columns[$i] == "img" || $columns[$i] == "new_post"){
                    continue;
                }else{
                    $tableCol[$j] = $columns[$i];
                }
                $j++;
            }

            // Fetch all column value form database table.
            $datas = ($request->perPage == "") ? Post::where('deleted_at', 'No')->paginate(5) : Post::where('deleted_at', 'No')->paginate($request->perPage);
            
            // dd($datas);
        } catch (\Throwable $th) {
            //throw $th;
            // return redirect(route("departmentNew"))->with(["status"=>$th->getMessage()]);
            return redirect(route("error"))->with(["status"=>"Data not found.", "url"=>"postList"]);
        }

        foreach ($datas as $key=>$value) {
            $values[$key][] = $value->id;
            $values[$key][] = $value->post_title;
            $values[$key][] = $value->created;
            $values[$key][] = $value->updated;
            $values[$key][] = $value->status;
        }        

        return view('Post.list_post', ['columns'=>$tableCol, 'values'=>$values, 'urls'=>['pageTitle'=>'Post', 'pageRoute'=>'postNew', 'edit'=>'postEdit', 'delete'=>'postDelete', 'sts'=>'postStatus', 'paginate'=>'postList', 'srcName'=>'postSearch', 'pageLink'=>$datas->links('pagination::bootstrap-4')]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // This function show the form which is use for instert data into database.
        return view('Post.new_post');
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
            'post_title' => 'required',
            'post_image' => 'required',
            'new_post' => 'required',
        ]);
        
        $fileName = $request->file('post_image')->getClientOriginalName();
        $upload = $request->file('post_image')->storeAs('AllFiles', $fileName);

        // dd($upload);

        // Insert data
        $post = new Post;
        
        // If generate any exception in code so try to handle this.
        try {
            $post->post_title = $request->post_title;
            $post->post_img = $fileName;
            $post->new_post = $request->new_post;
            $post->save();
        } catch (\Throwable $th) {
            return redirect(route("postNew"))->with(["status"=>$th->getMessage()]);
            // return redirect(route("error"))->with(["status"=>"Data is incorrect form.", "url"=>"postNew"]);
        }

        return redirect(route("postNew"))->with(["status"=>"Post is created."]);
        // return view("new_post");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function statusChange($stats=null, $id=null)
    {
        // dd($id);
        //Change Status.
        try {
            if($stats == 'activate'){
                Post::where('id', $id)->update(['status'=>'deactivate']);
            }else{
                Post::where('id', $id)->update(['status'=>'activate']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'postlist']);
        }
        return redirect(route('postList'))->with(['status'=>'Status change successfully...', 'url'=>'postList']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id=null)
    {
        //fetch data using id.
        $datas = Post::find($id);
        return view('Post.postEdit', ['datas'=>$datas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        //
        //This function store data in data base.
        // Validation
        $validated = $request->validate([
            'post_title' => 'required',
            'new_post' => 'required'
        ]);

        $img_name = "";
        if($request->file('post_image') == ''){
            $img_name = $request->input("hid_image");
        }else{
            $img_name = $request->file('post_image')->getClientOriginalName();
            $uplaodFile = $request->file('post_image')->storeAs("AllFiles", $img_name);
        }

        // dd($img_name);
        // Update data using eloquent method.
        try {
            Post::where('id', $id)->update(['post_title'=> $request->input("post_title"), "post_img"=>$img_name, "new_post"=>$request->input("new_post")]);
            return redirect(route("postEdit", $id))->with('status', "Data updated successfully.");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route("postEdit", $id))->with(["status"=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id=null)
    {
        // Update deleted at.
        try {
            Post::where('id',$id)->update(['deleted_at'=>'Yes']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('error'))->with(['status'=>'Something went wrong...', 'url'=>'postList']);
        }
        return redirect(route('postList'))->with(['status'=>'Item deleted successfully...', 'url'=>'postList']);
    }

    public function searchRecord(Request $req)
    {
        try {
            $data = json_decode($req->input("data"));
            $records = Post::where('deleted_at', 'No')->where("dept_name", 'like', '%'.$data->searchText.'%')->paginate(100);
            $urls = [
                'edit'=>'postEdit', 
                'delete'=>'departmentDelete', 
                'sts'=>'departmentStatus', 
                'srcName'=>'departmentSearch'
            ];
        } catch (\Throwable $th) {
            // throw $th->getMessage();
            return $th->getMessage();
            // return redirect(route("postNew"))->with(["status"=>$th->getMessage()]);
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
