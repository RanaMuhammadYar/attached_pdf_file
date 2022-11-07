<?php

namespace App\Http\Controllers;

use PDF;
use Mail;
use Illuminate\Http\Request;


class PDFController extends Controller
{
    public function index()
    {
        $data["email"] = "ranamuhammadyaar9@gmail.com";
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('emails.myTestMail',$data);

        Mail::send('emails.myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });

        dd('Mail sent successfully');
    }
}
