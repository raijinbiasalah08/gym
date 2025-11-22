@extends('layouts.app')

@section('title', 'Privacy Policy - TitansGym')

@section('content')
<div class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-2xl p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Privacy Policy</h1>
            <p class="text-gray-500 text-sm mb-8">Last updated: {{ date('F d, Y') }}</p>

            <div class="prose prose-blue max-w-none text-gray-600">
                <p>
                    At TitansGym, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our mobile application.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Information We Collect</h3>
                <p>
                    We may collect information about you in a variety of ways. The information we may collect on the Site includes:
                </p>
                <ul class="list-disc pl-5 space-y-2 mb-4">
                    <li><strong>Personal Data:</strong> Personally identifiable information, such as your name, shipping address, email address, and telephone number, and demographic information, such as your age, gender, hometown, and interests, that you voluntarily give to us when you register with the Site or our mobile application.</li>
                    <li><strong>Derivative Data:</strong> Information our servers automatically collect when you access the Site, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the Site.</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Use of Your Information</h3>
                <p>
                    Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the Site or our mobile application to:
                </p>
                <ul class="list-disc pl-5 space-y-2 mb-4">
                    <li>Create and manage your account.</li>
                    <li>Process your payments and refunds.</li>
                    <li>Email you regarding your account or order.</li>
                    <li>Fulfill and manage purchases, orders, payments, and other transactions related to the Site.</li>
                    <li>Generate a personal profile about you to make future visits to the Site more personalized.</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Disclosure of Your Information</h3>
                <p>
                    We may share information we have collected about you in certain situations. Your information may be disclosed as follows:
                </p>
                <ul class="list-disc pl-5 space-y-2 mb-4">
                    <li><strong>By Law or to Protect Rights:</strong> If we believe the release of information about you is necessary to respond to legal process, to investigate or remedy potential violations of our policies, or to protect the rights, property, and safety of others, we may share your information as permitted or required by any applicable law, rule, or regulation.</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Security of Your Information</h3>
                <p>
                    We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">5. Contact Us</h3>
                <p>
                    If you have questions or comments about this Privacy Policy, please contact us at:
                </p>
                <p class="mt-4">
                    <strong>TitansGym</strong><br>
                    123 Fitness Street<br>
                    Gym City, GC 12345<br>
                    <a href="mailto:privacy@titansgym.com" class="text-blue-600 hover:underline">privacy@titansgym.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
