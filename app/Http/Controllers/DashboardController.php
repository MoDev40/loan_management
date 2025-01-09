<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use App\Models\AccountsReceivablePayment;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::all()->count();
        $sumOfLoans = AccountsReceivable::all()->sum('amount');
        $sumOfReceived = AccountsReceivablePayment::all()->sum('amount');

        return view('dashboard.index', ['totalCustomers' => $totalCustomers, 'sumOfLoans' => $sumOfLoans, 'sumOfReceived' => $sumOfReceived]);
    }
    public function overDue()
    {
        $overDueLoans = AccountsReceivable::with('customer')->where('due_date', '<', Carbon::now())
            ->paginate(15);

        return view('dashboard.customers.loans.overdue', ["loans" => $overDueLoans]);
    }

    public function users()
    {
        return view('dashboard.users.index');
    }
}
