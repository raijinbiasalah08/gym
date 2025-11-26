@extends('layouts.app')

@section('title', 'Terms of Service - TitansGym')

@section('content')
<div class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-2xl p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Terms of Service</h1>
            <p class="text-gray-500 text-sm mb-8">Last updated: {{ date('F d, Y') }}</p>

            <div class="prose prose-blue max-w-none text-gray-600">
                <p>
                    Please read these Terms of Service ("Terms", "Terms of Service") carefully before using the TitansGym website (the "Service") operated by TitansGym ("us", "we", or "our").
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Acceptance of Terms</h3>
                <p>
                    Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users, and others who access or use the Service. By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Accounts</h3>
                <p>
                    When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.
                </p>
                <p>
                    You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Intellectual Property</h3>
                <p>
                    The Service and its original content, features, and functionality are and will remain the exclusive property of TitansGym and its licensors. The Service is protected by copyright, trademark, and other laws of both the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of TitansGym.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Links To Other Web Sites</h3>
                <p>
                    Our Service may contain links to third-party web sites or services that are not owned or controlled by TitansGym. TitansGym has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party web sites or services. You further acknowledge and agree that TitansGym shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">5. Termination</h3>
                <p>
                    We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. Upon termination, your right to use the Service will immediately cease.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">6. Governing Law</h3>
                <p>
                    These Terms shall be governed and construed in accordance with the laws of United States, without regard to its conflict of law provisions.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">7. Changes</h3>
                <p>
                    We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">8. Contact Us</h3>
                <p>
                    If you have any questions about these Terms, please contact us at:
                </p>
                <p class="mt-4">
                    <strong>TitansGym</strong><br>
                    <a href="mailto:legal@titansgym.com" class="text-orange-600 hover:underline">legal@titansgym.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
