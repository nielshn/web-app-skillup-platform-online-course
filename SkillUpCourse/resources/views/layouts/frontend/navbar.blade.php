<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUp</title>
</head>

<body>
    <nav class="flex justify-between items-center pt-6 px-[50px]">
        <a href="{{ route('front.index') }}">
            <img src="{{ asset('assets/logo/logo.svg') }}" alt="logo">
        </a>
        <ul class="flex items-center gap-[30px] text-white">
            <li>
                <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
            </li>
            <li>
                <a href="{{ route('front.my_courses') }}" class="font-semibold">My Courses</a>
            </li>
            <li>
                <a href="{{ route('front.pricing') }}" class="font-semibold">Pricing</a>
            </li>
            <li>
                <a href="{{ route('front.checkout.details') }}" class="font-semibold">Invoice</a>
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
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">
                    </a>
                </div>
                <!-- Notification Icon -->
                <div class="relative">
                    <div class="relative notification-icon  ">
                        <i class="fas fa-bell text-white text-lg"></i>
                        <!-- Notification badge -->
                        @if (isset($unreadNotifications) && $unreadNotifications->count() > 0)
                            <span class="notification-badge"></span>
                        @endif
                    </div>
                    <!-- Notification messages -->
                    <div class="notification-messages hidden">
                        <ul>
                            @if (isset($notifications) && $notifications->count() > 0)
                                @foreach ($notifications as $notification)
                                    <li>
                                        <span class="title">{{ $notification->message }}</span>
                                        <br>
                                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li>Tidak ada notifikasi</li>
                            @endif
                        </ul>
                    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationIcon = document.querySelector('.notification-icon');
            const notificationMessages = document.querySelector('.notification-messages');

            notificationIcon.addEventListener('click', function(event) {
                event.preventDefault();
                notificationMessages.classList.toggle('hidden');

                fetch('{{ route('notifications.markAsRead') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const notificationBadge = document.querySelector('.notification-badge');
                            if (notificationBadge) {
                                notificationBadge.style.display = 'none';
                            }
                        }
                    });
            });

            // Close the notification messages when clicking outside
            document.addEventListener('click', function(event) {
                if (!notificationIcon.contains(event.target) && !notificationMessages.contains(event
                        .target)) {
                    notificationMessages.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
