<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display the employees list.
     */
    public function get_employees(Request $request): View
    {
        $employees = DB::table('users')
            ->where('active', '=', 1)
            ->where('type', '=', 1)
            ->get();
        ;
        return view('employees.getemployees', [
            'employees' => $employees,
        ]);
    }

    /**
     * Insert the employees information.
     */
    public function insertemployees(Request $request): RedirectResponse
    {
        $updateEmployee= DB::table('users')
            ->insert([
                'name' => $request->Name,
                'email' => $request->Email,
                'phone' => $request->Phone,
                'date_birth' => $request->DateBirth,
                'password' => $request->Password,
                'created_at' => now(),
                'type' => 1,
                'active' => 1,
            ])
        ;

        return Redirect::route('employees.get_employees')->with('status', 'employees-updated');
    }

    /**
     * Update the employees information.
     */
    public function updateemployees(Request $request): RedirectResponse
    {
        $updateEmployee = DB::table('users')
            ->where('id', '=', $request->Employee)
            ->update([
                'name' => $request->Name,
                'email' => $request->Email,
                'phone' => $request->Phone,
                'date_birth' => $request->DateBirth,
                'updated_at' => now(),
                'type' => 1,
                'active' => 1,
            ])
        ;
        if(isset($request->Password)) {
            $updateEmployeePassword = DB::table('users')
                ->where('id', '=', $request->Employee)
                ->update([
                    'password' => Hash::make($request->Password),
                ])
            ;
        }

        return Redirect::route('employees.get_employees')->with('status', 'employees-updated');
    }

    /**
     * Delete the employees account.
     */
    public function destroyemployees(Request $request): RedirectResponse
    {
        $destroyEmployee = DB::table('users')
            ->where('id', '=', $request->Employee)
            ->update([
                'active' => 0,
            ])
        ;

        return Redirect::route('employees.get_employees')->with('status', 'employees-updated');
    }
}
