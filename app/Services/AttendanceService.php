<?php 
namespace App\Services;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AttendanceService
{
    public function index($request, $me){
        $query = Attendance::query()->where('user_id', $me)->orderBy('date', 'desc')->latest();

        if($request->has('startdate') && $request->startdate && $request->has('enddate') && $request->enddate){
            $query->whereBetween('date', [date($request->startdate), date($request->enddate)]);
        }

        if($status_clockin = $request->input('status_clockin')){
            $query->where('status_clockin', 'like', $status_clockin.'%');
        }

        if($status_clockout = $request->input('status_clockout')){
            $query->where('status_clockout', 'like', $status_clockout.'%');
        }

        if($request->has('order') && $request->order && $request->has('sort') && $request->sort){
            $query->orderBy($request->order, $request->sort);
        }

        // menghitung absen & hadir 
        $query1 = $query->get();
        $presentclockin = $query1->where('status_clockin', 'present')->count();
        $absenceclockin = $query1->where('status_clockin', 'absence')->count();
        $presentclockout = $query1->where('status_clockout', 'present')->count();
        $absenceclockout = $query1->where('status_clockout', 'absence')->count();

        if ($request->has('limit')) {
            $list = $query->orderBy('date', 'desc')->with(['user'])->paginate($request['limit']);
        } else {
            $list = $query->orderBy('date', 'desc')->with(['user'])->paginate(10);
        }

        $list->presentclockin   = $presentclockin;
        $list->absenceclockin   = $absenceclockin;
        $list->presentclockout  = $presentclockout;
        $list->absenceclockout  = $absenceclockout;

        $list->startdate        = $request->startdate;
        $list->enddate          = $request->enddate;
        $list->order            = $request->order;
        $list->sort             = $request->sort;
        $list->statusclockin    = $request->statusclockin;
        $list->statusclockout   = $request->statusclockout;

        return $list;
    }

    public function printAll($me){
        $query = Attendance::query()->where('user_id', $me);

        // menghitung absen & hadir 
        $query1 = $query->get();
        $presentclockin = $query1->where('status_clockin', 'present')->count();
        $absenceclockin = $query1->where('status_clockin', 'absence')->count();
        $presentclockout = $query1->where('status_clockout', 'present')->count();
        $absenceclockout = $query1->where('status_clockout', 'absence')->count();

        $list = $query->orderBy('date', 'desc')->with(['user'])->get();

        $list->presentclockin   = $presentclockin;
        $list->absenceclockin   = $absenceclockin;
        $list->presentclockout  = $presentclockout;
        $list->absenceclockout  = $absenceclockout;
        $list->startdate        = Attendance::where('user_id', $me)->orderBy('date', 'asc')->first();
        $list->enddate          = Attendance::where('user_id', $me)->orderBy('date', 'desc')->first();

        return $list;
    }

    public function show($id){
        $show = attendance::where('id', $id)->first();
        if ( !$show ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan!'],
        ]); 
        return $show;
    }

    public function countWeek($me){
        $query = Attendance::query()->where('user_id', $me)->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

        // menghitung absen & hadir 
        $query1 = $query->get();
        $presentclockin     = $query1->where('status_clockin', 'present')->count();
        $absenceclockin     = $query1->where('status_clockin', 'absence')->count();
        $presentclockout    = $query1->where('status_clockout', 'present')->count();
        $absenceclockout    = $query1->where('status_clockout', 'absence')->count();

        $list = $query->with(['user'])->get();

        $list->presentclockin   = $presentclockin;
        $list->absenceclockin   = $absenceclockin;
        $list->presentclockout  = $presentclockout;
        $list->absenceclockout  = $absenceclockout;
        $list->startdate        = Attendance::where('user_id', $me)->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('date', 'asc')->first();
        $list->enddate          = Attendance::where('user_id', $me)->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('date', 'desc')->first();

        return $list;
    }

    public function countMonth($me){
        $query = Attendance::query()->where('user_id', $me)->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month);

        // menghitung absen & hadir 
        $query1 = $query->get();
        $presentclockin = $query1->where('status_clockin', 'present')->count();
        $absenceclockin = $query1->where('status_clockin', 'absence')->count();
        $presentclockout = $query1->where('status_clockout', 'present')->count();
        $absenceclockout = $query1->where('status_clockout', 'absence')->count();

        $list = $query->with(['user'])->get();

        $list->presentclockin = $presentclockin;
        $list->absenceclockin = $absenceclockin;
        $list->presentclockout = $presentclockout;
        $list->absenceclockout = $absenceclockout;
        $list->startdate        = Attendance::where('user_id', $me)->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->orderBy('date', 'asc')->first();
        $list->enddate          = Attendance::where('user_id', $me)->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->orderBy('date', 'desc')->first();

        return $list;
    }

    public function countYear($me){
        $query = Attendance::query()->where('user_id', $me)->whereYear('date', Carbon::now()->year);

        // menghitung absen & hadir 
        $query1 = $query->get();
        $presentclockin = $query1->where('status_clockin', 'present')->count();
        $absenceclockin = $query1->where('status_clockin', 'absence')->count();
        $presentclockout = $query1->where('status_clockout', 'present')->count();
        $absenceclockout = $query1->where('status_clockout', 'absence')->count();

        $list = $query->with(['user'])->get();

        $list->presentclockin = $presentclockin;
        $list->absenceclockin = $absenceclockin;
        $list->presentclockout = $presentclockout;
        $list->absenceclockout = $absenceclockout;
        $list->startdate        = Attendance::where('user_id', $me)->whereYear('date', Carbon::now()->year)->orderBy('date', 'asc')->first();
        $list->enddate          = Attendance::where('user_id', $me)->whereYear('date', Carbon::now()->year)->orderBy('date', 'desc')->first();

        return $list;
    }

    public function history($me){
        $list = Attendance::query()->where('user_id', $me)->orderBy('date', 'desc')->latest()->get();
        return $list;
    }

    public function clockin($request, $me){
        $attendance['user_id'] = $me;
        $attendance['date'] = date('Y/m/d');
        $attendance['clockin'] = date('H:i:s');

        if( date('l') == 'Saturday' || date('l') == 'Sunday' )
        {
            return Redirect::route('attendance.index')->with('error', 'Hari libur tidak dapat attendance!');
        }
        elseif( Attendance::where('user_id', $attendance['user_id'])->where('date', $attendance['date'])->first() )
        {
            return Redirect::route('attendance.index')->with('error', 'Anda sudah melakukan attendance!.');
        }
        elseif(strtotime($attendance['clockin']) < strtotime(config('attendance.clockin'). ' -1 hours'))
        {
            return Redirect::route('attendance.index')->with('error', 'attendance dilakukan (7.30)-(8.30)!');
        }
        else
        {
            $attendance['desc_clockin'] = $request->desc_clockin;

            // clockin >= (jam masuk - 1jam) && clockin <= jam masuk
            if(strtotime($attendance['clockin']) >= strtotime(config('attendance.clockin') . ' -1 hours') && strtotime($attendance['clockin']) <= strtotime(config('attendance.clockin'))){
                $attendance['status_clockin'] = 'present';
            // clockin > (jam masuk)  
            }elseif(strtotime($attendance['clockin']) > strtotime(config('attendance.clockin'))){
                $attendance['status_clockin'] = 'absence';

                // menghitung ketrlambatan
                $clockin = Carbon::parse(config('attendance.clockin'));
                $klikclockin = Carbon::parse($attendance['clockin']);
                $attendance['lateness_clockin'] = $clockin->diff($klikclockin)->format('%H:%I:%S');
            }

            // create 
            $create = Attendance::create($attendance);

            return $create;
        }
    }

    public function clockout($request, $me, $id){
        $attendance['user_id'] = $me;
        $attendance['date'] = date('Y/m/d');
        $attendance['clockout'] = date('H:i:s');

        $update = Attendance::where('id', $id)->first();
        $chek1 = Attendance::where('id', $id)->where('user_id', $attendance['user_id'])->where('date', $attendance['date'])->first();
        $chek2 = Attendance::where('clockout', null)->first();
        
        if ( !$update ) 
        {
            return Redirect::route('attendance.index')->with('error', 'Anda belum melakukan attendance masuk!');
        }
        elseif ( !$chek1 ) 
        {
            return Redirect::route('attendance.index')->with('error', 'tidak dapat absen pulang, date & user berbeda!.');
        }
        elseif ( !$chek2 ) 
        {
            return Redirect::route('attendance.index')->with('error', 'Anda sudah melakukan attendance!.');
        }
        elseif(strtotime($attendance['clockout']) < strtotime(config('attendance.clockout'). ' -1 hours'))
        {
            return Redirect::route('attendance.index')->with('error', 'attendance dilakukan (16.15)-(17.15)!');
        }
        else{
            $attendance['desc_clockout'] = $request->desc_clockout;

            // clockout >= (jam pulang-1) && clockout <= clockout
            if(strtotime($attendance['clockout']) >= strtotime(config('attendance.clockout') . ' -1 hours') && strtotime($attendance['clockout']) <= strtotime(config('attendance.clockout'))){
                $attendance['status_clockout'] = 'present';
            // clockout > jam pulang 
            }elseif(strtotime($attendance['clockout']) > strtotime(config('attendance.clockout')) ){
                $attendance['status_clockout'] = 'absence';

                // menghitung keterlambatan
                $clockout = Carbon::parse(config('attendance.clockout'));
                $klikclockout = Carbon::parse($attendance['clockout']);
                $attendance['lateness_clockout'] = $clockout->diff($klikclockout)->format('%H:%I:%S');
            }elseif(strtotime($attendance['clockout']) < strtotime(config('attendance.clockout')) ){
                $attendance['status_clockout'] = null;
            }
            
            // update 
            $update->update($attendance);

            return $update;
        }
    }
}
?>