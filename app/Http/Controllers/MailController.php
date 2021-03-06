<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {

    public function webhook( Request $request )
    {
        $events = $request->all();

        foreach($events as $key=>$value){
            $event = Event::create($value);
        }
        return ["OK"];
    }

    public function report()
    {
//        $contacts = Contact::where('dotacion1',1)->limit(10000)->get();
        $contacts = DB::table('contacts')
            ->leftJoin('events', 'contacts.email', '=', 'events.email')
            ->select('contacts.email', 'contacts.account','contacts.name','events.event','events.created_at')
            ->where('contacts.bd_navidad',1)
            ->where('events.created_at','<','2015-11-26')
            ->orderBy('events.created_at','desc')
//            ->limit(10)
                ->groupBy('contacts.email')
            ->get();
//        dd($contacts);

        return view('reports.dotacion',compact('contacts'));
    }
    public function clean(Request $request)
    {
        $skip = $request->get('skip',0);
        $take = $request->get('take',1000);
        $events = Event::where('event','spamreport')
            ->orWhere('event','unsubscribe')
            ->orWhere('event','dropped')
            ->orWhere('event','bounce')
            ->skip($skip)
            ->take($take)
            ->get();
        $deleted = 0;
        foreach($events as $event){
            $contact = Contact::firstOrNew(['email'=>$event->email]);
            echo $contact->email;
            if($contact->id && !$contact->trashed()){
                $contact->delete();
                echo " - <span class='text-danger'>deleted</span>";
                $deleted++;
            }
            echo "<br>";
        }
        echo "<br>Eliminados: ".$deleted;
    }
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
        $subject = "Su mejor opción para esta NAVIDAD: Sodexo";

        $limit = $request->get('limit',10);
        $contacts = Contact::where('navidad',0)->where('navidad2',0)->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidad2', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidad2 = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts') );
    }

    public function navidad3( Request $request )
    {
        $subject = "En esta Navidad, regale a sus colaboradores algo que realmente van a aprovechar";

        $limit = $request->get('limit',10);
        $contacts = Contact::where('navidad',0)->where('navidad2',0)->where('navidad3',0)->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
//        $contacts = Contact::where('id',32625)->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidad3', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidad3 = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts') );
    }
    public function navidad4( Request $request )
    {
        $subject = "Regale Sodexo Navidad: un regalo, muchas ventajas";

        $limit = $request->get('limit',20);
        $total = Contact::where('navidad',0)->where('navidad2',0)->where('navidad3',0)->where('navidad4',0)->count()-$limit;
        $contacts = Contact::where('navidad',0)
            ->where('navidad2',0)
            ->where('navidad3',0)
            ->where('navidad4',0)
            ->orderBy('identification', 'asc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('id',32625)->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidad4', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidad4 = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }

    public function dotacion( Request $request )
    {
        $subject = "Recuerde que el 20 de diciembre es la última entrega de dotación del año";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_dotacion',1)->where('dotacion1',0)->count()-$limit;
        $contacts = Contact::where('bd_dotacion',1)
            ->where('dotacion1',0)
            ->orderBy('identification', 'asc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.dotacion1', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->dotacion1 = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }
    public function navidadcontador23( Request $request )
    {
        $subject = "Llegó Diciembre, no espere más";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_navidad',1)->where('navidadcontador23',0)->count()-$limit;
        $contacts = Contact::where('bd_navidad',1)
            ->where('navidadcontador23',0)
            ->orderBy('identification', 'desc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidadcontador23', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidadcontador23 = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }

    public function navidad16dias( Request $request )
    {
        $subject = "No deje para fin de año, el regalo de Navidad";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_navidad',1)->where('navidad16dias',0)->count()-$limit;
        $contacts = Contact::where('bd_navidad',1)
            ->where('navidad16dias',0)
            ->orderBy('identification', 'asc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidad16dias', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidad16dias = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }
    public function navidad10dias( Request $request )
    {
        $subject = "Que no le coja la noche";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_navidad',1)->where('navidad10dias',0)->count()-$limit;
        $contacts = Contact::where('bd_navidad',1)
            ->where('navidad10dias',0)
            ->orderBy('identification', 'desc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidad10dias', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidad10dias = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }

    public function navidadfinal( Request $request )
    {
        $subject = "¿Dejó el regalo de Navidad hasta el final?";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_navidad',1)
                ->where('navidadfinal',0)
                ->where('navidad10dias',0)
                ->count()-$limit;
        $contacts = Contact::where('bd_navidad',1)
            ->where('navidadfinal',0)
            ->where('navidad10dias',0)
            ->orderBy('identification', 'asc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.navidadfinal', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->navidadfinal = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }

    public function regalosnavidad( Request $request )
    {
        $subject = "No espere más, elija el mejor regalo de Navidad";

        $limit = $request->get('limit',20);
        $total = Contact::where('bd_regalos',1)->where('regalosnavidad',0)->count()-$limit;
        $contacts = Contact::where('bd_regalos',1)
            ->where('regalosnavidad',0)
            ->orderBy('identification', 'desc')
            ->skip(0)
            ->take($limit)
            ->get();
//        $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            Mail::queue( 'emails.regalosnavidad', [], function ( $message ) use ( $subject, $contact ) {
                //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                $message->from( "laura.martinez@sodexo.com", "Sodexo" )
                    ->subject( $subject )
                    ->to( $contact->email , $contact->name );
            } );
            $contact->regalosnavidad = true;
            $contact->save();
        }
        return view( 'pages.success', compact('contacts','total') );
    }

    public function soydt2016( Request $request )
    {
        $subject = "Nueva temporada SoyDT 2016!";

        $limit = $request->get('limit',50);
        $total = Contact::where('bd_futbol',1)
                ->where('soydt2016',0)->count()-$limit;
        $contacts = Contact::where('bd_futbol',1)
            ->where('soydt2016',0)
            ->orderBy('identification', 'desc')
            ->skip(0)
            ->take($limit)
            ->get();
//                $contacts = Contact::where('email','jcorrego@gmail.com')->orderBy('identification', 'asc')->skip(0)->take($limit)->get();
        foreach ($contacts as $contact) {
            if (App::environment('local')) {
                // The environment is local
            } else {
                Mail::queue( 'emails.soydt2016', [], function ( $message ) use ( $subject, $contact ) {
                    //$message->getHeaders()->addTextHeader('X-Mailgun-Campaign-Id', "navidad");
                    $message->from( "info@soydt.co", "SoyDT" )
                        ->subject( $subject )
                        ->to( $contact->email , $contact->name );
                } );
                $contact->soydt2016 = true;
                $contact->save();
            }
        }
        return view( 'pages.success', compact('contacts','total') );
    }


    public function send( Request $request )
    {
        $data = $request->all();
        Mail::queue( 'emails.navidad4', $data, function ( $message ) use ( $data ) {
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

}
