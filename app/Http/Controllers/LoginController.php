<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class LoginController extends Controller
{
    public function index_page(){
        $session_data = session('id');
        // dd($session_data);
        // if(!empty($session_data)){
            return view('index');
        // }else{
            // return view('userLogin');
        // }
        
    }

    public function users_page(){
        return view('users');
    }

    public function tasks_for_users_page(){
        return view('tasksForUsers');
    }
    
    public function login_page(){
        return view('userLogin');

    }
    public function check_login(Request $request){
        // dd($request);
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ],
        [
            'email.required'    => 'email required',                      
            'password.required' => 'password required',                                     
        ]);
        
        $checkActivity = User::where('email',$request->email)->first();
        if($checkActivity){
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // dd($checkActivity->uid);
                $request->session()->put('id', $checkActivity->uid);
                if($checkActivity->role == 'admin'){
                    $data=[
                        'session'   => $session_data = session('id'),
                        'url'       => 'index',
                        'success'   => true,
                    ];
                    
                }else{
                    $data=[
                        'url'       => 'index',
                        'success'   => true,
                    ];
                }
                return response()->json($data);
                // Authentication was successful...
                
            } else{
                $data=[
                    
                    'massege'       => 'Wrong password!',
                    'success'       => false,
                ];
                return response()->json($data);
            }
        }else {
            $data=[
                'massege'       => 'Incorrect email id!',
                'success'       => false,
            ];
            return response()->json($data);
        }
    }

    public function logout(){
        auth()->guard('web')->logout();
        $data=[
            'url'           => 'login/page',
            'massege'       => 'Loged out',
            'success'       => true,
        ];
        return response()->json($data);
    }
}
