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
        if(Auth::guard('web')->check()) {
            return view('index');
        }else{
            return Redirect('/');
        }
        
    }

    public function users_page(){
        if(Auth::guard('web')->check()) {
        return view('users');
        }else{
            return Redirect('/');
        }
    }

    public function tasks_for_users_page(){
        if(Auth::guard('web')->check()) {
        return view('tasksForUsers');
        }else{
            return Redirect('/');
        }
    }
    
    public function login_page(){
        return view('userLogin');

    }

    /**Login */
    public function check_login(Request $request){
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

                $request->session()->flash('alert', array('message'=>$checkActivity->name.' Login Successful', 'status'=>'success'));
                if($checkActivity->role == 'admin'){
                    return Redirect('index');
                }else{
                    return Redirect('tasks/for_users');
                }
            } else{
                $request->session()->flash('alert', array('message'=>'Login Failed', 'status'=>'error'));
                return redirect()->back();
            }
        }else {
            $request->session()->flash('alert', array('message'=>'User Not Found', 'status'=>'error'));
            return redirect()->back();
        }
    }

    /**Logout */
    public function logout(){
        auth()->guard('web')->logout();
        $data=[
            'url'           => '',
            'massege'       => 'Loged out',
            'success'       => true,
        ];
        return response()->json($data);
    }
}
