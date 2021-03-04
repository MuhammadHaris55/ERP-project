<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Document;
use Inertia\Inertia;

class DocumentController extends Controller
{
    //
    public function index()
    {
        // $data = AccountGroup::all();
        // return Inertia::render('AccountGroups/Index', ['data' => $data]);

        return Inertia::render('Documents/Index', [
            'data' => Document::all()
                ->map(function ($document){
                    return [
                        'id' => $document->id,
                        'ref' => $document->ref,
                        'description' => $document->description,
                        'type_id' => $document->type_id,
                        'company_id' => $document->company_id,
                        'year_id' => $document->year_id,
                        'type_name' => $document->accountType->name,
                    ];
                }), 
        ]);

    }

    public function create()
    {
        $doc_types = \App\Models\DocumentType::all()->map->only('id','name');
        $doc_first = \App\Models\DocumentType::all('id','name')->first();
        
        $account_types = \App\Models\AccountType::all()->map->only('id','name');
        $account_first = \App\Models\AccountType::all('id','name')->first();

        $companies = \App\Models\Company::all()->map->only('id','name');
        $comp_first = \App\Models\Company::all('id','name')->first();

        return Inertia::render('Documents/Create',[
            'account_types' => $account_types, 'account_first' => $account_first,
            'doc_types' => $doc_types, 'doc_first' => $doc_first,
        'companies' => $companies, 'comp_first' => $comp_first
        ]);
    }

    public function store()
    {
        // Request::validate([
        //     'type' => ['required'],
        //     'name' => ['required'],
        //     'company' => ['required'],

        // ]);

        // AccountGroup::create([
        //     'type_id' => Request::input('type'),
        //     'name' => Request::input('name'),
        //     'company_id' => Request::input('company'),
        // ]);

        // return Redirect::route('accountgroups')->with('success', 'Account Group created.');
    }

    public function show(AccountGroup $accountgroup)
    {
    }

    public function edit(AccountGroup $accountgroup)
    {
        // $types = \App\Models\AccountType::all()->map->only('id','name');
        // $companies = \App\Models\Company::all()->map->only('id','name');
        // return Inertia::render('AccountGroups/Edit', [
        //     'accountgroup' => [
        //         'id' => $accountgroup->id,
        //         'type_id' => $accountgroup->type_id,
        //         'name' => $accountgroup->name,
        //         'company_id' => $accountgroup->company_id,
        //     ],
        //     'types' => $types,
        //     'companies' => $companies,
        // ]);
    }

    public function update(AccountGroup $accountgroup)
    {
        // Request::validate([
        //     'type' => ['required'],
        //     'name' => ['required'],
        //     'company' => ['required'],

        // ]);

        // $accountgroup->type_id = Request::input('type');
        // $accountgroup->name = Request::input('name');
        // $accountgroup->company_id = Request::input('company');
        // $accountgroup->save();

        // return Redirect::route('accountgroups')->with('success', 'Account Group updated.');
    }

    public function destroy(AccountGroup $accountgroup)
    {
        // $accountgroup->delete();
        // return Redirect::back()->with('success', 'Account Group deleted.');
    }
}
