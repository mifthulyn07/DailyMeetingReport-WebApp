<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\ManagementReportService;
use App\Http\Requests\ManagementReport\StoreAttendanceRequest;
use App\Http\Requests\ManagementReport\UpdateAttendanceRequest;

class ManagementReportController extends Controller
{
    protected $service;

    public function __construct(ManagementReportService $service)
{
        $this->service = $service;
    }

    public function index(Request $request){
        $attendance = $this->service->index($request);
        $employees = $this->service->employees();
        
        return view('managementReport', [
            'attendance' => $attendance,
            'employees' => $employees,
        ]);
    }

    public function printAll(){
        $attendance = $this->service->printAll();
        
        return view('managementReport-printAll', [
            'attendance' => $attendance,
        ]);
    }

    public function store(StoreAttendanceRequest $request){
        $this->service->store($request->all());
        return Redirect::route('managementReport.index')->with('success', 'Attedance added Successfuly');
    }

    public function show($id){
        $attendance = $this->service->show($id);
        return $attendance;
    }

    public function update(UpdateAttendanceRequest $request, $id){
        $this->service->update($request->all(), $id);
        return Redirect::route('managementReport.index')->with('success', 'Attedance updated Successfuly');
    }

    public function destroy($id){
        $this->service->destroy($id);
        return Redirect::route('managementReport.index')->with('success', 'Attedance deleted Successfuly');
    }
}