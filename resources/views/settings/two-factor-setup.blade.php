@push('styles')
    <style>
        .step-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2dfff;
            transform: translateY(-50%);
            z-index: 0;
        }

        .active-step-line {
            background: #3525cd;
            width: 0%;
            transition: width 0.3s ease-in-out;
        }

        .card-shadow {
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .glow-effect {
            box-shadow: 0 0 20px rgba(53, 37, 205, 0.15);
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .otp-input:focus {
            border-color: #3525cd;
            box-shadow: 0 0 0 3px rgba(53, 37, 205, 0.15);
        }
    </style>
@endpush

<div class="bg-white dark:bg-surface-container-low-dark rounded-xl card-shadow p-8 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark" x-data="{
    currentStep: 1,
    qrSvg: '',
    secretKey: '',
    otpCode: ['', '', '', '', '', ''],
    errorMessage: '',
    loading: false,
    success: false,

    async enableAndLoad() {
        this.loading = true;
        try {
            // Step 1: Enable 2FA (generates secret)
            await fetch('{{ route('two-factor.enable') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    'Accept': 'application/json',
                }
            });

            // Step 2: Fetch QR code
            const qrRes = await fetch('{{ route('two-factor.qr-code') }}', {
                headers: { 'Accept': 'application/json' }
            });
            const qrData = await qrRes.json();
            this.qrSvg = qrData.svg;

            // Step 3: Fetch secret key
            const skRes = await fetch('{{ route('two-factor.secret-key') }}', {
                headers: { 'Accept': 'application/json' }
            });
            const skData = await skRes.json();
            this.secretKey = skData.secretKey;

            this.goToStep(2);
        } catch (e) {
            window.toast?.('Failed to initialize 2FA. Try again.', 'error');
        } finally {
            this.loading = false;
        }
    },

    async confirmCode() {
        const code = this.otpCode.join('');
        if (code.length !== 6) {
            this.errorMessage = 'Please enter all 6 digits';
            return;
        }
        this.loading = true;
        this.errorMessage = '';
        try {
            const res = await fetch('{{ route('two-factor.confirm') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ code })
            });

            if (res.ok || res.status === 200) {
                this.success = true;
            } else {
                const data = await res.json();
                this.errorMessage = data.errors?.code?.[0] ?? data.message ?? 'Invalid code. Try again.';
                this.shakeInputs();
            }
        } catch (e) {
            this.errorMessage = 'Something went wrong. Try again.';
        } finally {
            this.loading = false;
        }
    },

    copySecret() {
        navigator.clipboard.writeText(this.secretKey).then(() => {
            window.toast?.('Secret key copied!');
        });
    },

    goToStep(step) {
        this.currentStep = step;
        this.$nextTick(() => {
            if (step === 3) this.$refs.otp0?.focus();
        });
    },

    handleOtpInput(index, event) {
        const val = event.target.value.replace(/\D/g, '');
        this.otpCode[index] = val.slice(-1);
        event.target.value = this.otpCode[index];
        if (this.otpCode[index] && index < 5) {
            this.$nextTick(() => this.$refs['otp' + (index + 1)]?.focus());
        }
    },

    handleOtpKeydown(index, event) {
        if (event.key === 'Backspace' && !this.otpCode[index] && index > 0) {
            this.$nextTick(() => this.$refs['otp' + (index - 1)]?.focus());
        }
    },

    handleOtpPaste(event) {
        const paste = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
        paste.split('').forEach((char, i) => { this.otpCode[i] = char; });
        event.preventDefault();
        this.$nextTick(() => this.$refs['otp' + Math.min(paste.length, 5)]?.focus());
    },

    shakeInputs() {
        const container = this.$refs.otpContainer;
        container?.classList.add('animate-bounce');
        setTimeout(() => container?.classList.remove('animate-bounce'), 500);
    }
}">

    {{-- ───── SUCCESS STATE ───── --}}
    <template x-if="success">
        <div class="text-center py-8">
            <div class="w-16 h-16 rounded-full bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-secondary dark:text-secondary-dark text-[32px]"
                    style="font-variation-settings:'FILL' 1">check_circle</span>
            </div>
            <h2 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark mb-2">2FA Enabled!</h2>
            <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-6">
                Your account is now protected with two-factor authentication.
            </p>
            <button type="button"
                onclick="document.getElementById('twofa-modal').classList.add('hidden'); window.location.reload();"
                class="w-full bg-primary dark:bg-primary-dark text-white py-4 rounded-xl font-body-lg hover:opacity-90 transition-all">
                Done
            </button>
        </div>
    </template>

    {{-- ───── SETUP FLOW ───── --}}
    <template x-if="!success">
        <div>
            {{-- Header --}}
            <div class="flex flex-col items-center text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-primary dark:bg-primary-dark-fixed dark:bg-primary dark:bg-primary-dark-fixed-dark flex items-center justify-center glow-effect mb-4">
                    <span class="material-symbols-outlined text-primary dark:text-primary-dark text-[32px]">shield</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Secure Your Account</h1>
                <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark max-w-[320px] mt-2">
                    Two-factor authentication adds an extra layer of security
                </p>
            </div>

            {{-- Step Indicator --}}
            <div class="relative flex justify-between items-center px-8 mb-6 h-10">
                <div class="step-line"></div>
                <div class="step-line active-step-line"
                    :style="'width: ' + (currentStep === 1 ? '0%' : currentStep === 2 ? '50%' : '100%')"></div>
                @foreach ([1 => 'Download App', 2 => 'Scan QR', 3 => 'Verify Code'] as $num => $label)
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center border-4 border-white shadow-sm transition-all"
                            :class="{{ $num }} < currentStep ?
                                'bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark' :
                                {{ $num }} === currentStep ?
                                'bg-primary dark:bg-primary-dark' :
                                'bg-surface dark:bg-surface-dark-container-high'">
                            <template x-if="{{ $num }} < currentStep">
                                <span class="material-symbols-outlined text-secondary dark:text-secondary-dark text-[14px]">check</span>
                            </template>
                            <template x-if="{{ $num }} >= currentStep">
                                <span class="text-[10px] font-bold"
                                    :class="{{ $num }} === currentStep ? 'text-white' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark'">
                                    {{ $num }}
                                </span>
                            </template>
                        </div>
                        <span class="absolute -bottom-6 whitespace-nowrap font-label-md text-label-md transition-colors"
                            :class="{{ $num }} === currentStep ? 'text-primary dark:text-primary-dark' : {{ $num }} < currentStep ?
                                'text-secondary dark:text-secondary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark'">
                            {{ $label }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Content --}}
            <div class="mt-12">

                {{-- ── STEP 1: Download App ── --}}
                <div x-show="currentStep === 1">
                    <p class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark font-medium text-center mb-6">
                        Download an authenticator app on your phone
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div
                            class="app-card flex flex-col items-center p-4 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg 
                                    hover:border-primary dark:border-primary-dark hover:bg-surface dark:bg-surface-dark-container-low transition-all cursor-pointer">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSJZ4ldlWVXd7Uh2Pz8M7f3CjDPbs1-E3xT7ixKIPvdjGPO9ZE4QWs9xAqV70GT9okuwUEOUGE9YCd62JPqvu0Pc-Bi3LVcfZeUlng4usCncnMgPWl8E-MKoECEmq8EGYFqiTHcHYGzD1Ob1wCO9f0rQZntKMg99c1Hnn4m8fmRN1t50Zlteo-bNvwoHytQG5Ua89CBn9FAzS9a0PFIcQ2sq-BNpFhIherUQm3s5rdzIlQZMr0OX--UQ"
                                alt="Google Authenticator" class="w-12 h-12 mb-3 object-contain">
                            <h3 class="font-label-md text-label-md font-bold text-center">Google Authenticator</h3>
                            <p class="font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-center mt-1">Free on App
                                Store & Google Play</p>
                        </div>
                        <div
                            class="app-card flex flex-col items-center p-4 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg 
                                    hover:border-primary dark:border-primary-dark hover:bg-surface dark:bg-surface-dark-container-low transition-all cursor-pointer">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCueGLAFzerPuVp3QHZmc7uLgkhkDM59mWPb3QUJ_JU8M9kmd8YPDYN8UpfmgCuYjcUWgyMvTBZpSLGaJy6lGoktfbgf8rJana38FzumI_tEYJ4ko3SuGt3r3HPCxsDhN9eDkHxxArBitjdgiNRURvzVaOtu3FL1FCllvg3Ex7vGlriXtVXExTeo0ChWnXcoIE8GFBcKl2owjboluh6vQ7XyqrjA-_2rh6Wxaeq2Ix1Zl5VHzu6fqFdow"
                                alt="Microsoft Authenticator" class="w-12 h-12 mb-3 object-contain">
                            <h3 class="font-label-md text-label-md font-bold text-center">Microsoft Authenticator</h3>
                            <p class="font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-center mt-1">Free on App
                                Store & Google Play</p>
                        </div>
                    </div>
                    <button type="button" @click="enableAndLoad()" :disabled="loading"
                        :class="loading ? 'opacity-70 cursor-not-allowed' : 'hover:opacity-90'"
                        class="w-full bg-primary dark:bg-primary-dark text-white py-4 rounded-xl font-body-lg 
                                   flex items-center justify-center gap-2 active:scale-[0.98] transition-all">
                        <span x-show="loading"
                            class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span x-show="!loading" class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        <span x-text="loading ? 'Initializing...' : 'I have the app'"></span>
                    </button>
                </div>

                {{-- ── STEP 2: Scan QR ── --}}
                <div x-show="currentStep === 2">
                    <p class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark font-medium text-center mb-6">
                        Scan the QR code below using your app
                    </p>
                    <div class="flex flex-col items-center mb-6">
                        {{-- QR Code SVG from Fortify --}}
                        <div class="bg-white dark:bg-surface-container-low-dark p-4 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg mb-4 shadow-sm"
                            x-html="qrSvg"></div>

                        {{-- Manual secret key --}}
                        <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-2">Can't scan? Enter this code manually:</p>
                        <div class="flex items-center gap-2">
                            <code
                                class="font-bold text-primary dark:text-primary-dark tracking-widest font-mono bg-surface dark:bg-surface-dark-container px-3 py-1 rounded-lg"
                                x-text="secretKey ? secretKey.match(/.{1,4}/g)?.join(' ') : '...'"></code>
                            <button type="button" @click="copySecret()"
                                class="p-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors rounded-lg hover:bg-surface dark:bg-surface-dark-container">
                                <span class="material-symbols-outlined text-[18px]">content_copy</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <button type="button" @click="goToStep(3)"
                            class="w-full bg-primary dark:bg-primary-dark text-white py-4 rounded-xl font-body-lg 
                                       flex items-center justify-center gap-2 hover:opacity-90 active:scale-[0.98] transition-all">
                            Next
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                        <button type="button" @click="goToStep(1)"
                            class="w-full text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark py-2 font-label-md hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">
                            ← Back
                        </button>
                    </div>
                </div>

                {{-- ── STEP 3: Verify Code ── --}}
                <div x-show="currentStep === 3">
                    <p class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark font-medium text-center mb-6">
                        Enter the 6-digit code from your app
                    </p>

                    {{-- OTP Inputs --}}
                    <div class="flex justify-center gap-2 mb-2" x-ref="otpContainer" @paste="handleOtpPaste($event)">
                        @for ($i = 0; $i < 6; $i++)
                            <input x-ref="otp{{ $i }}" x-model="otpCode[{{ $i }}]"
                                @input="handleOtpInput({{ $i }}, $event)"
                                @keydown="handleOtpKeydown({{ $i }}, $event)"
                                :class="errorMessage ? 'border-error dark:border-error-dark focus:ring-error/30' :
                                    'border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:ring-primary dark:focus:ring-primary-dark/20'"
                                class="otp-input w-12 h-14 text-center text-xl font-bold border-2 rounded-lg 
                                      focus:outline-none focus:ring-4 transition-all bg-surface dark:bg-surface-dark-container-low"
                                maxlength="1" inputmode="numeric" autocomplete="one-time-code"
                                {{ $i === 3 ? 'style=margin-left:8px' : '' }}>
                        @endfor
                    </div>

                    {{-- Error Message --}}
                    <div x-show="errorMessage" class="text-center mb-4">
                        <p class="text-error dark:text-error-dark text-label-sm font-label-sm" x-text="errorMessage"></p>
                    </div>

                    <div class="flex flex-col gap-3 mt-6">
                        <button type="button" @click="confirmCode()"
                            :disabled="loading || otpCode.join('').length !== 6"
                            :class="loading || otpCode.join('').length !== 6 ?
                                'opacity-50 cursor-not-allowed' : 'hover:opacity-90'"
                            class="w-full bg-primary dark:bg-primary-dark text-white py-4 rounded-xl font-body-lg 
                                       flex items-center justify-center gap-2 active:scale-[0.98] transition-all">
                            <span x-show="loading"
                                class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            <span x-text="loading ? 'Verifying...' : 'Verify & Enable 2FA'"></span>
                        </button>
                        <button type="button" @click="goToStep(2)"
                            class="w-full text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark py-2 font-label-md hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">
                            ← Back
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </template>
</div>
