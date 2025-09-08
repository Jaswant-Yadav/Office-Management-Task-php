<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
    public function index() {
        $companies = Company::all();
        return view('employees.index', compact('companies'));
    }

    public function create() {
        $companies = Company::all();
        $managers = Employee::all();
        return view('employees.create', compact('companies','managers'));
    }

    public function store(Request $r) {
        $r->validate([
            'first_name'=>'required',
            'email'=>'required|email|unique:employees,email',
        ]);
        Employee::create($r->all());
        return redirect()->route('employees.index')->with('success','Employee created');
    }

    public function edit(Employee $employee) {
        $companies = Company::all();
        $managers = Employee::where('id','!=',$employee->id)->get();
        return view('employees.edit', compact('employee','companies','managers'));
    }

    public function update(Request $r, Employee $employee) {
        $r->validate([
            'first_name'=>'required',
            'email'=>"required|email|unique:employees,email,{$employee->id}",
        ]);
        $data = $r->all();
        if ($data['manager_id'] == $employee->id) $data['manager_id'] = null;
        $employee->update($data);
        return redirect()->route('employees.index')->with('success','Employee updated');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee deleted');
    }

    public function data(Request $r) {
        $query = Employee::with(['company','manager']);
        if ($r->filled('company')) $query->where('company_id',$r->company);
        if ($r->filled('position')) $query->where('position','like','%'.$r->position.'%');
        if ($r->filled('search')) {
            $s = $r->search;
            $query->where(function($q) use($s){
                $q->where('first_name','like',"%$s%")
                  ->orWhere('last_name','like',"%$s%")
                  ->orWhere('email','like',"%$s%");
            });
        }
        $employees = $query->get();
        $data = $employees->map(fn($e)=>[
            'id'=>$e->id,
            'name'=>$e->full_name,
            'email'=>$e->email,
            'position'=>$e->position,
            'company'=>$e->company?->name,
            'manager'=>$e->manager?->full_name,
            'country'=>$e->country,
            'state'=>$e->state,
            'city'=>$e->city,
            'actions'=> view('employees.partials.actions',['employee'=>$e])->render()
        ]);
        return response()->json(['data'=>$data]);
    }
}
