<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Account;
use App\Models\AccountGroup;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'data' => Account::all()
                ->map(function ($account){
                    return [
                        'id' => $account->id,
                        'name' => $account->name,
                        'group_id' => $account->group_id,
                        'group_name' => $account->accountGroup->name,
                    ];
                }), 
        ]);
   }

    public function create()
    {
        $groups = \App\Models\AccountGroup::all()->map->only('id','name');
        $group_first = \App\Models\AccountGroup::all('id','name')->first();

        $companies = \App\Models\Company::all()->map->only('id','name');
        $comp_first = \App\Models\Company::all('id','name')->first();
        
        return Inertia::render('Accounts/Create',[
            'companies' => $companies, 'comp_first' => $comp_first,
            'groups' => $groups, 'group_first' => $group_first,
            'group_names' => $group_names
         ]);
    }

    public function store()
    {
        Request::validate([
            'name' => ['required'],
            'number' => ['nullable'],
            'group' => ['required'],
            'company' => ['required'],
        ]);

        Account::create([
            'name' => Request::input('name'),
            'number' => Request::input('number'),
            'group_id' => Request::input('group'),
            'company_id' => Request::input('company'),
            ]);

        return Redirect::route('accounts')->with('success', 'Account created.');
    }

    // public function show(AccountGroup $accountgroup)
    // {
    // }

    public function edit(Account $account)
    {
        $companies = \App\Models\Company::all()->map->only('id','name');
        $groups = \App\Models\AccountGroup::all()->map->only('id','name');
        return Inertia::render('Accounts/Edit', [
            'account' => [
                'id' => $account->id,
                'company_id' => $account->company_id,
                'group_id' => $account->group_id,
                'name' => $account->name,
                'number' => $account->number,
            ],
            'companies' => $companies,
            'groups' => $groups,
        ]);
    }

    public function update(Account $account)
    {
        Request::validate([
            'group' => ['required'],
            'company' => ['required'],
            'number' => ['nullable'],
            'name' => ['required'],
        ]);
        $account->group_id = Request::input('group');
        $account->company_id = Request::input('company');
        $account->number = Request::input('number');
        $account->name = Request::input('name');
        $account->save();

        return Redirect::route('accounts')->with('success', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return Redirect::back()->with('success', 'Account deleted.');
    }
}