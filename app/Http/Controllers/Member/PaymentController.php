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

        // Get old payments
        $oldPayments = Payment::where('member_id', $member->id)
            ->when($request->has('status'), function($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()
            ->get()
            ->map(function($payment) {
                return [
                    'id' => $payment->id,
                    'transaction_id' => $payment->transaction_id,
                    'amount' => $payment->amount,
                    'payment_method' => $payment->payment_method,
                    'membership_type' => $payment->membership_type,
                    'status' => $payment->status,
                    'payment_date' => $payment->payment_date,
                    'due_date' => $payment->due_date,
                    'description' => $payment->description,
                    'created_at' => $payment->created_at,
                    'type' => 'old',
                ];
            });

        // Get new payment transactions
        $newPayments = \App\Models\PaymentTransaction::where('user_id', $member->id)
            ->when($request->has('status'), function($q) use ($request) {
                $status = $request->status === 'paid' ? 'completed' : $request->status;
                $q->where('status', $status);
            })
            ->latest()
            ->get()
            ->map(function($transaction) {
                return [
                    'id' => $transaction->id,
                    'transaction_id' => $transaction->transaction_reference,
                    'amount' => $transaction->amount,
                    'payment_method' => $transaction->payment_method,
                    'membership_type' => $transaction->membership_type,
                    'status' => $transaction->status === 'completed' ? 'paid' : $transaction->status,
                    'payment_date' => $transaction->created_at,
                    'due_date' => null,
                    'description' => ucfirst($transaction->membership_type) . ' membership payment',
                    'created_at' => $transaction->created_at,
                    'type' => 'new',
                ];
            });

        // Merge and sort
        $allPayments = $oldPayments->concat($newPayments)
            ->sortByDesc('created_at')
            ->values();

        // Manual pagination
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $pagedData = $allPayments->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $payments = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $allPayments->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
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
            'payment_method' => 'required|in:cash,credit_card,debit_card,bank_transfer,online,face_to_face,mobile_money,check,e_wallet',
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