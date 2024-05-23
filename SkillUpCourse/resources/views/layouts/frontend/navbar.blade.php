<nav class="flex justify-between items-center pt-6 px-[50px]">
    <a href="">
        <img src="{{ asset('assets/logo/logo.svg') }}" alt="logo">
    </a>
    <ul class="flex items-center gap-[30px] text-white">
        <li>
            <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
        </li>
        <li>
            <a href="{{ route('front.pricing') }}" class="font-semibold">Pricing</a>
        </li>
        <li>
            <a href="#" class="font-semibold">Benefits</a>
        </li>
        <li>
            <a href="#" class="font-semibold">Stories</a>
        </li>
    </ul>
    @auth
        <div class="flex gap-[10px] items-center">
            <div class="flex flex-col items-end justify-center">
                <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                @if (Auth::user()->hasActiveSubscription())
                    <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                        PRO
                    </p>
                @endif

            </div>
            <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="photo">
                </a>
            </div>
        </div>
    @endauth
    @guest
        <div class="flex gap-[10px] items-center">
            <a href="{{ route('register') }}"
                class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign
                Up</a>
            <a href="{{ route('login') }}"
                class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign
                In</a>
        </div>
    @endguest
</nav>
