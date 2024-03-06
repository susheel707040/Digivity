<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Hash;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('user.addUser');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public static function store(Request $request)
    {
       $validate = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:tenants,email',
            'dname'=>'required|string|max:255|unique:domains,domain',

       ]);

       $tenant = Tenant::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password,
       ]);
       $tenant->domains()->create([
        'domain'=>$request->dname.'.'.config('app.domain')
       ]);

       return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Tenant $tenant,$id)
    {
        // Fetch the tenant details along with associated domain
        $tenantWithDomain = Tenant::with('domain')->findOrFail($tenant->id);

        return view('user.edit', compact('tenantWithDomain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->domains()->delete();

        // Delete the tenant
        $tenant->delete();

        return redirect()->route('dashboard')->with('success', 'Tenant deleted successfully.');

    }
}

