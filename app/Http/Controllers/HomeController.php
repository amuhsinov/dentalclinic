<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\WorkingDay as WD;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::get();

        //$wd = User::find($user->id)->WorkingDays()->where('user_id', 1)->first();

        return view('index')->with('users', $users);
    }

    public function allUsers() {
        $users = User::select('id', 'name')->get();

        return view('all-users')->with('users', $users);
    }

    public function userWorkingDays(Request $request) {
        $user_id = $request->user_id;

        $workingDays = User::find($user_id)->workingDays()->select('user_id', 'day_id', 'time_from', 'time_to')->get();

        return view('user-working-days')->with('workingDays', $workingDays);
    }

    public function getScheduleList(Request $request) {
        $user_id = $request->user_id;

        $scheduleList = User::find($user_id)->schedules()->get();

        return view('schedule-list')->with('schedule', $scheduleList);
    }
}
