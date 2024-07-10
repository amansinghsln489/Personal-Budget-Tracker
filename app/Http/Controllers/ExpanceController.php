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


class ExpanceController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expance.expance_index', compact('expenses'));
          
    }
    public function incomeExpance(Request $request)
    {
        
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amaount' => 'required|numeric',
            'date' => 'required|date',
            'status' => 'required|in:1,0',
        ]);

        
        Expense::create([
            'description' => $validatedData['description'],
            'amount' => $validatedData['amaount'],
            'date' => $validatedData['date'],
            'status' => $validatedData['status'],
        ]);    
        return redirect('/index')->with('success', 'created  successful!');
    }
    public function editExpense($expenseId)
    {
        
        $expense = Expense::find($expenseId);

        if (!$expense) {
            return response()->json(['error' => 'Expense not found'], 404);
        }

        // Return expense details as JSON response
        return response()->json($expense);
    }
    public function updateExpense(Request $request )
    {
      
        $expense = Expense::find($request->input('expense_id'));
        $expense->update($request->all());
       
        return redirect('/index')->with('success', 'Updated successfully!');
    }
    public function deleteExpense(Request $request)
    {
        
      
            $expense = Expense::findOrFail($request->input('expence_delete_id'));
            $expense->delete();
    
            return redirect('/index')->with('success', 'created  successful!');
     
    }
    
} 