<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $data = Company::all();
        return Inertia::render('Company/Index', ['data' => $data]);
    }

    public function create()
    {
        // $types = \App\Models\Company::all()->map->only('id','name');
        $companies = \App\Models\Company::all();
        $comp_first = \App\Models\Company::all('id','name')->first();
        $fiscals = ['June', 'March', 'September', 'December'];

        return Inertia::render('Company/Create',['companies' => $companies, 'comp_first' => $comp_first,
        'fiscals' => $fiscals]);
    }

    public function store()
    {
        Request::validate([
                    // 'type' => ['required'],
                    'name' => ['required'],
                    'address' => ['nullable'],
                    'email' => ['nullable'],
                    'website' => ['nullable'],
                    'phone' => ['nullable'],
                    'fiscal' => ['required'],
                    'incorp' => ['nullable'],
                ]);

        Company::create([
            // 'type_id' => Request::input('type'),
            'name' => Request::input('name'),
            'address' => Request::input('address'),
            'email' => Request::input('email'),
            'website' => Request::input('website'),
            'phone' => Request::input('phone'),
            'fiscal' => Request::input('fiscal'),
            'incorp' => Request::input('incorp'),
            // 'company_id' => 1,
            
        ]);                

    //     Request::validate([
    //         'type' => ['required'],
    //         'name' => ['required'],
    //     ]);

    //     AccountGroup::create([
    //         'type_id' => Request::input('type'),
    //         'name' => Request::input('name'),
    //         'company_id' => 1,
    //     ]);

        return Redirect::route('companies')->with('success', 'Company created.');
    }

    // public function show(AccountGroup $accountgroup)
    // {
    // }

    public function edit(Company $company)
    {
        $companies = \App\Models\Company::all()->map->only('id','name');
        return Inertia::render('Company/Edit', [
            'company' => [
                'id' => $company->id,
                'name' => $company->name,
                'address' => $company->address,
                'email' => $company->email,
                'website' => $company->website,
                'phone' => $company->phone,
                'fiscal' => $company->fiscal,
                'incorp' => $company->incorp,

                // 'type_id' => $accountgroup->type_id,
                // 'name' => $accountgroup->name,
            ],
            'companies' => $companies,
        ]);
    }

    public function update(Company $company)
    {
        // Request::validate([
        //     'type' => ['required'],
        //     'name' => ['required'],
        // ]);
        Request::validate([
            // 'type' => ['required'],
            'name' => ['required'],
            'address' => ['nullable'],
            'email' => ['nullable'],
            'website' => ['nullable'],
            'phone' => ['nullable'],
            'fiscal' => ['required'],
            'incorp' => ['nullable'],
        ]);

        $company->name = Request::input('name');
        $company->address = Request::input('address');
        $company->email = Request::input('email');
        $company->web = Request::input('web');
        $company->phone = Request::input('phone');
        $company->fiscal = Request::input('fiscal');
        $company->incorp = Request::input('incorp');

        // $company->type_id = Request::input('type');
        // $company->name = Request::input('name');
        $company->save();

        return Redirect::route('companies')->with('success', 'Company updated.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return Redirect::back()->with('success', 'Company deleted.');
    }
}
