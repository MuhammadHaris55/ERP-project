<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Document;
use App\Models\DocumentType;
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
                        // 'type_name' => $document->accountType->name,
                    ];
                }), 
        ]);

    }

    public function create()
    {
        // $doc_types = \App\Models\DocumentType::all()->map->only('id','name','prefix');
        // $doc_first = \App\Models\DocumentType::all('id','name','prefix')->first();

        // $doc_types = \App\Models\DocumentType::all();
        // $doc_first = \App\Models\DocumentType::all()->first();
        // $refe = \App\Models\DocumentType::all('prefix')->first();
        
        // $account_types = \App\Models\AccountType::all()->map->only('id','name');
        // $account_first = \App\Models\AccountType::all('id','name')->first();

        $account_groups = \App\Models\AccountGroup::all()->map->only('id','name');
        $account_first = \App\Models\AccountGroup::all('id','name')->first();

        $companies = \App\Models\Company::all()->map->only('id','name');
        $comp_first = \App\Models\Company::all('id','name')->first();

        $years = \App\Models\Year::all()->map->only('id','begin', 'end');
        $year_first = \App\Models\Year::all('id','begin', 'end')->first();

        // 'account_types' => $account_types, 'account_first' => $account_first,
        // 'doc_types' => $doc_types, 'doc_first' => $doc_first,
        // 'refe' => $refe,
        // 'companies' => $companies, 'comp_first' => $comp_first,
       
        // return Inertia::render('Documents/Index', [
        //     'data' => Document::all()
        //         ->map(function ($document){
        //             return [
        //                 'id' => $document->id,
        //                 'ref' => $document->ref,
        //                 'description' => $document->description,
        //                 'type_id' => $document->type_id,
        //                 'company_id' => $document->company_id,
        //                 'year_id' => $document->year_id,
        //                 'type_name' => $document->accountType->name,
        //             ];
        //         }), 
        // ]);

        // 'custom_object' = DocumentType::all()
        
            // dd($custom_object);

        return Inertia::render('Documents/Create',[ 
            'companies' => $companies, 'comp_first' => $comp_first,

            'account_groups' => $account_groups, 'account_first' => $account_first,

            // 'account_types' => $doc_types, 'account_first' => $doc_first,

            'years' => $years, 'year_first' => $year_first,

            'custom_object' => DocumentType::all()
                ->map(function ($doc_type){
                    return [
                    'id' => $doc_type->id,
                    'name' => $doc_type->name,
                    'ref' => $doc_type->prefix. "/" .$doc_type->timestamps,
                    // 'company_id' => $doc_type->company_id,
                    // 'company_name' => $doc_type->company->name,
                ];
            }),
            

            ]);
        }

    public function store(Req $request)
    {
        Request::validate([
            // 'accounts.*.type_id' => ['required'],
            'type_id' => ['required'],
            'company_id' => ['required'],
            'date' => ['required', 'date'],
            'ref' => ['required'],
            'description' => ['required'],
            'year_id' => ['required'],

            // 'balances.*.company_id' => ['required'],
            // 'balances.*.account_id' => ['required'],
            // 'balances.*.year_id' => ['required'],
        ]);
        // foreach($request->accounts as $acconut){
            Document::create([
                // 'type_id' => $acconut['type_id'],
                'type_id' => Request::input('type_id'),
                'company_id' => Request::input('company_id'),
                'description' => Request::input('description'),
                'ref' => Request::input('ref'),
                'date' => Request::input('date'),
                'year_id' => Request::input('year_id'),
                // 'date' => Request::input('date'),
                
                // 'ledger' => $balance['ledger'],
                // 'statement' => $balance['statement'],
                // 'confirmation' => $balance['confirmation'],
                // 'company_id' => $balance['company_id'],
                // 'account_id' => $balance['account_id'],
                // 'year_id' => $balance['year_id'],
            ]);
        // }

        return Redirect::route('documents')->with('success', 'Transaction created.');
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

    public function destroy(Account $account)
    {
        $account->delete();
        return Redirect::back()->with('success', 'Transaction deleted.');
    }
}
