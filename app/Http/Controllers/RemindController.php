<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\remind_type;
use App\remind;

class RemindController extends Controller
{
    //
    public function index(Request $request){
        $remind = remind::orderby('date', 'desc')->get();
        return view('index', compact('remind'));
    }

    public function create(Request $request){
        $remind_type = remind_type::where('active_status', 'Y')->orderby('display_order', 'ASC')->get();
        // dd($remind_type);
        return view('create', compact('remind_type'));
    }


    public function store(Request $request){
        try {
            $POST = $request->all();
            // dd($POST);

            $data = new remind();
            $data->title          = $request->title;
            $data->description    = $request->description;     
            $data->remind_type    = $request->remind_type;     
            $data->day            = $request->day;     
            $data->date           = $request->date;     
            $data->time           = $request->time;     
            $data->active_status  = 'Y';
            $data->save();

            return response()->json(['status'=>'1', 'msg' =>"Reminder Set Successfully !", 'data'=>$data]);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return response()->json(['status'=>'0', 'msg' =>"$msg", 'data'=>$data]);
        }
    }
}
