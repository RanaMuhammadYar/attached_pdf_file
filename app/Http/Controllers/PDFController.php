<?php

namespace App\Http\Controllers;

use PDF;
use Mail;
use Illuminate\Http\Request;


class PDFController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 180);
        // return view('emails.htmlchart');
        $data["email"] = "ranamuhammadyaar9@gmail.com";
        $data["title"] = "From Muhammad Yar";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('emails.htmlchart',$data);
            //  return $pdf->download('chart.pdf');
        return $pdf->stream('test.pdf');

        Mail::send('emails.myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });

        dd('Mail sent successfully');
    }
}
