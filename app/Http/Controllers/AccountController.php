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
    //
    public function index()
    {
        // $data = Account::where('id',2)->first();
        // $groups = Account::all()->map->only('group_id');
        // dd($groups);
        // $groups = \App\Models\AccountGroup::all()->map->only('id','name');
        // $groups = Account::where('id',1);
        // dd($data);
        
        // $group_names = $data->accountGroup()->name;
        // dd($group_names);
        
        // for ($i = 0, $i <= $data.length(), $i++) {
            //     $group_names[$i] = $dat->accountGroup->name;
            // dd($group_names);
            // };
            
            // BY SIR
            // foreach ($data as $dat) {
                //     $group_names = AccountGroup::all();
                //     foreach($group_names as $name){
                    //         $vaa = $name->accountType()->id;
                    //         dd($vaa);
                    //     }
                    //     dd($group_names);
                    // }
                    
                    // $group_names = $data->accountGroup()->name;
                    // $group_names = $groups->accountGroup()->name;
                    // 'group_names' => $group_names
        //             $data = Account::all();
                    
        //             return Inertia::render('Accounts/Index', ['data' => $data,
        // ]);

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

        // return Inertia::render('Branches/Index', [
        //     'data' => BankBranch::all()
        //         ->map(function ($branch){
        //             return [
        //                 'id' => $branch->id,
        //                 'address' => $branch->address,
        //                 'bank_id' => $branch->bank_id,
        //                 'name' => $branch->bank->name,
        //             ];
        //         }), 
        // ]);


    }

    public function create()
    {
        // $types = \App\Models\AccountType::all()->map->only('id','name');
        // $first = \App\Models\AccountType::all('id','name')->first();
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
            // 'type' => ['required'],
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
            // 'company_id' => 1,
            // 'group_id' => 2,
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
