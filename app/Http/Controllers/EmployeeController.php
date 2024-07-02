<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getEmployees()
    {
        $departments = Department::all();
        $jobTitles = JobTitle::all();
        return view("index", compact("jobTitles", "departments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'NIK' => 'required|alpha_num|size:6',
            'jobTitleID' => 'required|exists:job_titles,id',
            'gender' => 'required|in:M,F',
            'placeOfBirth' => 'required|max:100',
            'dateOfBirth' => 'required|date',
            'hireDate' => 'required|date',
            'address' => 'required',
            'phone' => 'required|numeric|max:20',
            'email' => 'required|email|max:128'
        ]);

        Employee::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'NIK' => $request->NIK,
            'jobTitleID' => $request->jobTitleID,
            'gender' => $request->gender,
            'placeOfBirth' => $request->placeOfBirth, 
            'dateOfBirth' => $request->dateOfBirth, 
            'hireDate' => $request->hireDate, 
            'address' => $request->address, 
            'phone' => $request->phone, 
            'email' => $request->email, 
        ]);

        return redirect()->route('employees')->with('success', 'Employee added successfully!');
    }

    public function getEmployeesData()
    {
        $data = Employee::with(['jobTitle', 'department'])->select('employees.*');  // Pastikan Anda memilih kolom-kolom yang diperlukan
        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('hireDate', function ($employee) {
                return \Carbon\Carbon::parse($employee->hireDate)->format('d-m-Y');
            })
            ->editColumn('dateOfBirth', function ($employee) {
                return \Carbon\Carbon::parse($employee->dateOfBirth)->format('d-m-Y');
            })
            ->addColumn('department.departmentName', function (Employee $employee) {
                return $employee->department ? $employee->department->departmentName : 'N/A';
            })
            ->addColumn('jobTitle.jobTitleName', function (Employee $employee) {
                return $employee->jobTitle ? $employee->jobTitle->jobTitleName : 'N/A';
            })
            ->make(true);
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::with(['jobTitle', 'department'])->find($id);
        if (!$employee) {
            return redirect()->route('employees')->with('error', 'Employee not found');
        }
        return response()->json($employee);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::with(['jobTitle', 'department'])->find($id);
        return response()->json($employee);
    }    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'NIK' => 'required|alpha_num|size:6',
            'jobTitleID' => 'required|exists:job_titles,id',
            'gender' => 'required|in:M,F',
            'placeOfBirth' => 'required|max:100',
            'dateOfBirth' => 'required|date',
            'hireDate' => 'required|date',
            'address' => 'required',
            'phone' => 'required|numeric|max:99999999999999999999',
            'email' => 'required|email|max:128'
        ]);

        $employee->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'NIK' => $request->NIK,
            'jobTitleID' => $request->jobTitleID,
            'gender' => $request->gender,
            'placeOfBirth' => $request->placeOfBirth,
            'dateOfBirth' => $request->dateOfBirth,
            'hireDate' => $request->hireDate,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('employees')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'error'], 404);
    }
    
    
}
