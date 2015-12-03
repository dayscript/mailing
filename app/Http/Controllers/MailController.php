<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            ->select('contacts.account','contacts.name', 'contacts.email','events.event','events.created_at')
            ->where('contacts.dotacion1',1)
            ->orderBy('events.created_at','desc')
//            ->limit(10)
            ->get();
//        dd($contacts);

        return view('reports.dotacion',compact('contacts'));
    }
    public function clean()
    {
        $events = Event::where('event','spamreport')
            ->orWhere('event','unsubscribe')
            ->orWhere('event','dropped')
            ->orWhere('event','bounce')->get();
        foreach($events as $event){
            $contact = Contact::firstOrNew(['email'=>$event->email]);
            if($contact->id){
                $contact->delete();
            }
        }
        return $events->count();
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
            ->orderBy('identification', 'asc')
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
