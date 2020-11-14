<?php

namespace App\Http\Controllers;
use DB;
use Session ;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;
class MailSend extends Controller
{
    public function mailsend()
    {
        $details = [
            'title' => 'Title: Mail from Real Programmer',
            'body' => 'Body: This is for testing email using smtp'
        ];
        $customer_id =Session::get('customer_id');
        $all_order = DB::table('tbl_order')->where('customer_id',$customer_id);

        Mail::to('betapchoi10k@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}