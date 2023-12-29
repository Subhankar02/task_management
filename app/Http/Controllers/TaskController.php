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
    public function get_tasks(Request $request, $task_date){
        if($task_date == 'null'){
            $readData = Task::orderBy('id','ASC')->get();
        $readData1=[];
        foreach($readData as $i=>$data ){
            $readData1[$i]['user'] = user::select('name')->where('uid', $data->user_id)->first();

            $carbonDate = Carbon::parse($data["created_at"]);
            $aa = $carbonDate->format('Y-m-d');
            $readData1[$i]['task_date'] = $aa;
            $readData1[$i]['task'] = $data;
        }
        $data=[
            'success' => true,
            'data' => $readData1
        ];
        return response()->json($data);
        }else{
            $readData = Task::whereDate('created_at', '=', Carbon::parse($task_date)->format('Y-m-d'))->get();
            $readData1=[];
            foreach($readData as $i=>$data ){
                $readData1[$i]['user'] = user::select('name')->where('uid', $data->user_id)->first();

                $carbonDate = Carbon::parse($data["created_at"]);
                $aa = $carbonDate->format('Y-m-d');
                $readData1[$i]['task_date'] = $aa;
                $readData1[$i]['task'] = $data;
            }
            $data=[
                'success' => true,
                'data' => $readData1
            ];
            return response()->json($data);
        }
        
    }

    /**Get a task by id */
    public function get_a_task($task_id){
        $readData['task'] = Task::where('uid',$task_id)->first();
        $readData['user'] = User::select('uid','name')->where('uid',$readData['task']->user_id)->first();
        $data=[
            'success' => true,
            'data' => $readData
        ];
        return response()->json($data);
    }

    /**Delete data */
    public function delete_task($task_id){
        $delete=Task::where('uid',$task_id)->delete();
        $data=[
            'success' => true,
            'message' => 'Delete successful',
        ];
        return response()->json($data);
    }

    /**Update task */
    public function update_task(Request $request){
        $updateData = Task::where('uid',$request->task_id)->first();
        $updateData->title             = $request->task_title;
        $updateData->description       = $request->task_description;
        $updateData->user_id           = $request->user_name;
        $updateData->updated_at        = Carbon::now();
        $updateData->update();
        $data=[
            'success' => true,
            'message' => 'Update successful',
        ];
        return response()->json($data);
    }
}
