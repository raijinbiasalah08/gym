<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Process a payment (simulated).
     */
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:visa,mastercard,amex,jcb,gcash,paymaya,alipay,wechat,bdo,bancnet,tendopay,paypal,cash',
            'amount' => 'required|numeric|min:0',
            'membership_type' => 'required|in:basic,premium,vip',
            'payment_details' => 'nullable|array',
        ]);

        // Get user ID (from auth or session for registration flow)
        $userId = Auth::id() ?? session('pending_plan_user_id');
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User session not found. Please try again.',
            ], 422);
        }

        // For cash payments, don't create transaction - admin will record manually
        if ($request->payment_method === 'cash') {
            // Update user's membership type if this is during registration
            $user = \App\Models\User::find($userId);
            if ($user && $user->role === 'member') {
                $user->update(['membership_type' => $request->membership_type]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Cash payment selected. Please pay at the gym reception.',
                'transaction_reference' => 'CASH-' . strtoupper(uniqid()),
                'is_cash' => true,
            ]);
        }

        // Generate transaction reference
        $reference = PaymentTransaction::generateReference();

        // Get plan amounts
        $planAmounts = [
            'basic' => 700,
            'premium' => 2500,
            'vip' => 2500,
        ];

        $amount = $planAmounts[$request->membership_type] ?? $request->amount;

        // Create payment transaction
        $transaction = PaymentTransaction::create([
            'user_id' => $userId,
            'payment_method' => $request->payment_method,
            'amount' => $amount,
            'status' => 'pending',
            'transaction_reference' => $reference,
            'membership_type' => $request->membership_type,
            'payment_details' => $request->payment_details,
        ]);

        // Simulate payment processing (90% success rate for demo)
        $success = rand(1, 100) <= 90;

        if ($success) {
            $transaction->markAsCompleted();
            
            // Update user's membership type if this is during registration
            $user = \App\Models\User::find($userId);
            if ($user && $user->role === 'member') {
                $user->update(['membership_type' => $request->membership_type]);
            }
            
            // Notify all admins about the payment
            $admins = \App\Models\User::where('role', 'admin')->get();
            
            foreach ($admins as $admin) {
                \App\Models\Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'payment_received',
                    'title' => 'Payment Received',
                    'message' => $user->name . ' has completed payment of ₱' . number_format($amount, 2) . ' for ' . ucfirst($request->membership_type) . ' membership via ' . strtoupper($request->payment_method) . '.',
                    'icon' => 'fas fa-money-bill-wave',
                    'color' => 'success',
                    'link' => '/admin/payments',
                    'is_read' => false,
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Payment processed successfully',
                'transaction_reference' => $reference,
                'transaction_id' => $transaction->id,
            ]);
        } else {
            $transaction->markAsFailed('Simulated payment failure');
            
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed. Please try again.',
            ], 422);
        }
    }

    /**
     * Get payment history for the authenticated user.
     */
    public function history()
    {
        $transactions = Auth::user()
            ->paymentTransactions()
            ->latest()
            ->paginate(20);

        return view('payments.history', compact('transactions'));
    }

    /**
     * Get a specific transaction.
     */
    public function show($id)
    {
        $transaction = PaymentTransaction::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('payments.show', compact('transaction'));
    }
}
