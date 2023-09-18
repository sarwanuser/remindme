<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\remind_type;
use App\remind;
use Carbon\Carbon;

class RemindController extends Controller
{
    //
    public function index(Request $request){
        $remind = remind::orderby('date', 'desc')->get();
        // $remind = $remind->distinct('remind_code');
        // $remind = $remind->groupby('remind_code');
        // dd($remind);
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
            $data = '';
            // dd($POST);

            // function for find remind_code
            $remind_code = remind::orderby('id', 'DESC')->first();
            if($remind_code){
                $remind_code = $remind_code->remind_code;
                $remind_code = $remind_code+1;
            }
            else {
                $remind_code = 1;
            }

            if ($request->has('from_date') && $request->has('to_date')) {
                // dd($request->from_date, $request->to_date);
                $startDt = strtotime($request->from_date);
                $endDt = strtotime($request->to_date);
                $weekNum = date('w', strtotime($request->day));
                // dd($startDt, $endDt, $weekNum);
                $dateDays = array();

                do
                {
                    if(date("w", $startDt) != $weekNum)
                    {
                        $startDt += (24 * 3600); // add 1 day
                    }
                } while(date("w", $startDt) != $weekNum);


                while($startDt <= $endDt)
                {
                    $dateDays[] = date('d-m-Y', $startDt);
                    $startDt += (7 * 24 * 3600); // add 7 days
                }

                foreach($dateDays as $index => $date)
                {
                    $data = new remind();
                    $data->title          = $request->title;
                    $data->description    = $request->description;
                    $data->remind_type    = $request->remind_type;
                    $data->day            = @$request->day;  
                    $data->date           = date('Y-m-d', strtotime($date));
                    $data->time           = @$request->time;
                    $data->remind_code    = @$remind_code;
                    $data->run_status     = 'N';
                    $data->active_status  = 'Y';
                    $data->save();
                } 
        
            }
            else {
                $data = new remind();
                $data->title          = $request->title;
                $data->description    = $request->description;     
                $data->remind_type    = $request->remind_type;     
                $data->day            = @$request->day;     
                $data->date           = @$request->date;     
                $data->time           = @$request->time;
                $data->remind_code    = @$remind_code;
                $data->run_status     = 'N';
                $data->active_status  = 'Y';
                $data->save();
            }

            return response()->json(['status'=>'1', 'msg' =>"Reminder Set Successfully !", 'data'=>@$data]);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return response()->json(['status'=>'0', 'msg' =>"$msg", 'data'=>@$data]);
        }
    }
}
