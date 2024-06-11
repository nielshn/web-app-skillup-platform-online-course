<x-guest-layout>
    @if (session('error'))
        <div id="pricing-error-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-sm rounded-md overflow-hidden shadow-lg bg-yellow-400">
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-white"> {{ __('Warning!') }}</span>
                        <button onclick="closeMessage('pricing-error-message')" class="text-white">&times;</button>
                    </div>
                    <p class="text-white">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
    <script>
        // Function to hide pricing error message after 5 seconds
        setTimeout(function() {
            var pricingErrorMessage = document.getElementById('pricing-error-message');
            if (pricingErrorMessage) {
                pricingErrorMessage.remove();
            }
        }, 5000);
    </script>
    <section class="login_box_area section_gap"
        style="display: flex; align-items: center; justify-content: center; height: 100vh; background-color: #f0f0f0;">
        <div class="container"
            style="max-width: 1000px; background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); display: flex; padding: 0; border-radius: 10px; overflow: hidden;">
            <div class="col-lg-5"
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f7f7f7; padding: 20px;">
                <div class="login_box_img" style="text-align: center;">
                    <img class="img-fluid" src="{{ asset('img/login.jpg') }}" alt=""
                        style="width: 100%; height: auto; max-height: 500px;" />
                    <div class="hover" style="padding: 20px;">
                        <h4>New to our website?</h4>
                        <p>
                            There are advances being made in science and technology every day, and a good example of
                            this is the rise of online courses, making education more accessible.
                        </p>
                        <a class="primary-btn" href="{{ route('register') }}"
                            style="background-color: #ff7c00; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Create
                            an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7"
                style="display: flex; align-items: center; justify-content: center; padding: 40px; background-color: #ffffff;">
                <form method="POST" action="{{ route('login') }}" class="login_form" id="contactForm"
                    novalidate="novalidate" style="width: 100%; max-width: 500px;">
                    @csrf
                    <h3 style="text-align: center; margin-bottom: 30px; font-size: 24px;">LOG IN TO ENTER</h3>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            :value="old('email')" required autofocus onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Email'" style="padding: 15px; font-size: 16px; width: 120%;" />
                        @error('email')
                            <span class="text-red-500 text-sm"
                                style="display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password" required onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Password'"
                            style="padding: 15px; font-size: 16px; width: 120%;" />
                        @error('password')
                            <span class="text-red-500 text-sm"
                                style="display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group"
                        style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <button type="submit" value="submit" class="primary-btn"
                            style="background-color: #ff7c00; color: #fff; padding: 10px 20px; border-radius: 5px; width: 50%;">Log
                            In</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
