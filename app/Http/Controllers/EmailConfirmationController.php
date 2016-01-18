<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Tempdonor as TempDonor;
use \App\Donor as Donor;
use App\VerificationBox\Verifier\VerifierClass as Verifier;


class EmailConfirmationController extends Controller
{

    public function index(Request $request, Verifier $verifier, TempDonor $temp_donor, Donor $donor)
    {

        $verifier->setIdentifiers(['id' => $request->id, 'confirm_code' => $request->confirm_code]);
        $verifier->verify($temp_donor, $donor);
        return view('emailredirect.confirm');

    }
}
