<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    public function index() {
        $companies = Company::latest()->paginate(15);
        return view('companies.index', compact('companies'));
    }

    public function create() {
        return view('companies.create');
    }

    public function store(Request $r) {
        $r->validate(['name'=>'required']);
        Company::create($r->only(['name','location','website']));
        return redirect()->route('companies.index')->with('success','Company created');
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $r, Company $company) {
        $r->validate(['name'=>'required']);
        $company->update($r->only(['name','location','website']));
        return redirect()->route('companies.index')->with('success','Company updated');
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted');
    }
}
