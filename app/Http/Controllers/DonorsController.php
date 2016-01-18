<?php

namespace App\Http\Controllers;

use App\Tempdonor;
use App\Donor;
use App\VerificationBox\EmailSender\EmailSender;
use Illuminate\Support\Facades\View;
use Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Mockery\CountValidator\Exception;

class DonorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create','sendMail']]);

    }

    public function filterDonors(Request $request) {
        //
        if($request->blood === "All") {
            $donors_by_blood = Donor::all()->toArray();
        } else {
            $blood_id = \App\Blood::where("blood", $request->blood)->first();
            $blood_id = $blood_id->id;
            $donors_by_blood = Donor::where("blood_id", $blood_id)->get();
        }
        $final_donors = [];
        if ($request->governorate === "All") {
            $final_donors = $donors_by_blood;
        } else {
            $gov_id = \App\Governorate::where("governorate", $request->governorate)->first();
            $gov_id = $gov_id->id;

            foreach ($donors_by_blood as $donor) {
                if ($donor['governorate_id'] === $gov_id) {
                    array_push($final_donors, $donor);
                }
            }
        }
        for($i = 0; $i < count($final_donors); $i++) {
            $blood_type = \App\Blood::find($final_donors[$i]['blood_id'])->blood;
            $final_donors[$i]["blood_type"] = $blood_type;

            $governorate = \App\Governorate::find($final_donors[$i]['governorate_id'])->governorate;
            $final_donors[$i]["governorate"] = $governorate;
        }


//        dd($final_donors);
        return response()->json($final_donors);
    }
    public function index()
    {
        //
        $govs = \DB::table('governorates')->lists('governorate');
        $bloods = \DB::table('bloods')->lists('blood');
        return view('admin.main', compact("govs", "bloods"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donors.create');
    }

    /**
     * @param Requests\StoreDonorRequest $request
     * @param EmailSender $email_sender
     * @param Tempdonor $temp_donor
     * @return mixed
     */
    public function sendMail(Requests\StoreDonorRequest $request, EmailSender $email_sender, Tempdonor $temp_donor, Donor $donor) {

        if($email_sender->confirmedMail($donor, ['email', $request->email])) {
            $response = $email_sender->sendMail($temp_donor, $request->all(), $request->email, $request->fullName('first_name', 'last_name'));
        } else {
            $response = 'Email already here';
        }

        return response()->json(['success' => $response]);

    }

    public function store(Request $request)
    {
        \App\Donor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $donor = Donor::find($id);
        $gov = \App\Governorate::find($donor->governorate_id)->governorate;
        $blood_type = \App\Blood::find($donor->blood_id)->blood;
        return view('admin.show', compact("donor", "gov", "blood_type"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Donor::destroy($id);
        return redirect(action('DonorsController@index'));
    }
}
