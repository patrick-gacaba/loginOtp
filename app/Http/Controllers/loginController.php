<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use Hash;
use Auth;
use App\register;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class loginController extends Controller
{
    //
    public function login(){
        return view ('login');
    }
    public function generateOTP(){
        $otp = mt_rand(111111,999999);
        return $otp;
    }
      
    public function authenticate(Request $request){
        $credentials= $this->validate($request,[ 
            'email'=>'required',
            'password'=>'required'
        ]);
         $user=register::where(['email'=>$credentials['email']])->first();

         if(isset($user)){
            if(Hash::check($credentials['password'], $user->password)){
                 $otp=$this->generateOTP();
                 $message ='your otp is '.$otp;
                 session(['otp'=>$otp]);

                 $resp = $this->SendOtp($message,'your otp is'.$otp);

                 return response()->json([
                    "status"=> "ok",
                    "msg"=>$resp,
                     "test"=>$otp
                        ]);
             }else{
                return response()->json([
                    "status"=> "error",
                    "msg"=>"Incorrect email or password"
                        ]);
            }

        }else{
            return response()->json([
                    "status"=> "error",
                        ]);

        }


    }


public function verifyOtp(){
        $otp = trim(request('otp'));
        if($otp==''){
            return response() ->json([ 
                 "status"=> "error",
                    "msg"=>"Invalid otp"
                        ]);
        }
        else{
            $user = new register;
            if($otp == session('otp')){

            return response() ->json([ 
                 "status"=> "ok",
                    "msg"=>"success"
                        ]);
              }
            else{
                return response() ->json([ 
                 "status"=> "error",
                    "msg"=>"Invalid otp"
                        ]);
            }
        }
    }

public function logout(){
         
    $user()->logout();
    session()->flash('message', 'Some goodbye message');
    return redirect('/login');
    }


    public function SendOtp($email,$message){

        $mail = new PHPMailer(true);

        $mail->isSMTP();  // Set mailer to use SMTP


try {
    //Server settings
    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'postmaster@sandbox9bf1491297ad4802ad68d6ad04808797.mailgun.org';                     // SMTP username
    $mail->Password   = '8bb7a3e74095d35c95f83741c33f55e4-87cdd773-a7d09f17';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('pgacaba94@gmail.com', 'Patrick');     // Add a recipient
  
    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email sent with Mailgun';
    $mail->Body    = $message;
   
    $mail->send();
    return "Message has been sent";
     } catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     }

   } 


}