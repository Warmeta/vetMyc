<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required'
      ]);

      if ($validator->fails()) {
        Session::flash('fail', 'Error al enviar');

        return redirect('/#contact');
      }

      Mail::raw($request->message, function($message) use ($request) {
        $message->to('admin@vetMyc.com', 'vetMyc')->subject($request->subject);
        $message->replyTo($request->email, $request->name);
      });

      Session::flash('suc', 'Email enviado con éxito');

      return redirect('/#contact');
    }
}
