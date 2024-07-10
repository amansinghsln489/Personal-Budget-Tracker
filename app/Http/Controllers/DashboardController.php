<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;


class DashboardController extends Controller
{
    public function index()
    {
        $income = Expense::where('status', 1)->sum('amount');
        $expense = Expense::where('status', 0)->sum('amount');
        $total = $income - $expense;
        return view('dashboard', compact('income', 'expense', 'total'));
          
    }
} 
