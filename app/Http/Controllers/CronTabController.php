<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\remind_type;
use App\remind;
use Carbon\Carbon;

class CronTabController extends Controller
{
    
    public function index(Request $request){
        $remind_type = remind_type::where('active_status', 'Y')->orderby('display_order', 'ASC')->get();
        // dd($remind_type);
        return view('crontab', compact('remind_type'));
    }


    public function create(Request $request){
        // dd($request->all());
        // $data = remind::orderby('created_at', 'ASC')->first();

        if ($request->remind_type=='1') {
            
            // Fetch all  Records From The Remind Model
            $data = remind::where('remind_type', $request->remind_type)
                        // ->where('time', '>', date('H:i:s'))
                        ->orderby('created_at', 'ASC')
                        ->get();
            
            //  Convert into index array  
            foreach ($data as $key1 => $value1) {

                // Start need update for testing
                    $minutes   =   date('i');
                    $minutes   =   $minutes+1;
                    $value1->update(['time' => date("H:".$minutes.":s")]);
                    // dd($value1);
                // End need update for testing

                $start = date_create(date('H:i:s'));    // find current time in (H:i:s)
                $end  = date_create($value1->time);     // find time form $value1 varriable
                $diff = date_diff($end,$start);         // find diff between $start and $end
                
                // dd($diff->h." ".$diff->i." ".$diff->s);
                // Check condition for (00:01:00) or Last 1 Minutes
                if ($diff->h =='0' && $diff->i =='1' && $diff->s =='0') {
                    dd('Ready for start scheduler');
                }
            }
        }
        dd($data);
    }
}
