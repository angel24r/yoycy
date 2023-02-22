<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomersUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use DB;

class CustomersController extends Controller
{
    /**
     * Display the customer´s list.
     */
    public function getCustomers(Request $request): View
    {
        $customers = DB::table('users')
            ->where('type', '=', 0)
            ->where('active', '=', 1)
            ->get();
        ;
        return view('customers.getCustomers', [
            'customers' => $customers,
        ]);
    }

    /**
     * Update the customers information.
     */
    public function updateCustomers(Request $request): RedirectResponse
    {
        $updateCustomer = DB::table('users')
            ->where('id', '=', $request->Customer)
            ->update([
                'name' => $request->Name,
                'email' => $request->Email,
                'phone' => $request->Phone,
                'date_birth' => $request->DateBirth,
                'updated_at' => now(),
                'type' => $request->Permission,
                'active' => $request->Active,
            ])
        ;

        return Redirect::route('customers.getCustomers')->with('status', 'customers-updated');
    }

    /**
     * Delete the customer's account.
     */
    public function destroyCustomers(Request $request): RedirectResponse
    {
        $destroyCustomer = DB::table('users')
            ->where('id', '=', $request->Customer)
            ->delete()
        ;

        return Redirect::route('customers.getCustomers')->with('status', 'customers-updated');
    }
    
}
