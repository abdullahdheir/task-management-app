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
    <div class="max-w-container-max mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-stack-lg text-on-surface-variant font-label-md text-label-md">
            <a href="{{ route('profile.show') }} ">
                <span class="cursor-pointer hover:text-primary transition-colors">Profile</span></a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-bold">Edit</span>
        </nav>
        <header class="mb-stack-lg flex items-center justify-between">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Edit Profile</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">Manage your personal information and how
                    you appear to others.</p>
            </div>
            <div class="flex items-center gap-2">
                <button @click="window.history.back();"
                    class="px-4 py-2 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high rounded-lg transition-colors active:scale-95">
                    Discard
                </button>
                <button form="editProfile"
                    class="px-6 py-2 bg-primary text-on-primary font-label-md text-label-md rounded-lg shadow-sm hover:opacity-90 active:scale-95 transition-all">
                    Save Changes
                </button>
            </div>
        </header>
        <!-- Form Container -->
        <form id="editProfile" class="flex flex-col gap-stack-lg" action="{{ route('profile.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Profile Picture Section -->
            <section class="bg-surface p-stack-lg rounded-xl border border-outline-variant shadow-sm"
                x-data="{
                    avatarUrl: '{{ $user->avatar_url }}',
                    defaultAvatar: 'https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150',
                    isRemoved: false
                }">
                <h3 class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant mb-stack-md">Profile
                    Picture</h3>
                <div class="flex items-center gap-stack-lg">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-surface-container">
                            <img class="w-full h-full object-cover" :src="isRemoved ? defaultAvatar : avatarUrl"
                                alt="Avatar" id="avatarPreview" />
                        </div>
                        <button type="button" @click="$refs.avatarInput.click()"
                            class="absolute bottom-0 right-0 w-8 h-8 bg-primary text-on-primary rounded-full flex items-center justify-center border-2 border-surface shadow-md hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <input type="file" x-ref="avatarInput" name="avatar" class="hidden" accept="image/*"
                                @change="
                        const file = $event.target.files[0];
                        if (file) {
                            avatarUrl = URL.createObjectURL(file);
                            isRemoved = false;
                        }
                    ">
                            <input type="hidden" name="remove_avatar" :value="isRemoved ? '1' : '0'">

                            <button type="button" @click="$refs.avatarInput.click()"
                                class="px-4 py-2 bg-surface-container-high text-on-surface font-label-md text-label-md rounded-lg hover:bg-surface-container-highest transition-colors active:scale-95 border border-outline-variant">
                                Upload New
                            </button>

                            <button type="button" @click="isRemoved = true; $refs.avatarInput.value = '';"
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
                            type="text" value="{{ $user->name }}" name="name" required />
                    </div>
                    <!-- Email Address -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Email Address</label>
                        <input
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            type="email" value="{{ $user->email }}" name="email" required />
                    </div>
                    <!-- Job Title -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Job Title</label>
                        <input
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            type="text" value="{{ $user->job_title }}" name="job_title" required />
                    </div>
                    <!-- Department -->
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant px-1">Department</label>
                        <select name="department"
                            class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                            @foreach ($user->department::cases() as $department)
                                <option value="{{ $department }}" @selected($user->department === $department)
                                    {{ $user->department === $department ? 'selected' : '' }}>
                                    {{ $department->getLabel() }}
                                </option>
                            @endforeach
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
                                type="text" value="{{ $user->location }}" name="location" />
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
                    <textarea name="bio"
                        class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none"
                        rows="4">{{ $user->bio }}</textarea>
                    <p class="font-label-sm text-label-sm text-on-surface-variant mt-1 text-right">164 / 250 characters</p>
                </div>
            </section>
            <!-- Action Footer -->
            <div class="flex items-center justify-end gap-stack-md pt-stack-md mb-24">
                <button @click="window.history.back();"
                    class="px-8 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high rounded-lg transition-colors active:scale-95 border border-outline-variant">
                    Cancel
                </button>
                <button type="submit"
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
@endpush
