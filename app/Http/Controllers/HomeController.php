<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
        public  $user;
        public function __construct()
        {
            $this->middleware('auth');

        }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->user = Auth::user();
        if($this->user->role==="admin"){

            return view('admin.admin');
          }else{
            return view('home');
        }

    }

    public  function makeRandomAddress(Request $request){
        $data = $request->all();
        $userData =User::select('address')->where('role','user')->where('address','<>',"")->get()->toArray();
        $items =array();
        foreach ($userData as $key){
            array_push($key,$data['number_coin']);
            $items[] = $key ;
        }
        $random = Arr::random($items,$data['number_email']);
        $this->makeCsvFile($random);
    }

    private function makeCsvFile($data){

        // Your code here!
        //
        //        $data = [
        //            [ "mohamed",30],
        //           [ "bilal", 20],
        //        ];

        $fh = fopen("file.csv", "w");
        foreach ($data as $field) {
            fputcsv($fh, $field);
        }
        $file ="file.csv";
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
        fclose($fh);


    }

    public function addCryptoAddress(Request $request){
          //to check all the datas dumped from the form
        //if your want to get single element,someName in this case
        $address = $request->addressCrypto;
        $this->user = Auth::user();
        $this->user->address =$address ;
        $this->user->save();
        $message = "You are added the address crypto successfully !" ;
        Session::flash('success_message',$message);
      return redirect()->back();
    }
}
