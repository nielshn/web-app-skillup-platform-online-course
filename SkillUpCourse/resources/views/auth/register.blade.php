<x-guest-layout>
    <section class="login_box_area section_gap"
        style="display: flex; align-items: center; justify-content: center; height: 100vh; background-color: #f0f0f0;">
        <div class="container"
            style="max-width: 1000px; background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); display: flex; padding: 0; border-radius: 10px; overflow: hidden;">
            <div class="col-lg-7"
                style="display: flex; align-items: center; justify-content: center; padding: 40px; background-color: #ffffff;">
                <form method="POST" action="{{ route('register') }}" class="login_form" id="registerForm"
                    enctype="multipart/form-data" novalidate="novalidate" style="width: 100%; max-width: 500px;">
                    @csrf
                    <h3 style="text-align: center; margin-bottom: 30px; font-size: 24px;">CREATE AN ACCOUNT</h3>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            :value="old('name')" required autofocus autocomplete="name"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"
                            style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            :value="old('email')" required autocomplete="email" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Email'" style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="text" class="form-control" id="occupation" name="occupation"
                            placeholder="Occupation" :value="old('occupation')" required autocomplete="occupation"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Occupation'"
                            style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('occupation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Avatar"
                            :value="old('avatar')" required autocomplete="avatar" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Avatar'" style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('avatar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password" required autocomplete="new-password" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Password'"
                            style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; width: 100%;">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Confirm Password'"
                            style="padding: 15px; font-size: 16px; width: 100%;" />
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group"
                        style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <button type="submit" value="submit" class="primary-btn"
                            style="background-color: #ff7c00; color: #fff; padding: 10px 20px; border-radius: 5px; width: 50%;">Register</button>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('login') }}" style="text-decoration: none; color: #333;">Already have an
                            account? Login</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-5"
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f7f7f7; padding: 20px;">
                <div class="login_box_img" style="text-align: center;">
                    <img class="img-fluid" src="{{ asset('img/login.jpg') }}" alt="Login Image"
                        style="width: 100%; height: auto; max-height: 500px;" />
                    <div class="hover" style="padding: 20px;">
                        <h4>New to our website?</h4>
                        <p>
                            There are advances being made in science and technology every day, and a good example of
                            this is the rise of online courses, making education more accessible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
