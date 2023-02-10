<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee', [
            'companies' => Employee::paginate(10)
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'company_id' => ['integer', 'required'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        try{
            $employee = new Employee();
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->company = $request->company_id;
            $employee->phone = $request->phone;

            //upload file her
            $employee->save();
            return redirect()->back()->with('success', 'You have added employee successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => ['required', 'numeric'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'company_id' => ['integer', 'required'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        try{
            $employee = Employee::find($request->employee_id);
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->company = $request->company_id;
            $employee->phone = $request->phone;

            //upload file her
            $employee->save();
            return redirect()->back()->with('success', 'You have updated employee successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'employee_id' => ['required', 'numeric']
        ]);

        try{
            $employee = employee::find($request->employee_id);
            //upload file her
            $employee->delete();
            return redirect()->back()->with('success', 'You have deleted employee successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }
}
