<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        return back()->withErrors($validator->getErrors());
      }

      Mail::raw($request->message, function($message) use ($request) {
        $message->to('admin@vetMyc.com', 'vetMyc');
        $message->to('ibandominguezpro@gmail.com', 'Iban Dominguez');
        $message->replyTo($request->email, $request->name);
      });

      Session::flash('suc', 'Email enviado con éxito.');

      return redirect('/#contact')->with('success', true);
    }
}
