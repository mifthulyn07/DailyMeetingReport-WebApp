<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request){
        $employees = $this->service->index($request);
        return view('employees', [
            'employees'     => $employees,
            'role'          => Auth::user()->role,
        ]);
    }

    public function print(){
        $employees = $this->service->print();
        return view('employees-print', [
            'employees'     => $employees,
        ]);
    }
    
    public function store(StoreUserRequest $request){
        $this->service->store($request);
        return Redirect::route('employees.index')->with('success', 'Employee added Successfuly');
    }

    public function show($id){
        $employee = $this->service->show($id);
        return $employee;
    }

    public function update(UpdateUserRequest $request, $id){
        $this->service->update($request, $id);
        return Redirect::route('employees.index')->with('success', 'Employee updated Successfuly');
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect()->route('employees.index')->with('success','Employees deleted successfully');
    }
}
