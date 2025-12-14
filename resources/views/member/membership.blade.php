@extends('layouts.app')

@section('title', 'My Membership - TitansGym')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Membership</h1>
                <p class="text-sm text-gray-600 mt-1">Manage your plan and view payment history</p>
            </div>
            <a href="{{ route('member.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-white bg-opacity-50 border border-gray-200 text-sm font-medium rounded-lg hover:bg-white hover:bg-opacity-80 transition text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Current Plan Card -->
            <div class="neuro-card p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-orange-500 to-red-600 rounded-full opacity-20 blur-xl"></div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-id-card text-orange-600 mr-2"></i>
                    Current Plan
                </h3>

                <div class="text-center py-6">
                    <div class="inline-block p-4 rounded-full bg-blue-50 mb-4">
                        @if(($member->membership_type ?? 'basic') == 'vip')
                            <i class="fas fa-crown text-4xl text-yellow-500"></i>
                        @elseif(($member->membership_type ?? 'basic') == 'premium')
                            <i class="fas fa-star text-4xl text-purple-500"></i>
                        @else
                            <i class="fas fa-user text-4xl text-blue-500"></i>
                        @endif
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 capitalize">{{ ucfirst($member->membership_type ?? 'Basic') }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Membership Tier</p>
                </div>

                <div class="border-t border-gray-200 border-opacity-50 pt-4 mt-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $member->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Expiry Date</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $member->membership_expiry ? $member->membership_expiry->format('M d, Y') : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Days Remaining</span>
                        <span class="text-sm font-medium {{ ($member->membership_expiry && $member->membership_expiry->isFuture() && $member->membership_expiry->diffInDays(now()) < 7) ? 'text-red-600' : ($member->membership_expiry && $member->membership_expiry->isFuture() ? 'text-green-600' : 'text-gray-600') }}">
                            {{ $member->membership_expiry && $member->membership_expiry->isFuture() ? $member->membership_expiry->diffInDays(now()) . ' days' : ($member->membership_expiry ? 'Expired' : 'N/A') }}
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    <button onclick="document.getElementById('upgrade-modal').classList.remove('hidden')" 
                            class="w-full py-2 px-4 bg-gradient-to-r from-orange-600 to-red-600 text-white font-medium rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        Change Plan
                    </button>
                </div>
            </div>

            <!-- Payment History -->
            <div class="lg:col-span-2 neuro-card overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-history text-green-600 mr-2"></i>
                        Payment History
                    </h3>
                    <button class="text-sm text-orange-600 hover:text-orange-800 font-medium">
                        <i class="fas fa-download mr-1"></i> Export
                    </button>
                </div>

                <div class="overflow-x-auto">
                    @if($payments->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 divide-opacity-30">
                        <thead class="bg-white bg-opacity-40">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-50 transition-colors sortable"
                                    data-column="date" onclick="sortMembershipPaymentTable('date')">
                                    Date
                                    <i class="fas fa-sort ml-1 text-gray-400 sort-icon"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-50 transition-colors sortable"
                                    data-column="amount" onclick="sortMembershipPaymentTable('amount')">
                                    Amount
                                    <i class="fas fa-sort ml-1 text-gray-400 sort-icon"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-50 transition-colors sortable"
                                    data-column="method" onclick="sortMembershipPaymentTable('method')">
                                    Method
                                    <i class="fas fa-sort ml-1 text-gray-400 sort-icon"></i>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-50 transition-colors sortable"
                                    data-column="status" onclick="sortMembershipPaymentTable('status')">
                                    Status
                                    <i class="fas fa-sort ml-1 text-gray-400 sort-icon"></i>
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Invoice
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 divide-opacity-30">
                            @foreach($payments as $p)
                            <tr class="hover:bg-white hover:bg-opacity-30 transition membership-payment-row"
                                data-date="{{ \Carbon\Carbon::parse($p['created_at'])->format('Y-m-d') }}"
                                data-amount="{{ $p['amount'] }}"
                                data-method="{{ $p['payment_method'] ?? 'card' }}"
                                data-status="{{ $p['status'] }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($p['created_at'])->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    ₱{{ number_format($p['amount'], 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 capitalize">
                                    {{ str_replace('_', ' ', $p['payment_method'] ?? 'card') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($p['status'] == 'paid')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                    @elseif($p['status'] == 'pending')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">{{ ucfirst($p['status']) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-orange-600 hover:text-orange-900">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center py-12">
                        <div class="bg-gray-100 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-receipt text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm">No payment history found.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upgrade Modal -->
<div id="upgrade-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('upgrade-modal').classList.add('hidden')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full glass-card">
            <form action="{{ route('member.membership.update') }}" method="POST" id="membership-form">
                @csrf
                <input type="hidden" name="payment_method" id="membershipPaymentMethod" value="">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-arrow-up text-orange-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Change Membership Plan
                            </h3>
                            <div class="mt-4 space-y-4">
                                <p class="text-sm text-gray-500 mb-4">Select a new plan to upgrade or downgrade your membership.</p>
                                
                                <!-- Basic Plan -->
                                <label class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 transition {{ ($member->membership_type ?? 'basic') == 'basic' ? 'border-orange-500 ring-1 ring-orange-500 bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="membership_type" value="basic" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300" {{ ($member->membership_type ?? 'basic') == 'basic' ? 'checked' : '' }}>
                                    <div class="ml-3 block">
                                        <span class="block text-sm font-medium text-gray-900">Basic Plan</span>
                                        <span class="block text-xs text-gray-500">₱700/month - Access to gym equipment</span>
                                    </div>
                                </label>

                                <!-- Premium Plan -->
                                <label class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:bg-purple-50 transition {{ in_array($member->membership_type ?? 'basic', ['premium', 'vip']) ? 'border-purple-500 ring-1 ring-purple-500 bg-purple-50' : 'border-gray-200' }}">
                                    <input type="radio" name="membership_type" value="premium" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300" {{ in_array($member->membership_type ?? 'basic', ['premium', 'vip']) ? 'checked' : '' }}>
                                    <div class="ml-3 block">
                                        <span class="block text-sm font-medium text-gray-900">Premium/VIP Plan</span>
                                        <span class="block text-xs text-gray-500">₱2,500/month - All access + Classes + Sauna + Personal Trainer</span>
                                    </div>
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 bg-opacity-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="showMembershipPaymentModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Continue
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('upgrade-modal').classList.add('hidden')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Payment Method Modal for Membership Update -->
<div id="membership-payment-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="membership-payment-modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" aria-hidden="true" onclick="closeMembershipPaymentModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-gray-800 rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border-2 border-gray-700">
            <div class="px-6 pt-6 pb-4">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white flex items-center" id="membership-payment-modal-title">
                            <i class="fas fa-credit-card text-orange-500 mr-3"></i>
                            Select Payment Method
                        </h3>
                        <p class="text-gray-400 text-sm mt-1">Choose your preferred payment option</p>
                    </div>
                    <button type="button" onclick="closeMembershipPaymentModal()" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Payment Options Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                    <!-- Credit/Debit Cards -->
                    <button type="button" onclick="selectMembershipPaymentMethod('visa')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-visa text-4xl text-blue-600"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Visa</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('mastercard')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-mastercard text-4xl text-red-600"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Mastercard</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('amex')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-amex text-4xl text-blue-700"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Amex</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('jcb')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-jcb text-4xl text-blue-800"></i>
                        </div>
                        <span class="text-white font-medium text-sm">JCB</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- E-Wallets -->
                    <button type="button" onclick="selectMembershipPaymentMethod('gcash')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">G</span>
                        </div>
                        <span class="text-white font-medium text-sm">GCash</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('paymaya')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-wallet text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">PayMaya</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('alipay')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-alipay text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Alipay</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('wechat')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-green-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-weixin text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">WeChat Pay</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Bank Transfer -->
                    <button type="button" onclick="selectMembershipPaymentMethod('bdo')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-700 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-university text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">BDO</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectMembershipPaymentMethod('bancnet')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-building-columns text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">BancNet</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Buy Now Pay Later -->
                    <button type="button" onclick="selectMembershipPaymentMethod('tendopay')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-purple-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">TendoPay</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Online Payment -->
                    <button type="button" onclick="selectMembershipPaymentMethod('paypal')" class="membership-payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-paypal text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">PayPal</span>
                        <div class="membership-payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>
                </div>

                <!-- Selected Payment Display -->
                <div id="membership-selected-payment-display" class="hidden mb-4 p-4 bg-green-500/10 border border-green-500/50 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-3 text-xl"></i>
                            <div>
                                <p class="text-white font-medium">Payment Method Selected</p>
                                <p class="text-gray-400 text-sm" id="membership-selected-payment-name"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-900/50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                <button type="button" id="membership-confirm-payment-btn" disabled onclick="confirmMembershipPaymentAndSubmit()" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 rounded-xl border border-transparent shadow-sm text-base font-medium text-white bg-gray-600 cursor-not-allowed transition-all duration-300 disabled:opacity-50">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Confirm Change
                </button>
                <button type="button" onclick="closeMembershipPaymentModal()" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 rounded-xl border border-gray-600 shadow-sm text-base font-medium text-gray-300 bg-gray-800 hover:bg-gray-700 transition-all duration-300">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Include Payment Details Modals --}}
@include('components.payment-details-modals')

@push('scripts')
<script>
// Payment Modal Functions
function showMembershipPaymentModal() {
    // Check if a plan is selected
    const selectedPlan = document.querySelector('input[name="membership_type"]:checked');
    if (!selectedPlan) {
        alert('Please select a membership plan first.');
        return;
    }
    
    // Close upgrade modal
    document.getElementById('upgrade-modal').classList.add('hidden');
    // Show payment modal
    document.getElementById('membership-payment-modal').classList.remove('hidden');
}

function selectMembershipPaymentMethod(method) {
    document.getElementById('membershipPaymentMethod').value = method;
    
    // Reset all payment options
    document.querySelectorAll('.membership-payment-option').forEach(option => {
        option.classList.remove('ring-4', 'ring-orange-500', 'bg-gray-700');
        option.classList.add('bg-gray-700/50');
        const check = option.querySelector('.membership-payment-check');
        check.classList.add('hidden');
        check.classList.remove('flex', 'bg-orange-500', 'border-orange-500');
    });
    
    // Highlight selected payment option
    const selectedOption = event.currentTarget;
    selectedOption.classList.remove('bg-gray-700/50');
    selectedOption.classList.add('ring-4', 'ring-orange-500', 'bg-gray-700');
    const check = selectedOption.querySelector('.membership-payment-check');
    check.classList.remove('hidden');
    check.classList.add('flex', 'bg-orange-500', 'border-orange-500');
    
    // Get selected plan
    const selectedPlan = document.querySelector('input[name="membership_type"]:checked').value;
    
    // Get plan amount
    const planAmounts = {
        'basic': 700,
        'premium': 2500,
        'vip': 2500
    };
    const amount = planAmounts[selectedPlan] || 0;
    
    // Close membership payment modal
    document.getElementById('membership-payment-modal').classList.add('hidden');
    
    // Open appropriate payment detail modal
    if (['visa', 'mastercard', 'amex', 'jcb'].includes(method)) {
        openCardPaymentModal(method, amount, selectedPlan, 'membership-form');
    } else if (method === 'gcash') {
        openGCashPaymentModal(method, amount, selectedPlan, 'membership-form');
    } else if (method === 'paymaya') {
        openPayMayaPaymentModal(method, amount, selectedPlan, 'membership-form');
    } else if (['bdo', 'bancnet'].includes(method)) {
        openBankPaymentModal(method, amount, selectedPlan, 'membership-form');
    } else {
        // For alipay, wechat, paypal, tendopay
        openSimplePaymentModal(method, amount, selectedPlan, 'membership-form');
    }
}

function closeMembershipPaymentModal() {
    document.getElementById('membership-payment-modal').classList.add('hidden');
    // Reset payment selection
    document.getElementById('membershipPaymentMethod').value = '';
    document.getElementById('membership-selected-payment-display').classList.add('hidden');
    
    // Reset all payment options
    document.querySelectorAll('.membership-payment-option').forEach(option => {
        option.classList.remove('ring-4', 'ring-orange-500', 'bg-gray-700');
        option.classList.add('bg-gray-700/50');
        const check = option.querySelector('.membership-payment-check');
        check.classList.add('hidden');
        check.classList.remove('flex', 'bg-orange-500', 'border-orange-500');
    });
    
    // Disable confirm button
    const confirmBtn = document.getElementById('membership-confirm-payment-btn');
    confirmBtn.disabled = true;
    confirmBtn.classList.add('bg-gray-600', 'cursor-not-allowed');
    confirmBtn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-red-600', 'hover:from-orange-600', 'hover:to-red-700', 'cursor-pointer', 'shadow-lg', 'hover:shadow-orange-500/25');
    
    // Show upgrade modal again
    document.getElementById('upgrade-modal').classList.remove('hidden');
}

function confirmMembershipPaymentAndSubmit() {
    const paymentMethod = document.getElementById('membershipPaymentMethod').value;
    if (paymentMethod) {
        document.getElementById('membership-form').submit();
    }
}
</script>
<script>
// Table Sorting Functionality
let currentSortColumn = null;
let currentSortDirection = 'asc';

function sortMembershipPaymentTable(column) {
    const tbody = document.querySelector('.membership-payment-row')?.closest('tbody');
    if (!tbody) return;
    
    const rows = Array.from(tbody.querySelectorAll('.membership-payment-row'));
    
    // Toggle sort direction if same column
    if (currentSortColumn === column) {
        currentSortDirection = currentSortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        currentSortColumn = column;
        currentSortDirection = 'asc';
    }
    
    // Update sort icons
    document.querySelectorAll('.sortable .sort-icon').forEach(icon => {
        icon.className = 'fas fa-sort ml-1 text-gray-400 sort-icon';
    });
    
    const currentHeader = document.querySelector(`.sortable[data-column="${column}"] .sort-icon`);
    if (currentHeader) {
        currentHeader.className = `fas fa-sort-${currentSortDirection === 'asc' ? 'up' : 'down'} ml-1 text-green-600 sort-icon`;
    }
    
    // Sort rows
    rows.sort((a, b) => {
        let aValue, bValue;
        
        switch(column) {
            case 'date':
                aValue = new Date(a.dataset.date);
                bValue = new Date(b.dataset.date);
                break;
            case 'amount':
                aValue = parseFloat(a.dataset.amount);
                bValue = parseFloat(b.dataset.amount);
                break;
            case 'method':
            case 'status':
                aValue = a.dataset[column].toLowerCase();
                bValue = b.dataset[column].toLowerCase();
                break;
            default:
                return 0;
        }
        
        if (aValue < bValue) return currentSortDirection === 'asc' ? -1 : 1;
        if (aValue > bValue) return currentSortDirection === 'asc' ? 1 : -1;
        return 0;
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
}
</script>
@endpush

@endsection
