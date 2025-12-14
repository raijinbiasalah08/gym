<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
{
    /**
     * Display all payment transactions.
     */
    public function index()
    {
        $transactions = PaymentTransaction::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.payments.transactions', compact('transactions'));
    }

    /**
     * Display a specific transaction.
     */
    public function show($id)
    {
        $transaction = PaymentTransaction::with('user')->findOrFail($id);

        return view('admin.payments.show', compact('transaction'));
    }
}
