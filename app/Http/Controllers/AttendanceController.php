<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Attendance\ClockinRequest;
use App\Http\Requests\Attendance\ClockoutRequest;

class AttendanceController extends Controller
{
    protected $service;

    public function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        $me         = Auth::user()->id;
        $attendance = $this->service->index($request, $me);
        $history    = $this->service->history($me);
        $countWeek  = $this->service->countWeek($me);
        $countMonth = $this->service->countMonth($me);
        $countYear  = $this->service->countYear($me);

        return view('attendance', [
            'attendance'    => $attendance,
            'history'       => $history,
            'thisMonth'     => Carbon::now()->format('F'),
            'thisYear'      => Carbon::now()->year,
            'countWeek'     => $countWeek,
            'countMonth'    => $countMonth,
            'countYear'     => $countYear,
        ]);
    }

    public function printAll(){
        $me         = Auth::user()->id;
        $attendance = $this->service->printAll($me);

        return view('attendance-printAll', [
            'attendance'    => $attendance
        ]);
    }

    public function printWeek(){
        $me         = Auth::user()->id;
        $attendance = $this->service->countWeek($me);
        
        return view('attendance-printWeek', [
            'attendance' => $attendance,
        ]);
    }

    public function printMonth(){
        $me         = Auth::user()->id;
        $attendance = $this->service->countMonth($me);
        
        return view('attendance-printMonth', [
            'attendance' => $attendance,
        ]);
    }

    public function printYear(){
        $me         = Auth::user()->id;
        $attendance = $this->service->countYear($me);
        
        return view('attendance-printYear', [
            'attendance' => $attendance,
        ]);
    }

    public function clockin(ClockinRequest $request){
        $me = Auth::user()->id;
        $this->service->clockin($request, $me);
        return Redirect::route('attendance.index')->with('success', 'Morning Report added Successfuly');
    }

    public function clockout(ClockoutRequest $request, $id){
        $me = Auth::user()->id;
        $this->service->clockout($request, $me, $id);
        return Redirect::route('attendance.index')->with('success', 'Afternoon Report added Successfuly');
    }

    // public function history(Request $request)
    // {
    //     $me = Auth::user()->id;
    //     $attendance2 = $this->service->history($request, $me);
    //     return view('attendance', ['attendance2' => $attendance2]);
    // }
}
