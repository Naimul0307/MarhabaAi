<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {

        return view('contact', [
            'meta_title' => 'CONTACT US | MArhaba AI',

            'meta_description' =>
                'A go-to tech shop for Shopper Marketing agencies and Consumer brands.',

            'meta_keywords' =>
                'CONTACT, MIRROR BOOTH, DUBAI, BOOKING, UAE, Marhaba Ai',

            'settings' => getSettings(),
        ]);
    }


    public function sendEmail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]
        );


        if ($validator->passes()) {

            $emailData = [];

            $emailData['name'] =
                $request->name;

            $emailData['email'] =
                $request->email;

            $emailData['phone'] =
                $request->phone;

            $emailData['message'] =
                $request->message;


            Mail::to(
                'marhaba.experience.ai@gmail.com'
            )->send(
                new ContactMail($emailData)
            );


            $request->session()->flash(
                'success',
                'Thanks for contacting us, we will contact you shortly.'
            );


            return response()->json([
                'status' => 200,
            ]);

        }


        return response()->json([
            'status' => 0,

            'errors' => $validator->errors(),
        ]);
    }
}
