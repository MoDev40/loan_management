<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function overDue()
    {
        $overDueLoans = AccountsReceivable::with('customer')->where('due_date', '<', Carbon::now())
            ->paginate(15);
        
        return view('dashboard.customers.loans.overdate', ["loans" => $overDueLoans]);
    }
}
