<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.index', ['user' => $user]);
    }
    public function overDue()
    {
        $overDueLoans = AccountsReceivable::with('customer')->where('due_date', '<', Carbon::now())
            ->paginate(15);

        return view('dashboard.customers.loans.overdue', ["loans" => $overDueLoans]);
    }
}
