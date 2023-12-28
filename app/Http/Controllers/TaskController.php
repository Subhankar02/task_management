<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**Add a task */
    public function add_task(Request $request){
        
        try{
            DB::begintransaction();
            $addData = new Task;
            $addData->uid               = 'TASK_'. time() . '_' . uniqid();
            $addData->title             = $request->task_title;
            $addData->description       = $request->task_description;
            $addData->user_id           = $request->user_name;
            $addData->status            = 'active';
            $addData->created_at        = Carbon::now();
            $addData->updated_at        = Carbon::now();
            $addData->save();
            DB::commit();
            $data=[
                'success'   =>true, 
                'msg'       =>'Task successfully added',
            ];
            return response()->json($data);
        }
        catch(\Exception $e){
            $data=[
                'success' =>false, 
                'msg'=>[$e->errorInfo[2]]
            ];
            return response()->json($data);
        }
    }

    /**Get users */
    public function get_users(){
        $readData = User::orderBy('id','ASC')->get();
        $data=[
            'success' => true,
            'data' => $readData
        ];
        return response()->json($data);
    }

    /**Get tasks */
    public function get_tasks(){
        $readData = Task::orderBy('id','ASC')->get();
        $readData1=[];
        foreach($readData as $i=>$data ){
            $readData1[$i]['user'] = user::select('name')->where('uid', $data->user_id)->first();
            $readData1[$i]['task'] = Task::where('id', $data->id)->first();
        }
        $data=[
            'success' => true,
            'data' => $readData1
        ];
        return response()->json($data);
    }

    /**Get a task by id */
    public function get_a_task($task_id){
        // dd($task_id);
        $readData = Task::where('uid',$task_id)->first();
        $data=[
            'success' => true,
            'data' => $readData
        ];
        return response()->json($data);
    }
}
