<?php
// impor library for mail.
use Illuminate\Support\Facades\Mail;
/* 
    ------>Above method is first method for getting data from third party api.<-------
 If we get data from api so first import the Class and library. like below.
 GuzzleHttp\Excepetion\GuzzleExcepetion this library use for handle exception which is ganrate by the api.
 
*/
use GuzzleHttp\Excepetion\GuzzleExcepetion;

// GuzzleHttp\Client as GuzzleClient this library work as client which is fire the api and get data from api.
use GuzzleHttp\Client as GuzzleClient;

// -------------------> Second method library import here.. <-----------------
use Illuminate\Support\Facades\Http;
    function postalDataGetByPincode($pincode = null)
    {
        //Client is a object which help us for get data from api.
        $client = new \GuzzleHttp\Client();

        // Here we are attach our data from api.
        try {
            $apiUrl = "https://api.postalpincode.in/pincode/" . $pincode;
            /**
             * $client is a object which is create from new \GuzzleHttp\Client() class.
             * get() is a method which is pass the api and our data as parameter on server side function. which is defined by the third party. and this method responsible for get the data from the api.
             * getBody() this method fire the api.
             */
            return json_decode($client->get($apiUrl)->getBody());
            
        } catch (\Throwable $th) {
            // throw $th;
            // return $th->getMessage();            

            // If any type of problem occur so this error send as response.
            $error = '<div class="alert alert-primary alert-dismissible fade show " role="alert">
                        Your entered input can be wrong or may be network issues. Please fill manually data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            return response()->json([
                0 => [
                    "Status" => "Error",
                    "Message" => $error
                ],
            ]);
        }
    }

    // ---------> This method is small for get data from third party and our database. <-------------
    function postalDataGetByName($postName = null)
    {
        try {
            //code...
            # For using this method it is required for import this library use Illuminate\Support\Facades\Http;
            $apiUrl = Http::get("https://api.postalpincode.in/postoffice/" . $postName);
            if($apiUrl->ok()){
                return json_decode($apiUrl->body());
            }
        } catch (\Throwable $th) {
            //throw $th;
            // return $th->getMessage();
            
            // If any type of problem occur so this error send as response.
            $error = '<div class="alert alert-primary alert-dismissible fade show " role="alert">
                        Your entered input can be wrong or may be network issues. Please fill manually data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            return response()->json([
                0 => [
                    "Status" => "Error",
                    "Message" => $error
                ],
            ]);
        }
    }

    // ----------> This method get random string. <-----------
    function getRandString(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }