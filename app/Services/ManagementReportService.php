<?php 
namespace App\Services;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class ManagementReportService
{
    public function index($request){
        $query = Attendance::query()->orderBy('date', 'desc')->latest();

        if($nama_idUser = $request->input('nama_idUser')){
            $query->where('id', 'like', $nama_idUser.'%')
            ->orWhere(function($query) use ($nama_idUser){
                $query->whereHas('user', function (Builder $query) use ($nama_idUser) {
                    $query->where('name', 'like', $nama_idUser.'%');
                });
            });
        }

        if($request->has('startdate') && $request->startdate && $request->has('enddate') && $request->enddate){
            $query->whereBetween('date', [date($request->startdate), date($request->enddate)]);
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
            $list = $query->with(['user'])->paginate($request['limit']);
        } else {
            $list = $query->with(['user'])->paginate(10);
        }

        $list->presentclockin   = $presentclockin;
        $list->absenceclockin    = $absenceclockin;
        $list->presentclockout  = $presentclockout;
        $list->absenceclockout   = $absenceclockout;

        $list->startdate        = $request->startdate;
        $list->enddate          = $request->enddate;
        $list->order            = $request->order;
        $list->sort             = $request->sort;
        $list->nama_idUser      = $request->nama_idUser;

        return $list;
    }

    public function printAll(){
        $query = Attendance::query();

        // menghitung absen & hadir 
        $query1 = $query->get();
        
        $presentclockin = $query1->where('status_clockin', 'present')->count();
        $absenceclockin = $query1->where('status_clockin', 'absence')->count();
        $presentclockout = $query1->where('status_clockout', 'present')->count();
        $absenceclockout = $query1->where('status_clockout', 'absence')->count();

        $list = $query->orderBy('user_id', 'asc')->with(['user'])->get();

        $list->presentclockin   = $presentclockin;
        $list->absenceclockin   = $absenceclockin;
        $list->presentclockout  = $presentclockout;
        $list->absenceclockout  = $absenceclockout;
        $list->startdate        = Attendance::orderBy('date', 'asc')->first();
        $list->enddate          = Attendance::orderBy('date', 'desc')->first();
       
        return $list;
    }

    public function employees(){
        $employees = User::all();
        return $employees;
    }

    public function countAttendanceByUser($request){
        $query = User::query();

        if($search = $request->input('search')){
            $query->where('name', 'like', $search.'%');
        }

        if($request->has('order') && $request->order && $request->has('sort') && $request->sort){
            $query->orderBy($request->order, $request->sort);
        }

        // menghitung absen & hadir 
        $presentclockin = $query->withCount([
            'attendances',
            'attendances as presentclockin_count' => function (Builder $query) {
                $query->where('status_clockin', 'present');
        }])->get();
        $absentclockin = $query->withCount([
            'attendances',
            'attendances as absenceclockin_count' => function (Builder $query) {
                $query->where('status_clockin', 'absence');
        }])->get();
        $presentclockout = $query->withCount([
            'attendances',
            'attendances as presentclockout_count' => function (Builder $query) {
                $query->where('status_clockout', 'present');
        }])->get();
        $absentclockout = $query->withCount([
            'attendances',
            'attendances as absenceclockout_count' => function (Builder $query) {
                $query->where('status_clockout', 'absence');
        }])->get();
       
        if ($request->has('limit')) {
                $list = $query->paginate( $request['limit'] );
            } else {
                $list = $query->paginate(10);
        }

        $list->presentclockin   = $presentclockin;
        $list->absentclockin    = $absentclockin;
        $list->presentclockout  = $presentclockout;
        $list->absentclockout   = $absentclockout;

        return $list;
    }

    public function store($request){
        $create = Attendance::create($request);
        return $create;
    }   

    public function show($id){
        $show = Attendance::where('id', $id)->first();
        if ( !$show ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan!.'],
        ]); 
        return $show;
    }

    public function update($request, $id){  
        $update = Attendance::where('id', $id)->first();
        if ( !$update ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan!'],
        ]); 
        $update->update($request);
        return $update;
    }

    public function destroy($id){
        $destroy = Attendance::where('id', $id)->first();
        if ( !$destroy ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan!'],
        ]); 
        $destroy->destroy($id);
        return $destroy;
    }   
}   
?>