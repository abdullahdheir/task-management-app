@extends('layouts.app')

@section('title', '')

@push('styles')
    <style>
        /* Custom Toggle Switch */
        .toggle-checkbox:checked+.toggle-label {
            background-color: #3525cd;
        }

        .toggle-checkbox:checked+.toggle-label::after {
            transform: translateX(100%);
            border-color: #ffffff;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush

@section('content')
    <!-- Settings Grid Content -->
    <div class="mb-10">
        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Settings</h2>
        <p class="text-on-surface-variant font-body-md text-body-md">Manage your workspace preferences, notifications, and
            security protocols.</p>
    </div>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Bento Grid Layout for Settings -->
        <div class="grid grid-cols-12 gap-6">
            <!-- General Section (Left Column) -->
            <section class="col-span-12 lg:col-span-7 space-y-6">
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary bg-primary-fixed p-2 rounded-lg">tune</span>
                        <h3 class="font-headline-md text-headline-md">General</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="font-label-md text-label-md text-on-surface block mb-1">Timezone</label>
                                <p class="text-on-surface-variant font-body-md text-body-md">Set your local time for
                                    schedule
                                    synchronization.</p>
                            </div>
                            <select
                                class="bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary outline-none min-w-[180px]"
                                name="timezone">
                                <option value="America/Los_Angeles"
                                    {{ old('timezone', $settings->timezone ?? '') === 'America/Los_Angeles' ? 'selected' : '' }}>
                                    Pacific Time (PT)</option>
                                <option value="America/New_York"
                                    {{ old('timezone', $settings->timezone ?? '') === 'America/New_York' ? 'selected' : '' }}>
                                    Eastern Time (ET)</option>
                                <option value="UTC"
                                    {{ old('timezone', $settings->timezone ?? '') === 'UTC' ? 'selected' : '' }}>UTC +00:00
                                </option>
                                <option value="Europe/Berlin"
                                    {{ old('timezone', $settings->timezone ?? '') === 'Europe/Berlin' ? 'selected' : '' }}>
                                    Central European (CET)</option>
                            </select>
                        </div>
                        <div class="border-t border-outline-variant pt-6 flex items-center justify-between"
                            x-data="{ checked: {{ old('dark_mode', $settings->dark_mode ?? false) ? 'true' : 'false' }} }">
                            <div>
                                <label class="font-label-md text-label-md text-on-surface block mb-1">Dark Mode</label>
                                <p class="text-on-surface-variant font-body-md text-body-md">Switch between light and dark
                                    UI
                                    themes.</p>
                            </div>
                            <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out">
                                <input
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-outline-variant appearance-none cursor-pointer z-10 transition-transform duration-200"
                                    id="toggle-dark" type="checkbox" :checked="checked"
                                    :class="{ 'translate-x-6': checked }"
                                    @change="
                                        checked = !checked;
                                        ajax.patch('{{ route('settings.update') }}', { dark_mode: checked })
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    toast('Dark mode ' + (checked ? 'enabled' : 'disabled'));
                                                } else {
                                                    toast(res.message ?? 'Error', 'error');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    "
                                    name="dark_mode" />
                                <label
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-outline-variant cursor-pointer transition-colors duration-200"
                                    :class="{ 'bg-primary': checked }" for="toggle-dark"></label>
                            </div>
                        </div>
                        <div class="border-t border-outline-variant pt-6">
                            <label class="font-label-md text-label-md text-on-surface block mb-3">Workspace Name</label>
                            <input
                                class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 font-body-md text-body-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                type="text" name="workspace_name"
                                value="{{ old('workspace_name', $settings->workspace_name ?? '') }}" />
                        </div>
                    </div>
                </div>
                <!-- Privacy & Security -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="material-symbols-outlined text-secondary bg-secondary-container p-2 rounded-lg">security</span>
                        <h3 class="font-headline-md text-headline-md">Privacy &amp; Security</h3>
                    </div>
                    <div class="space-y-6">
                        {{-- 2FA Toggle in Settings --}}
                        <div
                            class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group">
                            <div class="flex gap-4 items-center">
                                <div
                                    class="p-2 bg-surface-container text-on-surface-variant rounded-lg 
                                            group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">verified_user</span>
                                </div>
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface">Two-Factor Authentication</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">
                                        @if (auth()->user()->two_factor_confirmed_at)
                                            <span class="text-secondary font-bold">● Active</span> — Your account is
                                            protected
                                        @elseif(auth()->user()->two_factor_secret)
                                            <span class="text-tertiary font-bold">● Pending</span> — Setup not confirmed yet
                                        @else
                                            <span class="text-on-surface-variant">Not enabled — Add extra security to your
                                                account</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if (auth()->user()->two_factor_confirmed_at)
                                {{-- Disable Button --}}
                                <form method="POST" action="{{ route('two-factor.disable') }}"
                                    onsubmit="return confirm('Disable 2FA? Your account will be less secure.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 border border-error text-error rounded-lg font-label-md 
                                                   hover:bg-error-container/20 transition-colors">
                                        Disable
                                    </button>
                                </form>
                            @else
                                {{-- Enable / Continue Setup Button --}}
                                <button type="button"
                                    onclick="document.getElementById('twofa-modal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-md 
                                               hover:opacity-90 transition-all">
                                    {{ auth()->user()->two_factor_secret ? 'Continue Setup' : 'Enable 2FA' }}
                                </button>
                            @endif
                        </div>

                        {{-- 2FA Setup Modal --}}
                        <div id="twofa-modal"
                            class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
                            x-data @click.self="$el.classList.add('hidden')">
                            <div class="w-full max-w-md max-h-[90vh] overflow-y-auto">
                                @include('settings.two-factor-setup')
                            </div>
                        </div>
                        <div class="border-t border-outline-variant pt-6 flex items-center justify-between"
                            x-data="{ checked: {{ old('share_usage_data', $settings->share_usage_data ?? true) ? 'true' : 'false' }} }">
                            <div>
                                <label class="font-label-md text-label-md text-on-surface block mb-1">Share Usage
                                    Data</label>
                                <p class="text-on-surface-variant font-body-md text-body-md">Help us improve Focus by
                                    sending
                                    anonymous analytics.</p>
                            </div>
                            <div class="relative inline-block w-12 h-6">
                                <input
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-outline-variant appearance-none cursor-pointer z-10 transition-transform duration-200"
                                    id="toggle-data" type="checkbox" name="share_usage_data" :checked="checked"
                                    :class="{ 'translate-x-6': checked }"
                                    @change="
                                        checked = !checked;
                                        ajax.patch('{{ route('settings.update') }}', { share_usage_data: checked })
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    toast('Settings saved');
                                                } else {
                                                    toast(res.message ?? 'Error', 'error');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    " />
                                <label
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-outline-variant cursor-pointer transition-colors duration-200"
                                    :class="{ 'bg-primary': checked }" for="toggle-data"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Notifications & Account (Right Column) -->
            <section class="col-span-12 lg:col-span-5 space-y-6">
                <!-- Notifications Card -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm overflow-hidden relative">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="material-symbols-outlined text-tertiary bg-tertiary-fixed p-2 rounded-lg">notifications_active</span>
                        <h3 class="font-headline-md text-headline-md">Notifications</h3>
                    </div>
                    <div class="space-y-5">
                        <div class="flex items-center justify-between" x-data="{ checked: {{ old('email_digests', $settings->email_digests ?? true) ? 'true' : 'false' }} }">
                            <span class="font-body-md text-body-md text-on-surface">Email Digests</span>
                            <div class="relative inline-block w-12 h-6">
                                <input
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-outline-variant appearance-none cursor-pointer z-10 transition-transform duration-200"
                                    id="toggle-email" type="checkbox" name="email_digests" :checked="checked"
                                    :class="{ 'translate-x-6': checked }"
                                    @change="
                                        checked = !checked;
                                        ajax.patch('{{ route('settings.update') }}', { email_digests: checked })
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    toast('Settings saved');
                                                } else {
                                                    toast(res.message ?? 'Error', 'error');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    " />
                                <label
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-outline-variant cursor-pointer transition-colors duration-200"
                                    :class="{ 'bg-primary': checked }" for="toggle-email"></label>
                            </div>
                        </div>
                        <div class="flex items-center justify-between" x-data="{ checked: {{ old('desktop_alerts', $settings->desktop_alerts ?? true) ? 'true' : 'false' }} }">
                            <span class="font-body-md text-body-md text-on-surface">Desktop Alerts</span>
                            <div class="relative inline-block w-12 h-6">
                                <input
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-outline-variant appearance-none cursor-pointer z-10 transition-transform duration-200"
                                    id="toggle-desktop" type="checkbox" name="desktop_alerts" :checked="checked"
                                    :class="{ 'translate-x-6': checked }"
                                    @change="
                                        checked = !checked;
                                        ajax.patch('{{ route('settings.update') }}', { desktop_alerts: checked })
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    toast('Settings saved');
                                                } else {
                                                    toast(res.message ?? 'Error', 'error');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    " />
                                <label
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-outline-variant cursor-pointer transition-colors duration-200"
                                    :class="{ 'bg-primary': checked }" for="toggle-desktop"></label>
                            </div>
                        </div>
                        <div class="flex items-center justify-between" x-data="{ checked: {{ old('deadline_reminders', $settings->deadline_reminders ?? false) ? 'true' : 'false' }} }">
                            <span class="font-body-md text-body-md text-on-surface">Deadline Reminders</span>
                            <div class="relative inline-block w-12 h-6">
                                <input
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-outline-variant appearance-none cursor-pointer z-10 transition-transform duration-200"
                                    id="toggle-deadline" type="checkbox" name="deadline_reminders"
                                    :checked="checked" :class="{ 'translate-x-6': checked }"
                                    @change="
                                        checked = !checked;
                                        ajax.patch('{{ route('settings.update') }}', { deadline_reminders: checked })
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    toast('Settings saved');
                                                } else {
                                                    toast(res.message ?? 'Error', 'error');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    " />
                                <label
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-outline-variant cursor-pointer transition-colors duration-200"
                                    :class="{ 'bg-primary': checked }" for="toggle-deadline"></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-outline-variant">
                        <h4 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-4">Quiet
                            Hours</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-label-sm font-label-sm text-on-surface-variant block mb-1">From</label>
                                <input
                                    class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-body-md"
                                    type="time" name="quiet_hours_from"
                                    value="{{ old('quiet_hours_from', $settings->quiet_hours_from ?? '22:00') }}" />
                            </div>
                            <div>
                                <label class="text-label-sm font-label-sm text-on-surface-variant block mb-1">To</label>
                                <input
                                    class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-body-md"
                                    type="time" name="quiet_hours_to"
                                    value="{{ old('quiet_hours_to', $settings->quiet_hours_to ?? '07:00') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Account Card -->
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="material-symbols-outlined text-on-primary bg-primary p-2 rounded-lg">account_circle</span>
                            <h3 class="font-headline-md text-headline-md">Account</h3>
                        </div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="relative group cursor-pointer">
                                <img class="w-16 h-16 rounded-full object-cover border-2 border-primary-fixed"
                                    src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&size=64' }}"
                                    alt="{{ auth()->user()->name }}">
                                <div
                                    class="absolute inset-0 bg-on-surface/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-white text-lg">edit</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-label-md text-label-md text-on-surface">{{ auth()->user()->name }}</h4>
                                <p class="text-on-surface-variant font-body-md text-body-md">{{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <button
                                class="w-full text-left px-4 py-3 rounded-lg hover:bg-surface-container transition-colors flex items-center justify-between group">
                                <span class="text-body-md font-label-md">Personal Information</span>
                                <span
                                    class="material-symbols-outlined text-on-surface-variant group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </button>
                            <button
                                class="w-full text-left px-4 py-3 rounded-lg hover:bg-surface-container transition-colors flex items-center justify-between group">
                                <span class="text-body-md font-label-md">Billing &amp; Subscription</span>
                                <span
                                    class="material-symbols-outlined text-on-surface-variant group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </button>
                            <button
                                class="w-full text-left px-4 py-3 rounded-lg hover:bg-error-container text-error transition-colors flex items-center justify-between group mt-4">
                                <span class="text-body-md font-label-md">Deactivate Account</span>
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Action Footer -->
        <div class="mt-12 flex items-center justify-end gap-4 border-t border-outline-variant pt-8">
            <a href="{{ route('settings.index') }}"
                class="px-6 py-3 text-on-surface-variant font-label-md text-label-md hover:text-on-surface transition-colors cursor-pointer">Discard
                Changes</a>
            <button type="submit"
                class="px-8 py-3 bg-primary text-on-primary rounded-xl font-label-md text-label-md font-bold shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">Save
                Changes</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Micro-interactions for toggles
        document.querySelectorAll('.toggle-checkbox').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('bg-primary');
                    label.classList.remove('bg-outline-variant');
                } else {
                    label.classList.remove('bg-primary');
                    label.classList.add('bg-outline-variant');
                }
            });
        });

        // Search highlight simulation
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            const settingGroups = document.querySelectorAll('section > div');

            settingGroups.forEach(group => {
                const text = group.innerText.toLowerCase();
                if (val && text.includes(val)) {
                    group.style.borderColor = '#3525cd';
                    group.style.boxShadow = '0 0 0 2px rgba(53, 37, 205, 0.1)';
                } else {
                    group.style.borderColor = '';
                    group.style.boxShadow = '';
                }
            });
        });
    </script>
@endpush
