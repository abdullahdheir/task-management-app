@extends('layouts.app')

@section('title', '2FA Login Challenge')

@push('styles')
    <style>
        .otp-input:focus {
            border-color: #3525cd;
            box-shadow: 0 0 0 3px rgba(53, 37, 205, 0.15);
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-background flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-xl border border-outline-variant p-8"
            style="box-shadow: 0px 4px 6px -1px rgba(0,0,0,0.05)" x-data="{
                mode: 'code',
                otpCode: ['', '', '', '', '', ''],
                recoveryCode: '',
                loading: false,
                errorMessage: '',
            
                handleOtpInput(index, event) {
                    const val = event.target.value.replace(/\D/g, '');
                    this.otpCode[index] = val.slice(-1);
                    event.target.value = this.otpCode[index];
                    if (this.otpCode[index] && index < 5)
                        this.$nextTick(() => this.$refs['otp' + (index + 1)]?.focus());
                },
                handleOtpKeydown(index, event) {
                    if (event.key === 'Backspace' && !this.otpCode[index] && index > 0)
                        this.$nextTick(() => this.$refs['otp' + (index - 1)]?.focus());
                },
                handlePaste(event) {
                    const paste = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
                    paste.split('').forEach((c, i) => this.otpCode[i] = c);
                    event.preventDefault();
                    this.$nextTick(() => this.$refs['otp' + Math.min(paste.length, 5)]?.focus());
                }
            }">

            {{-- Icon --}}
            <div class="flex flex-col items-center text-center mb-8">
                <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center mb-4"
                    style="box-shadow: 0 0 20px rgba(53,37,205,0.2)">
                    <span class="material-symbols-outlined text-white text-[32px]">lock</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface">Two-Factor Authentication</h1>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-xs">
                    <span x-show="mode === 'code'">Enter the 6-digit code from your authenticator app</span>
                    <span x-show="mode === 'recovery'">Enter one of your emergency recovery codes</span>
                </p>
            </div>

            {{-- Code Mode --}}
            <form method="POST" action="/two-factor-challenge" x-show="mode === 'code'">
                @csrf
                <div class="flex justify-center gap-2 mb-2" @paste="handlePaste($event)">
                    @for ($i = 0; $i < 6; $i++)
                        <input x-ref="otp{{ $i }}" name="{{ $i === 0 ? 'code' : '' }}"
                            x-model="otpCode[{{ $i }}]" @input="handleOtpInput({{ $i }}, $event)"
                            @keydown="handleOtpKeydown({{ $i }}, $event)"
                            class="w-12 h-14 text-center text-xl font-bold border-2 rounded-lg
                              focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/20
                              transition-all bg-surface-container-low border-outline-variant
                              @error('code') border-error @enderror"
                            maxlength="1" inputmode="numeric" autocomplete="one-time-code"
                            {{ $i === 3 ? 'style=margin-left:8px' : '' }}>
                    @endfor
                </div>

                {{-- Hidden input with full code for form submission --}}
                <input type="hidden" name="code" :value="otpCode.join('')">

                @error('code')
                    <p class="text-error text-label-sm text-center mb-4">{{ $message }}</p>
                @enderror

                {{-- Trust Device --}}
                <div class="flex items-center gap-3 mt-6 mb-6 px-1">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="remember" class="font-label-md text-label-md text-on-surface-variant cursor-pointer">
                        Trust this device for 30 days
                    </label>
                </div>

                <button type="submit" :disabled="otpCode.join('').length !== 6"
                    :class="otpCode.join('').length !== 6 ? 'opacity-50 cursor-not-allowed' : 'hover:opacity-90'"
                    class="w-full bg-primary text-white py-4 rounded-xl font-body-lg 
                           active:scale-[0.98] transition-all">
                    Verify Code
                </button>
            </form>

            {{-- Recovery Code Mode --}}
            <form method="POST" action="/two-factor-challenge" x-show="mode === 'recovery'" style="display:none">
                @csrf
                <input type="text" name="recovery_code" x-model="recoveryCode" placeholder="xxxx-xxxx-xxxx-xxxx"
                    class="w-full border-2 border-outline-variant rounded-xl px-4 py-3 font-mono
                          text-center tracking-widest focus:border-primary focus:ring-4 
                          focus:ring-primary/20 focus:outline-none transition-all mb-6
                          @error('recovery_code') border-error @enderror">
                @error('recovery_code')
                    <p class="text-error text-label-sm text-center mb-4">{{ $message }}</p>
                @enderror
                <button type="submit" :disabled="!recoveryCode.trim()"
                    :class="!recoveryCode.trim() ? 'opacity-50 cursor-not-allowed' : 'hover:opacity-90'"
                    class="w-full bg-primary text-white py-4 rounded-xl font-body-lg transition-all">
                    Use Recovery Code
                </button>
            </form>

            {{-- Toggle Mode --}}
            <div class="mt-6 text-center space-y-2">
                <button @click="mode = mode === 'code' ? 'recovery' : 'code'"
                    class="font-label-md text-label-md text-primary hover:underline transition-colors">
                    <span x-text="mode === 'code' ? 'Use a recovery code instead' : 'Use authenticator app instead'"></span>
                </button>
                <p class="text-label-sm text-on-surface-variant">
                    Having trouble? <a href="mailto:support@focus.app" class="text-primary hover:underline">Contact
                        support</a>
                </p>
            </div>
        </div>
    </div>
@endsection
