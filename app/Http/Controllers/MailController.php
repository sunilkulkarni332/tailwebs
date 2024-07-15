<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email() {
    $message = 'his is some useful information.';
        info('This is some useful information.');        
        Log::emergency($message);
        Log::alert($message);
        Log::critical($message);
        Log::error($message);
        Log::warning($message);
        Log::notice($message);
        Log::info($message);
        Log::debug($message);
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('sunil.developer@appmanufact.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('sunil.developer@appmanufact.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('sunil.developer@appmanufact.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('sunil.developer@appmanufact.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('sunil.developer@appmanufact.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\xampp\htdocs\kulkarniWebsite\public\product_assets\2024-04-08_13_18_30.png');
         $message->attach('C:\xampp\htdocs\kulkarniWebsite\public\product_assets\2024-04-08_13_18_30.png');
         $message->from('sunil.developer@appmanufact.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}