<?php

namespace App\Http\Controllers\SiteController;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest\ContactFormRequest;
use Illuminate\Support\Facades\Mail;
use Redirect;
use View;
 

class AboutController extends Controller {

  public function create()
    {
        return view('Frontend.contact');
    }

  public function store(Request $request)
  {
      $name   = $request->input('name');
      $email  = $request->input('email');
      $phone  = $request->input('phone');
      $bodymessage = $request->input('message');
      $this->phone   = $phone;
      $this->name    = ucwords($name);
      $this->email   = $email;
      

      Mail::send('emails.aboutmail', ['name' => $name, 'email' => $email, 'phone' => $phone, 'bodymessage' => $bodymessage],  function ($message)
      {
          $message->from($this->email, 'SMS - ' . $this->name);
          $message->to('kavyasoman22@gmail.com');
         
      });
     

      return redirect('Contact')
          ->withFlashMessage('Thanks for contacting us!')
          ->withType('success');

  }

}