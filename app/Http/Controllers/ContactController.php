<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index() {
        return view('contact', [
            'meta_title' => 'CONTACT US | MArhaba Ai',
            'meta_description' => 'Get in touch with Marhaba Ai for bookings or inquiries. Contact us today to make your event unforgettable with our photo booth services.',
            'meta_keywords' => 'CONTACT, MIRROR BOOTH, DUBAI, BOOKING,UAE, Marhaba Ai'
        ]);
    }

  public function sendEmail(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        $emailData = [];
        if ($validator->passes()) {
            $emailData['name'] = $request->name;
            $emailData['email'] = $request->email;
            $emailData['phone'] = $request->phone;
            $emailData['message'] = $request->message;

            Mail::to('mdnaimul.alam07@gmail.com')->send(new ContactMail($emailData));

            $request->session()->flash('success','Thanks for contacting us, we will contact you shortly.');

            return response()->json([
                'status' => 200,
            ]);

        } else {
          return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
          ]);
        }

  }

}
