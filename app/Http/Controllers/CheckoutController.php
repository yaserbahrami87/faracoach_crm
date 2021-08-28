<?php

namespace App\Http\Controllers;

use App\checkout;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;





class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // At the top of the file.



        // Create new invoice.
        $invoice = (new Invoice)->amount(1000);
        // Purchase and pay the given invoice.
        // You should use return statement to redirect user to the bank page.
        return Payment::purchase($invoice, function($driver, $transactionId) {
            // Store transactionId in database as we need it to verify payment in the future.
        })->pay()->render();

        // Do all things together in a single line.
        return Payment::purchase(
            (new Invoice)->amount(1000),
            function($driver, $transactionId) {
                // Store transactionId in database.
                // We need the transactionId to verify payment in the future.
            }
        )->pay()->render();

        // Retrieve json format of Redirection (in this case you can handle redirection to bank gateway)
        return Payment::purchase(
            (new Invoice)->amount(1000),
            function($driver, $transactionId) {
                // Store transactionId in database.
                // We need the transactionId to verify payment in the future.
            }
        )->pay()->toJson();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(checkout $checkout)
    {
        //
    }
}
