@extends('layouts.app')

@section('title', 'Help &amp; Support')

@push('styles')
    <style>
        body {
            font-family: 'Geist', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section
        class="relative rounded-3xl overflow-hidden mb-stack-lg p-12 flex flex-col items-center justify-center text-center bg-primary-container min-h-[320px]">
        <!-- Background visual decoration (Simulated shader effect) -->
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-tr from-primary via-transparent to-secondary blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-secondary-container rounded-full blur-[120px]">
            </div>
        </div>
        <div class="relative z-10 max-w-2xl">
            <h2 class="font-headline-lg text-headline-lg text-on-primary-container mb-4">How can we help you today?</h2>
            <p class="font-body-lg text-body-lg text-on-primary-container opacity-80 mb-8">Search our knowledge base or
                browse categories below to find answers to your questions.</p>
            <div class="relative max-w-xl mx-auto shadow-xl rounded-2xl overflow-hidden">
                <input
                    class="w-full px-12 py-5 bg-surface-container-lowest border-none focus:ring-0 font-body-md text-body-md text-on-surface"
                    placeholder="Type your question (e.g., 'How to sync calendar?')" type="text" />
                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary text-3xl"
                    data-icon="search">search</span>
                <button
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-primary text-on-primary px-4 py-2 rounded-lg font-label-md text-label-md hover:brightness-110 transition-all">Search</button>
            </div>
        </div>
    </section>
    <!-- Bento Grid of Help Categories -->
    <div class="grid grid-cols-12 gap-6 mb-stack-lg">
        <!-- Large Feature: Getting Started -->
        <div class="col-span-12 lg:col-span-8 group cursor-pointer">
            <div
                class="h-full glass-card p-stack-lg rounded-2xl hover:shadow-md transition-all duration-300 border-l-4 border-l-secondary">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-secondary-container rounded-xl">
                        <span class="material-symbols-outlined text-on-secondary-container text-3xl"
                            data-icon="rocket_launch">rocket_launch</span>
                    </div>
                    <span
                        class="material-symbols-outlined text-outline opacity-0 group-hover:opacity-100 transition-opacity"
                        data-icon="arrow_forward">arrow_forward</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Getting Started</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6">New to Focus? Learn the basics of task
                    management, project organization, and team collaboration in under 5 minutes.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-container-low rounded-lg hover:bg-surface-container transition-colors">
                        <span class="font-label-md text-label-md text-primary block mb-1">Guide</span>
                        <span class="font-body-md text-body-md font-medium text-on-surface">Setting up your first
                            workspace</span>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg hover:bg-surface-container transition-colors">
                        <span class="font-label-md text-label-md text-primary block mb-1">Video</span>
                        <span class="font-body-md text-body-md font-medium text-on-surface">Interface walkthrough
                            tour</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Troubleshooting -->
        <div class="col-span-12 lg:col-span-4 group cursor-pointer">
            <div
                class="h-full glass-card p-stack-lg rounded-2xl hover:shadow-md transition-all duration-300 border-l-4 border-l-error">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-error-container rounded-xl">
                        <span class="material-symbols-outlined text-error text-3xl" data-icon="build">build</span>
                    </div>
                    <span
                        class="material-symbols-outlined text-outline opacity-0 group-hover:opacity-100 transition-opacity"
                        data-icon="arrow_forward">arrow_forward</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Troubleshooting</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Having technical issues? Find solutions for
                    sync errors, login problems, and app performance.</p>
                <ul class="mt-6 space-y-3">
                    <li
                        class="flex items-center gap-2 text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
                        Resetting your password
                    </li>
                    <li
                        class="flex items-center gap-2 text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
                        Offline mode issues
                    </li>
                </ul>
            </div>
        </div>
        <!-- FAQ Card -->
        <div class="col-span-12 lg:col-span-4 group cursor-pointer">
            <div
                class="h-full glass-card p-stack-lg rounded-2xl hover:shadow-md transition-all duration-300 border-l-4 border-l-tertiary-fixed">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-tertiary-fixed rounded-xl">
                        <span class="material-symbols-outlined text-on-tertiary-fixed text-3xl" data-icon="quiz">quiz</span>
                    </div>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-2">General FAQ</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Common questions about billing, account
                    security, and feature updates.</p>
            </div>
        </div>
        <!-- Integrations -->
        <div class="col-span-12 lg:col-span-4 group cursor-pointer">
            <div
                class="h-full glass-card p-stack-lg rounded-2xl hover:shadow-md transition-all duration-300 border-l-4 border-l-primary">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-primary-fixed rounded-xl">
                        <span class="material-symbols-outlined text-primary text-3xl" data-icon="extension">extension</span>
                    </div>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Integrations</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Connect Focus with Slack, Google Calendar, and
                    100+ other tools.</p>
            </div>
        </div>
        <!-- Security & Privacy -->
        <div class="col-span-12 lg:col-span-4 group cursor-pointer">
            <div
                class="h-full glass-card p-stack-lg rounded-2xl hover:shadow-md transition-all duration-300 border-l-4 border-l-outline">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-surface-container rounded-xl">
                        <span class="material-symbols-outlined text-on-surface-variant text-3xl"
                            data-icon="shield">shield</span>
                    </div>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Security</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">How we protect your data and privacy. 2FA,
                    encryption, and data export.</p>
            </div>
        </div>
    </div>
    <!-- Support Contact Section -->
    <section class="mb-stack-lg">
        <div class="bg-surface-container-high rounded-3xl p-8 lg:p-12">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-4">Still need help?</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mb-8">Our support team is available 24/7 to
                        assist you with any questions or concerns you might have.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                            <span class="material-symbols-outlined text-primary" data-icon="mail">mail</span>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface font-bold">Email Support</p>
                                <p class="font-body-md text-body-md text-on-surface-variant">Response within 2 hours</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                            <span class="material-symbols-outlined text-secondary"
                                data-icon="chat_bubble">chat_bubble</span>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface font-bold">Live Chat</p>
                                <p class="font-body-md text-body-md text-on-surface-variant">Average wait: 1 minute</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3">
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <h4 class="font-headline-md text-headline-md text-on-surface mb-6">Contact Us</h4>
                        <form class="space-y-4">
                            <div>
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant mb-1 block">Subject</label>
                                <input
                                    class="w-full bg-surface border border-outline-variant rounded-lg p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                    type="text" />
                            </div>
                            <div>
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant mb-1 block">Message</label>
                                <textarea
                                    class="w-full bg-surface border border-outline-variant rounded-lg p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                                    rows="4"></textarea>
                            </div>
                            <button
                                class="w-full bg-primary text-on-primary py-3 rounded-xl font-label-md text-label-md font-bold hover:brightness-110 active:scale-[0.98] transition-all">Send
                                Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Articles -->
    <section class="mb-stack-lg">
        <h3 class="font-headline-md text-headline-md text-on-surface mb-6">Trending Topics</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a class="group p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:border-primary transition-all flex items-center justify-between"
                href="#">
                <div>
                    <p class="font-body-md text-body-md font-medium text-on-surface group-hover:text-primary">Keyboard
                        Shortcuts Guide</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Updated 2 days ago</p>
                </div>
                <span class="material-symbols-outlined text-outline group-hover:text-primary"
                    data-icon="chevron_right">chevron_right</span>
            </a>
            <a class="group p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:border-primary transition-all flex items-center justify-between"
                href="#">
                <div>
                    <p class="font-body-md text-body-md font-medium text-on-surface group-hover:text-primary">Customizing
                        Task Views</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Updated 5 days ago</p>
                </div>
                <span class="material-symbols-outlined text-outline group-hover:text-primary"
                    data-icon="chevron_right">chevron_right</span>
            </a>
            <a class="group p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:border-primary transition-all flex items-center justify-between"
                href="#">
                <div>
                    <p class="font-body-md text-body-md font-medium text-on-surface group-hover:text-primary">Data Security
                        Whitepaper</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Updated 1 week ago</p>
                </div>
                <span class="material-symbols-outlined text-outline group-hover:text-primary"
                    data-icon="chevron_right">chevron_right</span>
            </a>
        </div>
    </section>
    <!-- FAB (Authority: Design System - High Elevation Level 3) -->
    <button
        class="fixed bottom-8 right-8 w-14 h-14 bg-primary text-on-primary rounded-full flex items-center justify-center shadow-[0px_20px_25px_-5px_rgba(0,0,0,0.1),0px_10px_10px_-5px_rgba(0,0,0,0.04)] hover:scale-110 active:scale-95 transition-all z-50 group">
        <span class="material-symbols-outlined" data-icon="chat">chat</span>
        <span
            class="absolute right-full mr-4 bg-on-surface text-white px-3 py-1 rounded text-label-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Chat
            with us</span>
    </button>
@endsection

@push('scripts')
    <script>
        // Simple search interactivity
        const searchInput = document.querySelector(
            'input[placeholder="Type your question (e.g., \'How to sync calendar?\')"]');
        searchInput?.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-2', 'ring-primary/20');
        });
        searchInput?.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-2', 'ring-primary/20');
        });

        // Form submission micro-interaction
        document.querySelector('form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.innerText;
            btn.innerText = 'Sending...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerText = 'Sent Successfully!';
                btn.classList.replace('bg-primary', 'bg-secondary');
                setTimeout(() => {
                    btn.innerText = originalText;
                    btn.classList.replace('bg-secondary', 'bg-primary');
                    btn.disabled = false;
                    e.target.reset();
                }, 2000);
            }, 1000);
        });
    </script>
@endpush
