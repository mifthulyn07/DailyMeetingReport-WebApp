<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Attendance\ClockinRequest;
use App\Http\Requests\Attendance\ClockoutRequest;
use App\Services\ManagementReportService;

class DashboardController extends Controller
{
    protected $attendanceService;
    protected $userService;
    protected $managementReportService;

    public function __construct(UserService $userService, AttendanceService $attendanceService, ManagementReportService $managementReportService)
    {
        $this->userService              = $userService;
        $this->attendanceService        = $attendanceService;
        $this->managementReportService  = $managementReportService;

    }

    public function index(Request $request)
    {
        $me             = Auth::user()->id;
        $attendance     = $this->attendanceService->index($request, $me);
        $history        = $this->attendanceService->history($me);
        $countWeek      = $this->attendanceService->countWeek($me);
        $countMonth     = $this->attendanceService->countMonth($me);
        $countYear      = $this->attendanceService->countYear($me);
        $countUser      = $this->userService->countUser();
        $attendance1    = $this->managementReportService->index($request);

        return view('dashboard', [
            'attendance'    => $attendance,
            'history'       => $history,
            'thisMonth'     => Carbon::now()->format('F'),
            'thisYear'      => Carbon::now()->year,
            'countWeek'     => $countWeek,
            'countMonth'    => $countMonth,
            'countYear'     => $countYear,
            'countUser'     => $countUser,
            'attendance1'   => $attendance1,    
        ]);
    }

    public function clockin(ClockinRequest $request)
    {
        $me = Auth::user()->id;
        $this->attendanceService->clockin($request, $me);
        return Redirect::route('attendance.index')->with('success', 'Morning Report added Successfuly');
    }

    public function clockout(ClockoutRequest $request, $id)
    {
        $me = Auth::user()->id;
        $this->attendanceService->clockout($request, $me, $id);
        return Redirect::route('attendance.index')->with('success', 'Afternoon Report added Successfuly');
    }

}
