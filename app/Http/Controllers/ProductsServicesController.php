<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    /**
     * Display the products list.
     */
    public function get_products(Request $request): View
    {
        $products = DB::table('tt_products_services')
            ->where('active', '=', 1)
            ->get();
        ;
        return view('products.getproducts', [
            'products' => $products,
        ]);
    }

    /**
     * Insert the products information.
     */
    public function insertproducts(Request $request): RedirectResponse
    {
        $updateProduct= DB::table('tt_products_services')
            ->insert([
                'type' => $request->Type,
                'title' => $request->Title,
                'description' => $request->Description,
                'id_unit_of_measurement' => $request->UnitOfMeasurement,
                'id_providers' => $request->Provider,
                'service_time' => $request->ServiceTime,
                'price' => $request->Price,
                'id_currency' => $request->Currency,
                'id_tax' => $request->Tax,
            ])
        ;

        return Redirect::route('products.get_products')->with('status', 'products-updated');
    }

    /**
     * Update the products information.
     */
    public function updateproducts(Request $request): RedirectResponse
    {
        $updateProduct= DB::table('tt_products_services')
            ->where('id', '=', $request->Product)
            ->update([
                'type' => $request->Type,
                'title' => $request->Title,
                'description' => $request->Description,
                'id_unit_of_measurement' => $request->UnitOfMeasurement,
                'id_providers' => $request->Provider,
                'service_time' => $request->ServiceTime,
                'price' => $request->Price,
                'id_currency' => $request->Currency,
                'id_tax' => $request->Tax,
            ])
        ;

        return Redirect::route('products.get_products')->with('status', 'products-updated');
    }

    /**
     * Delete the products account.
     */
    public function destroyproducts(Request $request): RedirectResponse
    {
        $destroyProduct = DB::table('tt_products_services')
            ->where('id', '=', $request->Product)
            ->update([
                'active' => 0,
            ])
        ;

        return Redirect::route('products.get_products')->with('status', 'products-updated');
    }
}
