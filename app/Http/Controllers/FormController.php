<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ClientMail;
use App\Mail\NoticeMail;

class FormController extends Controller
{
    public function access(Request $request)
    {
        (new \App\Log)->create(null, null, "Baja del registro", null, "N");
    }
}
