<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\remind_type;
use App\remind;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class CheckSchedulerController extends Controller
{
    public function checkOneTime(Request $request){
        // dd($request->all());
            
        // Fetch all  Records From The Remind Model
        $data = remind::where('remind_type', '1')
                    ->where('date', date('Y-m-d'))
                    ->orderby('created_at', 'ASC')
                    ->get();
        
        //  Convert into index array  
        foreach ($data as $key1 => $value1) {

            // Start need update for testing
                // $value1->update(['time' => date("H:i:s")]);
                $value1->update(['day' => 'Run']);
                // dd($value1);
            // End need update for testing
            if (date('H:i', strtotime($value1->time)) == date("H:i")) {
                //  start mail
                    $mail             = new PHPMailer();                // create a n
                    $mail->SMTPDebug  = 0;                                       
                    $mail->IsSMTP();
                    $mail->SMTPSecure = 'tls';                              
                    $mail->Host       = "smtp.gmail.com";                    
                    $mail->SMTPAuth   = true;                             
                    $mail->Port       = 25;  
                    $mail->Username   = 'info@rstechnosoft.com';             
                    $mail->Password   = 'bjylkizlpfmeujtn';                        
                    $mail->IsHTML(true);
                    $mail->SetFrom('info@rstechnosoft.com', 'RS TECHNO SOFT');
                    $mail->Subject = "Your Reminder";
                    $mail->Body    =  "Your Reminder details are";
                    $mail->AddAddress('485ashishkumar@gmail.com', 'Ashish Kumar');
                    // $mail->AddAddress('sarwandeveloper@gmail.com', 'Sarwan Verma');
                    // dd($mail);
                    if($mail->Send()){
                        echo "Reminder Mail Send Sucessfully";
                    }
                    else {
                        echo $mail->ErrorInfo;
                    }
                //  end mail
            }
        }
    }
}
