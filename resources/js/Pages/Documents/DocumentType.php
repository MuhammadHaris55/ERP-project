<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\DocumentType;
use Inertia\Inertia;

class DocumentType extends Controller
{
    //
    public function index()
    {
        $data = DocumentType::all();
        return Inertia::render('DocumentTypes/Index', ['data' => $data]);
    }

    public function create()
    {
        $types = \App\Models\AccountType::all()->map->only('id','name');
        $first = \App\Models\AccountType::all('id','name')->first();

        $companies = \App\Models\Company::all()->map->only('id','name');
        $comp_first = \App\Models\Company::all('id','name')->first();

        return Inertia::render('DocumentTypes/Create',['types' => $types, 'first' => $first,
        'companies' => $companies, 'comp_first' => $comp_first]);
    }

    public function store()
    {
        Request::validate([
            'type' => ['required'],
            'name' => ['required'],
            'company' => ['required'],

        ]);

        DocumentType::create([
            'type_id' => Request::input('type'),
            'name' => Request::input('name'),
            'company_id' => Request::input('company'),
        ]);

        return Redirect::route('documenttypes')->with('success', 'Document Type created.');
    }

    public function show(DocumentType $documenttype)
    {
    }

    public function edit(DocumentType $documenttype)
    {
        $types = \App\Models\AccountType::all()->map->only('id','name');
        $companies = \App\Models\Company::all()->map->only('id','name');
        return Inertia::render('DocumentTypes/Edit', [
            'accountgroup' => [
                'id' => $documenttype->id,
                'type_id' => $documenttype->type_id,
                'name' => $documenttype->name,
                'company_id' => $documenttype->company_id,
            ],
            'types' => $types,
            'companies' => $companies,
        ]);
    }

    public function update(DocumentType $documenttype)
    {
        Request::validate([
            'type' => ['required'],
            'name' => ['required'],
            'company' => ['required'],

        ]);

        $documenttype->type_id = Request::input('type');
        $documenttype->name = Request::input('name');
        $documenttype->company_id = Request::input('company');
        $documenttype->save();

        return Redirect::route('documenttype')->with('success', 'Document Type updated.');
    }

    public function destroy(DocumentType $documenttype)
    {
        $documenttype->delete();
        return Redirect::back()->with('success', 'Document Type deleted.');
    }
}
