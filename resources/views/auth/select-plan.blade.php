
@extends('layouts.app')

@section('title', 'Choose Your Plan - GymSystem')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 shadow-lg mb-6">
                <i class="fas fa-crown text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white font-display mb-4">Choose Your Membership Plan</h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Welcome, <span class="text-orange-400 font-semibold">{{ session('user_name', 'Member') }}</span>! 
                Select the plan that best fits your fitness journey.
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/50 rounded-xl p-4 mb-8 backdrop-blur-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                    <span class="text-red-300">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('select-plan') }}" method="POST" id="planForm">
            @csrf
            <input type="hidden" name="membership_type" id="selectedPlan" value="">
            <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="">

            <!-- Plans Grid -->
            <div class="grid md:grid-cols-2 gap-8">
                
                <!-- Basic Plan -->
                <div class="plan-card group relative bg-gray-800/50 backdrop-blur-xl rounded-3xl border-2 border-gray-700 hover:border-orange-500/50 transition-all duration-300 cursor-pointer overflow-hidden"
                     onclick="selectPlan('basic')">
                    
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <!-- Selection Indicator -->
                    <div id="basic-check" class="absolute top-6 right-6 w-8 h-8 rounded-full border-2 border-gray-600 flex items-center justify-center transition-all">
                        <i class="fas fa-check text-white opacity-0 transition-opacity"></i>
                    </div>

                    <div class="relative p-8">
                        <!-- Plan Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-gray-700/50 text-gray-300 text-sm font-medium mb-6">
                            <i class="fas fa-star mr-2 text-orange-400"></i>
                            Starter
                        </div>

                        <!-- Plan Name -->
                        <h2 class="text-3xl font-bold text-white mb-2">Basic Plan</h2>
                        <div class="flex items-baseline mb-4">
                            <span class="text-4xl font-bold text-orange-400">₱700</span>
                            <span class="text-gray-500 ml-2">/month</span>
                        </div>
                        <p class="text-gray-400 mb-8">Perfect for beginners starting their fitness journey</p>

                        <!-- Perks List -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">1 Month Free Session</p>
                                    <p class="text-gray-500 text-sm">Start your journey with a free month</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Free Use of All Equipment</p>
                                    <p class="text-gray-500 text-sm">Access to all gym equipment anytime</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-600/50 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-times text-gray-500 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-medium">No Trainer Included</p>
                                    <p class="text-gray-600 text-sm">Self-guided workouts only</p>
                                </div>
                            </div>
                        </div>

                        <!-- Select Button -->
                        <button type="button" onclick="selectPlan('basic')"
                                class="w-full py-4 px-6 rounded-xl bg-gray-700 hover:bg-gray-600 text-white font-semibold transition-all duration-300 group-hover:bg-gradient-to-r group-hover:from-orange-500 group-hover:to-red-600">
                            Select Basic Plan
                        </button>
                    </div>
                </div>

                <!-- Premium/VIP Plan -->
                <div class="plan-card group relative bg-gradient-to-br from-orange-900/30 to-red-900/30 backdrop-blur-xl rounded-3xl border-2 border-orange-500/50 hover:border-orange-400 transition-all duration-300 cursor-pointer overflow-hidden pt-6"
                     onclick="selectPlan('premium')">
                    
                    <!-- Popular Badge -->
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                        <div class="px-6 py-2 rounded-full bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-bold shadow-lg">
                            <i class="fas fa-fire mr-2"></i>MOST POPULAR
                        </div>
                    </div>

                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-red-500/10 opacity-50"></div>
                    
                    <!-- Selection Indicator -->
                    <div id="premium-check" class="absolute top-6 right-6 w-8 h-8 rounded-full border-2 border-orange-500/50 flex items-center justify-center transition-all">
                        <i class="fas fa-check text-white opacity-0 transition-opacity"></i>
                    </div>

                    <div class="relative p-8 pt-10">
                        <!-- Plan Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-orange-500/20 text-orange-300 text-sm font-medium mb-6">
                            <i class="fas fa-crown mr-2 text-yellow-400"></i>
                            Premium
                        </div>

                        <!-- Plan Name -->
                        <h2 class="text-3xl font-bold text-white mb-2">Premium / VIP Plan</h2>
                        <div class="flex items-baseline mb-2">
                            <span class="text-4xl font-bold text-orange-400">₱2,500</span>
                            <span class="text-gray-400 ml-2">/month</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-6">+ Extra charges based on trainer selection</p>
                        <p class="text-gray-300 mb-8">Maximum results with personal training support</p>

                        <!-- Perks List -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">15 Days Free Training with Trainer</p>
                                    <p class="text-gray-400 text-sm">Get personalized guidance from professionals</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">1 Month Free Gym Session</p>
                                    <p class="text-gray-400 text-sm">Full access to all gym facilities</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Discounted Sessions - ₱50 Only</p>
                                    <p class="text-gray-400 text-sm">Special member pricing per session</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mr-4 mt-0.5">
                                    <i class="fas fa-check text-green-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Free T-Shirt</p>
                                    <p class="text-gray-400 text-sm">Exclusive gym merchandise included</p>
                                </div>
                            </div>
                        </div>

                        <!-- Select Button -->
                        <button type="button" onclick="selectPlan('premium')"
                                class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-orange-500/25">
                            Select Premium Plan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Payment Method Modal -->
<div id="payment-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="payment-modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" aria-hidden="true" onclick="closePaymentModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-gray-800 rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border-2 border-gray-700">
            <div class="px-6 pt-6 pb-4">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white flex items-center" id="payment-modal-title">
                            <i class="fas fa-credit-card text-orange-500 mr-3"></i>
                            Select Payment Method
                        </h3>
                        <p class="text-gray-400 text-sm mt-1">Choose your preferred payment option</p>
                    </div>
                    <button type="button" onclick="closePaymentModal()" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Payment Options Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                    <!-- Credit/Debit Cards -->
                    <button type="button" onclick="selectPaymentMethod('visa')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-visa text-4xl text-blue-600"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Visa</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('mastercard')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-mastercard text-4xl text-red-600"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Mastercard</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('amex')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-amex text-4xl text-blue-700"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Amex</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('jcb')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-cc-jcb text-4xl text-blue-800"></i>
                        </div>
                        <span class="text-white font-medium text-sm">JCB</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- E-Wallets -->
                    <button type="button" onclick="selectPaymentMethod('gcash')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-lg">G</span>
                        </div>
                        <span class="text-white font-medium text-sm">GCash</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('paymaya')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-wallet text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">PayMaya</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('alipay')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-alipay text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Alipay</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('wechat')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-green-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-weixin text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">WeChat Pay</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Bank Transfer -->
                    <button type="button" onclick="selectPaymentMethod('bdo')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-700 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-university text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">BDO</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('bancnet')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-building-columns text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">BancNet</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Buy Now Pay Later -->
                    <button type="button" onclick="selectPaymentMethod('tendopay')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-purple-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">TendoPay</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Online Payment -->
                    <button type="button" onclick="selectPaymentMethod('paypal')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fab fa-paypal text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">PayPal</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>

                    <!-- Cash Payment -->
                    <button type="button" onclick="selectPaymentMethod('cash')" class="payment-option group relative p-6 bg-gray-700/50 hover:bg-gray-700 rounded-xl border-2 border-gray-600 hover:border-orange-500 transition-all duration-300 flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-money-bill-wave text-white text-3xl"></i>
                        </div>
                        <span class="text-white font-medium text-sm">Cash</span>
                        <div class="payment-check absolute top-2 right-2 w-6 h-6 rounded-full border-2 border-gray-500 hidden items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </button>
                </div>

                <!-- Selected Payment Display -->
                <div id="selected-payment-display" class="hidden mb-4 p-4 bg-green-500/10 border border-green-500/50 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-3 text-xl"></i>
                            <div>
                                <p class="text-white font-medium">Payment Method Selected</p>
                                <p class="text-gray-400 text-sm" id="selected-payment-name"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-900/50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                <button type="button" id="confirm-payment-btn" disabled onclick="confirmPaymentAndSubmit()" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 rounded-xl border border-transparent shadow-sm text-base font-medium text-white bg-gray-600 cursor-not-allowed transition-all duration-300 disabled:opacity-50">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Continue with Plan
                </button>
                <button type="button" onclick="closePaymentModal()" 
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

<script>
let selectedPlanValue = '';
let selectedPaymentMethodValue = '';

function selectPlan(plan) {
    selectedPlanValue = plan;
    document.getElementById('selectedPlan').value = plan;
    
    // Reset all cards
    document.querySelectorAll('.plan-card').forEach(card => {
        card.classList.remove('ring-4', 'ring-orange-500');
    });
    
    // Reset all check indicators
    document.getElementById('basic-check').classList.remove('bg-orange-500', 'border-orange-500');
    document.getElementById('basic-check').classList.add('border-gray-600');
    document.getElementById('basic-check').querySelector('i').classList.add('opacity-0');
    
    document.getElementById('premium-check').classList.remove('bg-orange-500', 'border-orange-500');
    document.getElementById('premium-check').classList.add('border-orange-500/50');
    document.getElementById('premium-check').querySelector('i').classList.add('opacity-0');
    
    // Highlight selected card
    const selectedCard = event.currentTarget.closest('.plan-card');
    if (selectedCard) {
        selectedCard.classList.add('ring-4', 'ring-orange-500');
    }
    
    // Update check indicator for selected plan
    const checkId = plan + '-check';
    const checkEl = document.getElementById(checkId);
    checkEl.classList.add('bg-orange-500', 'border-orange-500');
    checkEl.classList.remove('border-gray-600', 'border-orange-500/50');
    checkEl.querySelector('i').classList.remove('opacity-0');
    
    // Show payment modal instead of enabling submit button
    document.getElementById('payment-modal').classList.remove('hidden');
}

function selectPaymentMethod(method) {
    selectedPaymentMethodValue = method;
    document.getElementById('selectedPaymentMethod').value = method;
    
    // Reset all payment options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('ring-4', 'ring-orange-500', 'bg-gray-700');
        option.classList.add('bg-gray-700/50');
        const check = option.querySelector('.payment-check');
        check.classList.add('hidden');
        check.classList.remove('flex', 'bg-orange-500', 'border-orange-500');
    });
    
    // Highlight selected payment option
    const selectedOption = event.currentTarget;
    selectedOption.classList.remove('bg-gray-700/50');
    selectedOption.classList.add('ring-4', 'ring-orange-500', 'bg-gray-700');
    const check = selectedOption.querySelector('.payment-check');
    check.classList.remove('hidden');
    check.classList.add('flex', 'bg-orange-500', 'border-orange-500');
    
    // Get plan amount
    const planAmounts = {
        'basic': 700,
        'premium': 2500,
        'vip': 2500
    };
    const amount = planAmounts[selectedPlanValue] || 0;
    
    // Close payment method modal
    document.getElementById('payment-modal').classList.add('hidden');
    
    // Open appropriate payment detail modal
    if (['visa', 'mastercard', 'amex', 'jcb'].includes(method)) {
        openCardPaymentModal(method, amount, selectedPlanValue, 'planForm');
    } else if (method === 'gcash') {
        openGCashPaymentModal(method, amount, selectedPlanValue, 'planForm');
    } else if (method === 'paymaya') {
        openPayMayaPaymentModal(method, amount, selectedPlanValue, 'planForm');
    } else if (['bdo', 'bancnet'].includes(method)) {
        openBankPaymentModal(method, amount, selectedPlanValue, 'planForm');
    } else {
        // For alipay, wechat, paypal, tendopay, cash
        openSimplePaymentModal(method, amount, selectedPlanValue, 'planForm');
    }
}

function closePaymentModal() {
    document.getElementById('payment-modal').classList.add('hidden');
    // Reset payment selection
    selectedPaymentMethodValue = '';
    document.getElementById('selectedPaymentMethod').value = '';
    document.getElementById('selected-payment-display').classList.add('hidden');
    
    // Reset all payment options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('ring-4', 'ring-orange-500', 'bg-gray-700');
        option.classList.add('bg-gray-700/50');
        const check = option.querySelector('.payment-check');
        check.classList.add('hidden');
        check.classList.remove('flex', 'bg-orange-500', 'border-orange-500');
    });
    
    // Disable confirm button
    const confirmBtn = document.getElementById('confirm-payment-btn');
    confirmBtn.disabled = true;
    confirmBtn.classList.add('bg-gray-600', 'cursor-not-allowed');
    confirmBtn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-red-600', 'hover:from-orange-600', 'hover:to-red-700', 'cursor-pointer', 'shadow-lg', 'hover:shadow-orange-500/25');
}

function confirmPaymentAndSubmit() {
    if (selectedPlanValue && selectedPaymentMethodValue) {
        document.getElementById('planForm').submit();
    }
}
</script>
@endsection
