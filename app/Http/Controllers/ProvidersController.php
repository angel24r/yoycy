<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    /**
     * Display the providers list.
     */
    public function get_providers(Request $request): View
    {
        $providers = DB::table('tt_providers')
            ->where('active', '=', 1)
            ->get();
        ;
        return view('providers.getProviders', [
            'providers' => $providers,
        ]);
    }

    /**
     * Insert the providers information.
     */
    public function insertProviders(Request $request): RedirectResponse
    {
        $updateProvider= DB::table('tt_providers')
            ->insert([
                'name' => $request->Name,
                'business_name' => $request->BusinessName,
                'rfc' => $request->RFC,
                'tax_residence' => $request->TaxResidence,
                'clabe' => $request->CLABE,
                'bank' => $request->Bank,
                'id_currency' => $request->Currency,
                'telephone_office' => $request->OfficePhone,
                'extension' => $request->Extension,
                'celphone' => $request->CellPhone,
                'email' => $request->Email,
                'updated_at' => $request->now(),
            ])
        ;

        return Redirect::route('providers.get_providers')->with('status', 'providers-updated');
    }

    /**
     * Update the providers information.
     */
    public function updateProviders(Request $request): RedirectResponse
    {
        $updateProvider= DB::table('tt_providers')
            ->where('id', '=', $request->Provider)
            ->update([
                'name' => $request->Name,
                'business_name' => $request->BusinessName,
                'rfc' => $request->RFC,
                'tax_residence' => $request->TaxResidence,
                'clabe' => $request->CLABE,
                'bank' => $request->Bank,
                'id_currency' => $request->Currency,
                'telephone_office' => $request->OfficePhone,
                'extension' => $request->Extension,
                'celphone' => $request->CellPhone,
                'email' => $request->Email,
                'updated_at' => $request->now(),
            ])
        ;

        return Redirect::route('providers.get_providers')->with('status', 'providers-updated');
    }

    /**
     * Delete the providers account.
     */
    public function destroyProviders(Request $request): RedirectResponse
    {
        $destroyProvider = DB::table('tt_providers')
            ->where('id', '=', $request->Provider)
            ->update([
                'active' => 0,
            ])
        ;

        return Redirect::route('providers.get_providers')->with('status', 'providers-updated');
    }

}
