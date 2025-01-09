<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivablePayment;
use Illuminate\Http\Request;

class AccountsReceivablePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = AccountsReceivablePayment::paginate(12);
        return view('dashboard.customers.payment.index', ['payments' =>  $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'accounts_receivable_id' => 'required|exists:accounts_receivable,id',
        ]);

        AccountsReceivablePayment::create($request->all());

        return redirect()->route('receivable.show', $request->accounts_receivable_id)->with('success', "Your payment has been successfully processed");
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountsReceivablePayment $accountsReceivablePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = AccountsReceivablePayment::find($id);

        $instance = AccountsReceivablePayment::with('accountsReceivable')->where('accounts_receivable_id', $data->accounts_receivable_id);

        $loan = $instance->get()[0]->accountsReceivable->amount;

        $totalPayed = $instance->sum('amount');

        $max_exp_amount = ($loan + $data->amount) - $totalPayed;

        return view('dashboard.customers.payment.edit', ['payment' => $data, 'max_exp_amount' => $max_exp_amount]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $inst = AccountsReceivablePayment::find($id);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'accounts_receivable_id' => 'required|exists:accounts_receivable,id',
        ]);

        $inst->update($request->all());

        return redirect()->route('accounts_receive.index')->with('success', "Your payment has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        AccountsReceivablePayment::destroy($id);
        return redirect()->route('accounts_receive.index')->with('success', "Your payment has been deleted successfully");
    }
}
