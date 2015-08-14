<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view( 'pages.contact' );
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function navidad( Request $request )
    {
        $subject = "La mejor opción para sus Regalos de Navidad";

        $mail = env('CONTACT_MAIL');
        $name = env('CONTACT_NAME');
        $mail = "jco@dayscript.com";
        Mail::queue( 'emails.navidad', [], function ( $message ) use ( $subject, $mail, $name ) {
            $message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "test");
            $message->from( "postmaster@universosodexo.com", "Sodexo" )
                ->subject( $subject )
                ->to( $mail , $name );
        } );
        return view( 'pages.success' );

    }

    public function send( Request $request )
    {
        $data = $request->all();
        Mail::queue( 'emails.navidad', $data, function ( $message ) use ( $data ) {
            $message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', 'fru92');
            $message->from( $data['email'] )
                ->subject( $data['subject'] )
                ->to( env('CONTACT_MAIL'), env('CONTACT_NAME') );
        } );

        //Mail::queue('emails.newmessage', ['user' => $user,'notification'=>$not,'model'=>$model], function ($m) use ($user) {
        //    $m->to($user->email, $user->name)->subject('Tienes un nuevo mensaje en Interacpedia');
        //});
        return view( 'pages.success' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store( Request $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit( $id )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy( $id )
    {
        //
    }
}
