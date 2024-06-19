<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-md">
            <div class="flex flex-col items-center">
                <div class="w-40 h-10 mb-4">
                    <svg width="300" height="80" viewBox="0 0 300 80" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.0246 33.1115C22.0605 29.4401 21.1297 26.4545 19.9457 26.4429C18.7616 26.4314 17.7727 29.3983 17.7368 33.0696C17.7009 36.7411 18.6317 39.7267 19.8157 39.7383C20.9998 39.7499 21.9888 36.783 22.0246 33.1115Z"
                            fill="#FF6129" />
                        <path
                            d="M15.1576 32.2777C17.1728 29.2086 18.0041 26.1937 17.0144 25.5438C16.0245 24.8939 13.5884 26.855 11.5732 29.9241C9.55797 32.9933 8.72669 36.0081 9.71645 36.6581C10.7063 37.308 13.1423 35.3469 15.1576 32.2777Z"
                            fill="#FF6129" />
                        <path
                            d="M9.82334 27.8744C13.1781 26.3822 15.5074 24.2955 15.0261 23.2136C14.5449 22.1316 11.4353 22.4643 8.08062 23.9565C4.72593 25.4487 2.39655 27.5354 2.87779 28.6173C3.35902 29.6992 6.46865 29.3666 9.82334 27.8744Z"
                            fill="#FF6129" />
                        <path
                            d="M14.6236 20.1795C14.8037 19.0092 12.008 17.6076 8.37917 17.0491C4.75028 16.4905 1.66249 16.9865 1.48236 18.1568C1.30223 19.3272 4.09797 20.7286 7.72684 21.2872C11.3557 21.8457 14.4435 21.3497 14.6236 20.1795Z"
                            fill="#FF6129" />
                        <path
                            d="M15.9265 17.3917C16.7106 16.5045 15.1161 13.8142 12.3649 11.3827C9.61381 8.9513 6.74791 7.6995 5.96376 8.58674C5.17962 9.47401 6.77418 12.1643 9.52533 14.5958C12.2765 17.0272 15.1424 18.279 15.9265 17.3917Z"
                            fill="#FF6129" />
                        <path
                            d="M18.5211 15.7623C19.6605 15.4399 19.7737 12.3146 18.774 8.7817C17.7743 5.24883 16.0402 2.64624 14.9009 2.96865C13.7615 3.29106 13.6483 6.41637 14.648 9.94927C15.6477 13.4821 17.3818 16.0847 18.5211 15.7623Z"
                            fill="#FF6129" />
                        <path
                            d="M25.5668 10.0592C26.636 6.54673 26.5845 3.41979 25.4517 3.07498C24.3189 2.73017 22.5338 5.29805 21.4646 8.81053C20.3955 12.323 20.447 15.4499 21.5798 15.7947C22.7126 16.1395 24.4977 13.5717 25.5668 10.0592Z"
                            fill="#FF6129" />
                        <path
                            d="M30.6011 14.8053C33.3993 12.4281 35.0461 9.76948 34.2794 8.8671C33.5128 7.9647 30.6229 9.16028 27.8249 11.5374C25.0267 13.9146 23.3799 16.5732 24.1465 17.4756C24.9132 18.378 27.803 17.1825 30.6011 14.8053Z"
                            fill="#FF6129" />
                        <path
                            d="M32.2657 21.5215C35.9049 21.0347 38.7277 19.6886 38.5707 18.5149C38.4137 17.3413 35.3363 16.7846 31.6971 17.2714C28.058 17.7583 25.2351 19.1043 25.3921 20.278C25.5492 21.4516 28.6265 22.0084 32.2657 21.5215Z"
                            fill="#FF6129" />
                        <path
                            d="M36.9603 28.9528C37.4628 27.8806 35.175 25.7484 31.8504 24.1903C28.5258 22.6322 25.4234 22.2384 24.9209 23.3105C24.4184 24.3828 26.7062 26.515 30.0308 28.0731C33.3554 29.6311 36.4579 30.025 36.9603 28.9528Z"
                            fill="#FF6129" />
                        <path
                            d="M29.9671 36.864C30.9695 36.2338 30.1978 33.203 28.2435 30.0948C26.2892 26.9866 23.8922 24.9778 22.8898 25.6081C21.8874 26.2383 22.6591 29.269 24.6134 32.3773C26.5678 35.4855 28.9647 37.4943 29.9671 36.864Z"
                            fill="#FF6129" />
                        <text x="47" y="35" font-family="serif" font-size="32" fill="black">SkillUp</text>
                    </svg>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    {{ __('Reset Password') }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ __('Enter your email address and new password to reset your password.') }}
                </p>
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="'Password'" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="'Confirm Password'" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-6">
                    <x-primary-button class="w-full py-3 text-center">
                        <span class="w-full text-center">{{ __('Reset Password') }}</span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
