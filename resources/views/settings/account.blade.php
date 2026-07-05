@extends('layouts.app')

@section('title', 'Edit Account')

@push('styles')
    <style>
        /* Custom scrollbar for subtle professional feel */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-[800px] mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-stack-lg text-on-surface-variant font-label-md text-label-md">
            <span class="cursor-pointer hover:text-primary transition-colors">Settings</span>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-bold">Edit Profile</span>
        </nav>
        <header class="mb-stack-lg flex items-center justify-between">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Edit Profile</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">Manage your personal information and how
                    you appear to others.</p>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="px-4 py-2 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high rounded-lg transition-colors active:scale-95">
                    Discard
                </button>
                <button
                    class="px-6 py-2 bg-primary text-on-primary font-label-md text-label-md rounded-lg shadow-sm hover:opacity-90 active:scale-95 transition-all">
                    Save Changes
                </button>
            </div>
        </header>
        <!-- Form Container -->
        <div class="flex flex-col gap-stack-lg">
            <!-- Profile Picture Section -->
            <section class="bg-surface p-stack-lg rounded-xl border border-outline-variant shadow-sm">
                <h3 class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant mb-stack-md">Profile
                    Picture</h3>
                <div class="flex items-center gap-stack-lg">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-surface-container">
                            <img class="w-full h-full object-cover"
                                data-alt="A professional studio headshot of a diverse corporate executive, featuring soft cinematic lighting against a clean white and indigo blurred background. The style is modern, minimalist, and exudes professional clarity and calm productivity. High-end digital photography aesthetic with shallow depth of field."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqiGegQ2uFLTJyC4h7pyxhLvE6arww_mxDME3k3V82UsmXUkxa2Onag18wQAzzksdQiQNHxg3WqedSjt2P_guUqeL22_mKfqv4bzC1qun0gfUNVVQ4zVBV0amrsKq3uQyscAjL9Y6-R6ecBrC2Siu4u5cg0Q8snkzc9FmWKQsH1nXJgOcCiyDL0J0GIHKm8XSH3WK3qG20RzITEEmYtldeu2eBCQvkF8wXKjUfjrt_f37jEntVIqWpvQ" />
                        </div>
                        <button
                            class="absolute bottom-0 right-0 w-8 h-8 bg-primary text-on-primary rounded-full flex items-center justify-center border-2 border-surface shadow-md hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 bg-surface-container-high text-on-surface font-label-md text-label-md rounded-lg hover:bg-surface-container-highest transition-colors active:scale-95 border border-outline-variant">
                                Upload New
                            </button>
                            <button
                                class="px-4 py-2 text-error font-label-md text-label-md rounded-lg hover:bg-error-container transition-colors active:scale-95">
                                Remove
                            </button>
                        </div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant">Recommended: Square JPG or PNG, at
                            least 400x400px.</p>
                    </div>
                </div>
            </section>
            <!-- Personal Information Section -->
            <section class="bg-surface p-stack-lg rounded-xl border border-outline-variant shadow-sm">
                <h3 class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant mb-stack-md">
                    Personal Details</h3>
                <div class="grid grid-cols-2 gap-stack-lg">
                    <!-- Full Name -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Full Name</label>
                        <input
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            type="text" value="Alexander Sterling" />
                    </div>
                    <!-- Email Address -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Email Address</label>
                        <input
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            type="email" value="a.sterling@focusapp.io" />
                    </div>
                    <!-- Job Title -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Job Title</label>
                        <input
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            type="text" value="Senior Project Manager" />
                    </div>
                    <!-- Department -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Department</label>
                        <select
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                            <option>Product Design</option>
                            <option selected="">Operations</option>
                            <option>Engineering</option>
                            <option>Marketing</option>
                            <option>Executive</option>
                        </select>
                    </div>
                    <!-- Location -->
                    <div class="col-span-2 flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Location</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">location_on</span>
                            <input
                                class="w-full pl-10 pr-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                                type="text" value="London, United Kingdom" />
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bio Section -->
            <section class="bg-surface p-stack-lg rounded-xl border border-outline-variant shadow-sm">
                <h3 class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant mb-stack-md">About
                    Me</h3>
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md text-on-surface-variant px-1">Short Bio</label>
                    <textarea
                        class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none"
                        rows="4">Passionate about optimizing workflows and building high-performance teams. Currently leading the internal operations transformation at Focus. Lover of minimalist design and morning espresso.</textarea>
                    <p class="font-label-sm text-label-sm text-on-surface-variant mt-1 text-right">164 / 250 characters</p>
                </div>
            </section>
            <!-- Action Footer -->
            <div class="flex items-center justify-end gap-stack-md pt-stack-md mb-24">
                <button
                    class="px-8 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high rounded-lg transition-colors active:scale-95 border border-outline-variant">
                    Cancel
                </button>
                <button
                    class="px-12 py-3 bg-primary text-on-primary font-label-md text-label-md rounded-lg shadow-md hover:shadow-lg hover:opacity-90 active:scale-95 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Micro-interactions Script -->
    <script>
        // Simple input focus effects and active state handling
        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('focus', () => {
                el.parentElement.querySelector('label').classList.add('text-primary');
            });
            el.addEventListener('blur', () => {
                el.parentElement.querySelector('label').classList.remove('text-primary');
            });
        });

        // Floating Action Button logic if needed (per guidelines, suppressed on Detail screens)
        // This is a Detail screen (Edit Profile), so FAB is omitted.
    </script>
    </body>

    </html>
@endpush
