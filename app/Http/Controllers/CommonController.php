<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Department;
    use App\Models\Doctors;
    use App\Models\Staff;
    use App\Models\User;

    class CommonController extends Controller{
        public function findAddress(Request $request)
        {
            # Data recieved from the ajax method. now recieved data convert into string.
            $postData = $request->input("data");
            $jsnDcdData = json_decode($postData);
            return $address = ($jsnDcdData->zip_data) ? postalDataGetByPincode($jsnDcdData->zip_data) : postalDataGetByName($jsnDcdData->postName);
            // return response()->json([
            //     'response' => $address
            // ]);
        }

        // public function searchRecord(Request $req)
        // {
        //     try {
        //         $data = json_decode($req->input("data"));
        //         // dd(trim(($data->tableName), '"'));
        //         // $tblNm = trim(($data->tableName), '"');
        //         $tblNm = preg_replace('/"/','', $data->tableName);
                
        //         $record = $tblNm::where(['deleted_at'=> 'No', $data->columnName, 'like', '%'.$data->searchText.'%'])->paginate(100);
        //         // $record = Staff::all()->where('deleted_at', 'No');
        //     } catch (\Throwable $th) {
        //         // throw $th->getMessage();
        //         return $th->getMessage();
        //         // return redirect(route("doctorNew"))->with(["status"=>$th->getMessage()]);
        //     }
        //     return response()->json([
        //         "Mohit" => "Mishra"
        //     ]);            
        // }
    }