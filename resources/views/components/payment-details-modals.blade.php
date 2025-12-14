{{-- Payment Details Modals Component --}}
{{-- This component contains all payment detail collection modals --}}

{{-- Card Payment Modal (Visa, Mastercard, Amex, JCB) --}}
<div id="card-payment-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" onclick="closeCardPaymentModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="card-payment-form" onsubmit="return submitCardPayment(event)">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <i class="fas fa-credit-card text-orange-500 mr-3"></i>
                                <span id="card-type-title">Card</span> Payment
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">Enter your card details</p>
                        </div>
                        <button type="button" onclick="closeCardPaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                            <input type="text" id="card-number" maxlength="19" placeholder="1234 5678 9012 3456" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   required oninput="formatCardNumber(this)">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                            <input type="text" id="card-name" placeholder="JOHN DOE" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent uppercase"
                                   required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                <input type="text" id="card-expiry" maxlength="5" placeholder="MM/YY" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       required oninput="formatExpiry(this)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                <input type="text" id="card-cvv" maxlength="4" placeholder="123" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Your payment information is secure and encrypted
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-lg hover:from-orange-600 hover:to-red-700 font-medium">
                        <i class="fas fa-lock mr-2"></i>Pay Now
                    </button>
                    <button type="button" onclick="closeCardPaymentModal()" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- GCash Payment Modal --}}
<div id="gcash-payment-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" onclick="closeGCashPaymentModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="gcash-payment-form" onsubmit="return submitGCashPayment(event)">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">G</span>
                                </div>
                                GCash Payment
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">Pay using your GCash account</p>
                        </div>
                        <button type="button" onclick="closeGCashPaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                            <input type="tel" id="gcash-mobile" maxlength="11" placeholder="09XX XXX XXXX" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required oninput="formatPhoneNumber(this)">
                            <p class="text-xs text-gray-500 mt-1">Enter your GCash-registered mobile number</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                            <input type="text" id="gcash-name" placeholder="Juan Dela Cruz" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800 font-medium mb-2">
                                <i class="fas fa-info-circle mr-2"></i>Next Steps:
                            </p>
                            <ol class="text-sm text-blue-700 space-y-1 ml-6 list-decimal">
                                <li>You'll receive an OTP on your mobile</li>
                                <li>Open your GCash app</li>
                                <li>Confirm the payment</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        <i class="fas fa-mobile-alt mr-2"></i>Proceed to GCash
                    </button>
                    <button type="button" onclick="closeGCashPaymentModal()" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- PayMaya Payment Modal --}}
<div id="paymaya-payment-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" onclick="closePayMayaPaymentModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="paymaya-payment-form" onsubmit="return submitPayMayaPayment(event)">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-wallet text-white"></i>
                                </div>
                                PayMaya Payment
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">Pay using your PayMaya account</p>
                        </div>
                        <button type="button" onclick="closePayMayaPaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number or Email</label>
                            <input type="text" id="paymaya-account" placeholder="09XX XXX XXXX or email@example.com" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                            <input type="text" id="paymaya-name" placeholder="Juan Dela Cruz" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-sm text-green-800">
                                <i class="fas fa-check-circle mr-2"></i>
                                You'll be redirected to PayMaya to complete your payment
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 font-medium">
                        <i class="fas fa-arrow-right mr-2"></i>Continue to PayMaya
                    </button>
                    <button type="button" onclick="closePayMayaPaymentModal()" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Bank Transfer Modal (BDO/BancNet) --}}
<div id="bank-payment-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" onclick="closeBankPaymentModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="bank-payment-form" onsubmit="return submitBankPayment(event)">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <i class="fas fa-university text-blue-700 mr-3 text-2xl"></i>
                                <span id="bank-type-title">Bank</span> Transfer
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">Complete your bank transfer</p>
                        </div>
                        <button type="button" onclick="closeBankPaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm font-medium text-blue-900 mb-2">Transfer to:</p>
                            <div class="text-sm text-blue-800 space-y-1">
                                <p><strong>Bank:</strong> <span id="bank-name-display">BDO</span></p>
                                <p><strong>Account Name:</strong> TitansGym Inc.</p>
                                <p><strong>Account Number:</strong> 1234-5678-9012</p>
                                <p><strong>Amount:</strong> ₱<span id="bank-amount-display">0.00</span></p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Account Name</label>
                            <input type="text" id="bank-sender-name" placeholder="Juan Dela Cruz" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reference Number (Optional)</label>
                            <input type="text" id="bank-reference" placeholder="Enter transaction reference" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">You can add this after completing the transfer</p>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Please complete the transfer and keep your receipt. Your membership will be activated once we verify your payment.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 font-medium">
                        <i class="fas fa-check mr-2"></i>I've Completed the Transfer
                    </button>
                    <button type="button" onclick="closeBankPaymentModal()" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Simple Payment Modal (for Alipay, WeChat, PayPal, TendoPay) --}}
<div id="simple-payment-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity" onclick="closeSimplePaymentModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="simple-payment-form" onsubmit="return submitSimplePayment(event)">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <i id="simple-payment-icon" class="fas fa-wallet text-purple-600 mr-3 text-2xl"></i>
                                <span id="simple-payment-title">Payment</span>
                            </h3>
                            <p class="text-gray-500 text-sm mt-1" id="simple-payment-subtitle">Complete your payment</p>
                        </div>
                        <button type="button" onclick="closeSimplePaymentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Email or ID</label>
                            <input type="text" id="simple-account" placeholder="your@email.com" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="simple-name" placeholder="Juan Dela Cruz" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   required>
                        </div>

                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <p class="text-sm text-purple-800" id="simple-payment-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                You'll be redirected to complete your payment securely.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3">
                    <button type="submit" id="simple-payment-btn" class="w-full sm:w-auto px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium">
                        <i class="fas fa-arrow-right mr-2"></i>Continue
                    </button>
                    <button type="button" onclick="closeSimplePaymentModal()" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Store current payment context
let currentPaymentContext = {
    method: '',
    amount: 0,
    plan: '',
    formId: '' // 'planForm' or 'membership-form'
};

// Format card number with spaces
function formatCardNumber(input) {
    let value = input.value.replace(/\s/g, '').replace(/[^0-9]/g, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    input.value = formattedValue;
}

// Format expiry date
function formatExpiry(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
    }
    input.value = value;
}

// Format phone number
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    input.value = value;
}

// Card Payment Functions
function openCardPaymentModal(method, amount, plan, formId) {
    currentPaymentContext = { method, amount, plan, formId };
    const methodNames = {
        'visa': 'Visa',
        'mastercard': 'Mastercard',
        'amex': 'American Express',
        'jcb': 'JCB'
    };
    document.getElementById('card-type-title').textContent = methodNames[method] || 'Card';
    document.getElementById('card-payment-modal').classList.remove('hidden');
}

function closeCardPaymentModal() {
    document.getElementById('card-payment-modal').classList.add('hidden');
    document.getElementById('card-payment-form').reset();
}

function submitCardPayment(event) {
    event.preventDefault();
    const formData = {
        card_number: document.getElementById('card-number').value.replace(/\s/g, ''),
        card_name: document.getElementById('card-name').value,
        card_expiry: document.getElementById('card-expiry').value,
        card_cvv: document.getElementById('card-cvv').value
    };
    processPayment(formData);
    return false;
}

// GCash Payment Functions
function openGCashPaymentModal(method, amount, plan, formId) {
    currentPaymentContext = { method, amount, plan, formId };
    document.getElementById('gcash-payment-modal').classList.remove('hidden');
}

function closeGCashPaymentModal() {
    document.getElementById('gcash-payment-modal').classList.add('hidden');
    document.getElementById('gcash-payment-form').reset();
}

function submitGCashPayment(event) {
    event.preventDefault();
    const formData = {
        mobile: document.getElementById('gcash-mobile').value,
        name: document.getElementById('gcash-name').value
    };
    processPayment(formData);
    return false;
}

// PayMaya Payment Functions
function openPayMayaPaymentModal(method, amount, plan, formId) {
    currentPaymentContext = { method, amount, plan, formId };
    document.getElementById('paymaya-payment-modal').classList.remove('hidden');
}

function closePayMayaPaymentModal() {
    document.getElementById('paymaya-payment-modal').classList.add('hidden');
    document.getElementById('paymaya-payment-form').reset();
}

function submitPayMayaPayment(event) {
    event.preventDefault();
    const formData = {
        account: document.getElementById('paymaya-account').value,
        name: document.getElementById('paymaya-name').value
    };
    processPayment(formData);
    return false;
}

// Bank Transfer Functions
function openBankPaymentModal(method, amount, plan, formId) {
    currentPaymentContext = { method, amount, plan, formId };
    const bankNames = {
        'bdo': 'BDO',
        'bancnet': 'BancNet'
    };
    document.getElementById('bank-type-title').textContent = bankNames[method] || 'Bank';
    document.getElementById('bank-name-display').textContent = bankNames[method] || 'Bank';
    document.getElementById('bank-amount-display').textContent = amount.toFixed(2);
    document.getElementById('bank-payment-modal').classList.remove('hidden');
}

function closeBankPaymentModal() {
    document.getElementById('bank-payment-modal').classList.add('hidden');
    document.getElementById('bank-payment-form').reset();
}

function submitBankPayment(event) {
    event.preventDefault();
    const formData = {
        sender_name: document.getElementById('bank-sender-name').value,
        reference: document.getElementById('bank-reference').value
    };
    processPayment(formData);
    return false;
}

// Simple Payment Functions (Alipay, WeChat, PayPal, TendoPay)
function openSimplePaymentModal(method, amount, plan, formId) {
    currentPaymentContext = { method, amount, plan, formId };
    
    const config = {
        'alipay': {
            title: 'Alipay Payment',
            subtitle: 'Pay using your Alipay account',
            icon: 'fab fa-alipay',
            color: 'blue',
            info: 'You\'ll be redirected to Alipay to complete your payment.'
        },
        'wechat': {
            title: 'WeChat Pay',
            subtitle: 'Pay using WeChat',
            icon: 'fab fa-weixin',
            color: 'green',
            info: 'Scan the QR code with your WeChat app to complete payment.'
        },
        'paypal': {
            title: 'PayPal Payment',
            subtitle: 'Pay using your PayPal account',
            icon: 'fab fa-paypal',
            color: 'blue',
            info: 'You\'ll be redirected to PayPal to complete your payment.'
        },
        'tendopay': {
            title: 'TendoPay',
            subtitle: 'Buy now, pay later',
            icon: 'fas fa-clock',
            color: 'purple',
            info: 'Complete your purchase and pay in installments.'
        },
        'cash': {
            title: 'Cash Payment',
            subtitle: 'Pay in cash at the gym',
            icon: 'fas fa-money-bill-wave',
            color: 'green',
            info: 'Please bring exact cash amount to the gym reception to complete your registration.'
        }
    };
    
    const settings = config[method] || config['paypal'];
    document.getElementById('simple-payment-title').textContent = settings.title;
    document.getElementById('simple-payment-subtitle').textContent = settings.subtitle;
    document.getElementById('simple-payment-icon').className = `${settings.icon} text-${settings.color}-600 mr-3 text-2xl`;
    document.getElementById('simple-payment-info').innerHTML = `<i class="fas fa-info-circle mr-2"></i>${settings.info}`;
    document.getElementById('simple-payment-btn').className = `w-full sm:w-auto px-6 py-3 bg-${settings.color}-600 text-white rounded-lg hover:bg-${settings.color}-700 font-medium`;
    
    document.getElementById('simple-payment-modal').classList.remove('hidden');
}

function closeSimplePaymentModal() {
    document.getElementById('simple-payment-modal').classList.add('hidden');
    document.getElementById('simple-payment-form').reset();
}

function submitSimplePayment(event) {
    event.preventDefault();
    const formData = {
        account: document.getElementById('simple-account').value,
        name: document.getElementById('simple-name').value
    };
    processPayment(formData);
    return false;
}

// Process Payment (Simulated)
function processPayment(paymentDetails) {
    // Show loading state
    const loadingHtml = `
        <div class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900 bg-opacity-75">
            <div class="bg-white rounded-2xl p-8 max-w-sm text-center">
                <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-orange-600 mx-auto mb-4"></div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Processing Payment...</h3>
                <p class="text-gray-600">Please wait while we process your payment</p>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', loadingHtml);
    
    // Simulate payment processing
    setTimeout(() => {
        // Remove loading
        document.querySelector('.fixed.inset-0.z-\\[70\\]').remove();
        
        // Create payment transaction via AJAX
        fetch('/payment/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                payment_method: currentPaymentContext.method,
                amount: currentPaymentContext.amount,
                membership_type: currentPaymentContext.plan,
                payment_details: paymentDetails
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close all modals
                closeCardPaymentModal();
                closeGCashPaymentModal();
                closePayMayaPaymentModal();
                closeBankPaymentModal();
                closeSimplePaymentModal();
                
                // Show success message
                showPaymentSuccess(data.transaction_reference);
                
                // Submit the original form after a delay
                setTimeout(() => {
                    document.getElementById(currentPaymentContext.formId).submit();
                }, 2000);
            } else {
                alert('Payment failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Payment error:', error);
            alert('Payment processing failed. Please try again.');
        });
    }, 1500);
}

function showPaymentSuccess(reference) {
    const successHtml = `
        <div class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900 bg-opacity-75">
            <div class="bg-white rounded-2xl p-8 max-w-sm text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Payment Successful!</h3>
                <p class="text-gray-600 mb-4">Your payment has been processed successfully.</p>
                <p class="text-sm text-gray-500">Reference: ${reference}</p>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', successHtml);
}
</script>
