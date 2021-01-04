<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class AppointmentController extends Controller
{
    public function create(Request $request) {
    	$schedule = new Schedule;

    	$schedule->user_id = $request->doctor;
    	$schedule->date = $request->date;
    	$schedule->time = $request->time;
    	$schedule->patient_name = $request->name;
    	$schedule->patient_phone_number = $request->phone_number;
    	$schedule->patient_email = $request->email;

    	$schedule->save();
    	
    	session()->flash('success', 'Успешно запазен час.');

    	return redirect()->back();
    }
}
