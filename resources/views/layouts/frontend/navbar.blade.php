<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hidden {
            display: none;
        }
        .notification-messages {
            right: 0;
            top: 50px;
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }
        .notification-messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .notification-messages li {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }
        .notification-messages li:last-child {
            border-bottom: none;
        }
        .notification-messages li:hover {
            background-color: #f9f9f9;
        }
        .notification-messages .title {
            font-weight: bold;
        }
        .notification-messages .time {
            font-size: 0.8em;
            color: #888;
        }
        .notification-icon {
            position: relative;
            cursor: pointer;
        }
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background-color: #ff0000;
            border-radius: 50%;
        }
    </style>
</head>
<body>
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
            <!-- Notification Icon -->
            <div class="relative">
                <div class="relative notification-icon">
                    <i class="fas fa-bell text-white text-lg"></i>
                    <!-- Notification badge -->
                    @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                        <span class="notification-badge"></span>
                    @endif
                </div>
                <!-- Notification messages -->
                <div class="notification-messages hidden absolute">
                    <ul>
                        @if(isset($notifications) && $notifications->count() > 0)
                            @foreach($notifications as $notification)
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

                // Kirim permintaan AJAX untuk menandai semua notifikasi sebagai sudah dibaca
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
                if (!notificationIcon.contains(event.target) && !notificationMessages.contains(event.target)) {
                    notificationMessages.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
