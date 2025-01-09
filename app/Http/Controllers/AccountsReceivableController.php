<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use App\Models\AccountsReceivablePayment;
use App\Models\Customer;
use Illuminate\Http\Request;

class AccountsReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $loans = AccountsReceivable::with('customer')->paginate(15);
        return view('dashboard.customers.loans.index', ['loans' => $loans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = Customer::all();
        return view('dashboard.customers.loans.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => ['numeric', 'decimal:0', 'required'],
            'due_date' => 'required|date',
            'customer_id' => ['numeric', 'integer', 'required'],
        ]);

        AccountsReceivable::create($request->all());

        return redirect()->route('receivable.index')->with('success', 'Loan registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $totalPayed = AccountsReceivablePayment::with('accountsReceivable')->where('accounts_receivable_id', $id)->sum('amount');
        $data = AccountsReceivable::with('customer')->find($id);

        return view('dashboard.customers.loans.show', ['data' => $data, 'totalPayed' => $totalPayed]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $customers = Customer::all();

        $totalPayed = AccountsReceivablePayment::with('accountsReceivable')->where('accounts_receivable_id', $id)->sum('amount');

        $data = AccountsReceivable::find($id);

        return view('dashboard.customers.loans.edit', ['customers' => $customers, 'totalPayed' => $totalPayed, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:pending,paid,overdue',
        ]);


        $data = AccountsReceivable::find($id);

        $data->update($request->all());

        return redirect()->route('receivable.index')->with('success', 'Loan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        AccountsReceivable::destroy($id);
        return redirect()->route('receivable.index')->with('success', 'Loan deleted successfully');
    }
}
