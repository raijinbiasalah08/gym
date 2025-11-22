<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $member = Auth::user();

        $query = Payment::where('member_id', $member->id);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(10);
        
        return view('member.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        if ($payment->member_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($payment);
    }

    public function makePayment(Request $request, Payment $payment)
    {
        if ($payment->member_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($payment->status !== 'pending') {
            return response()->json([
                'message' => 'Payment is already processed'
            ], 422);
        }

        $request->validate([
            'payment_method' => 'required|in:cash,card,bank_transfer,online',
        ]);

        $payment->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'payment_date' => now(),
        ]);

        return response()->json([
            'message' => 'Payment completed successfully',
            'payment' => $payment
        ]);
    }

    public function paymentHistory()
    {
        $member = Auth::user();
        
        $payments = Payment::where('member_id', $member->id)
            ->select('id', 'amount', 'payment_date', 'status', 'description')
            ->latest()
            ->get();

        return response()->json($payments);
    }
}