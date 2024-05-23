@extends('layouts.frontend.main')
@section('title')
    Home Page
@endsection
@section('content')
    <div id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 pb-[50px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('layouts.frontend.navbar')
        <div class="flex flex-col items-center gap-[30px]">
            <div class="w-fit flex items-center gap-3 p-2 pr-6 rounded-full bg-[#FFFFFF1F] border border-[#3477FF24]">
                <div class="w-[100px] h-[48px] flex shrink-0">
                    <img src="{{ asset('assets/icon/avatar-group.png') }}" class="object-contain" alt="icon">
                </div>
                <p class="font-semibold text-sm text-white">Join 3 million users</p>
            </div>
            <div class="flex flex-col gap-[10px]">
                <h1 class="font-semibold text-[80px] leading-[82px] text-center gradient-text-hero">Build Future Career.
                </h1>
                <p class="text-center text-xl leading-[36px] text-[#F5F8FA]">SkillUp provides high quality online
                    courses
                    for you to grow <br>
                    your skills and build outstanding portfolio to tackle job interviews</p>
            </div>
            <div class="flex gap-6 w-fit">
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Explore
                    Courses</a>
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Career
                    Guidance</a>
            </div>
        </div>
        <div class="flex gap-[70px] items-center justify-center">
            <div>
                <img src="{{ asset('assets/icon/logo-55.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo-54.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo-52.svg') }}" alt="icon">
            </div>
        </div>
    </div>
    <!-- Top Categories Section -->
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col p-[70px_50px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Top Categories</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Browse Courses</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Catching up the on demand skills and high paying career
                    this year</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[30px]">
            @foreach ($categories as $category)
                <a href="{{ route('front.category', $category->slug) }}"
                    class="card flex flex-col items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300">
                    <div class="w-[70px] h-[70px] flex shrink-0">
                        <img src="assets/icon/Web Development 1.svg" class="object-contain" alt="icon">
                    </div>
                    <p class="font-bold text-lg text-center text-black">{{ $category->name }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="Popular-Courses"
        class="max-w-[1200px] mx-auto flex flex-col p-[70px_82px_0px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Popular Courses</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Don’t Missed It, Learn Now</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Catching up the on demand skills and high paying
                    career this year</p>
            </div>
        </div>
        <div class="relative">
            <button class="btn-prev absolute rotate-180 -left-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>
            <button class="btn-prev absolute -right-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>
            <div id="course-slider" class="w-full">
                @forelse ($courses as $course)
                    <div class="course-card w-1/3 px-3 pb-[70px] mt-[2px]">
                        <div
                            class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white w-full pb-[10px] overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                            <a href="{{ route('front.details', $course->slug) }}"
                                class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </a>
                            <div class="flex flex-col px-4 gap-[10px]">
                                <a href="{{ route('front.details', $course->slug) }}"
                                    class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">{{ $course->name }}</a>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-[2px]">
                                        <div>
                                            <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                        </div>
                                    </div>
                                    <p class="text-right text-[#6D7786]">{{ $course->students->count() }} students</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($course->teacher->user->avatar) }}"
                                            class="w-full h-full object-cover" alt="icon">
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-semibold">{{ $course->teacher->user->name }}</p>
                                        <p class="text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada data kelas yang baru</p>
                @endforelse
            </div>
        </div>
    </section>
    <section id="Pricing" class="max-w-[1200px] mx-auto flex justify-between items-center p-[70px_100px]">
        <div class="relative">
            <div class="w-[355px] h-[488px]">
                <img src="assets/background/benefit_illustration.png" alt="icon">
            </div>
            <div
                class="absolute w-[230px] transform -translate-y-1/2 top-1/2 left-[214px] bg-white z-10 rounded-[20px] gap-4 p-4 flex flex-col shadow-[0_17px_30px_0_#0D051D0A]">
                <p class="font-semibold">Materials</p>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="assets/icon/video-play.svg" alt="icon">
                    </div>
                    <p class="font-medium">Videos</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="assets/icon/note-favorite.svg" alt="icon">
                    </div>
                    <p class="font-medium">Handbook</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="assets/icon/3dcube.svg" alt="icon">
                    </div>
                    <p class="font-medium">Assets</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="assets/icon/award.svg" alt="icon">
                    </div>
                    <p class="font-medium">Certificates</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="assets/icon/book.svg" alt="icon">
                    </div>
                    <p class="font-medium">Documentations</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col text-left gap-[30px]">
            <h2 class="font-bold text-[36px] leading-[52px]">Learn From Anywhere,<br>Anytime You Want</h2>
            <p class="text-[#475466] text-lg leading-[34px]">Growing new skills would be more flexible without <br> limit
                we help you to access all course materials.</p>
            <a href="{{ route('front.pricing') }}"
                class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">Check
                Pricing</a>
        </div>
    </section>
    <section id="FAQ" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px]">
        <div class="flex justify-between items-center">
            <div class="flex flex-col gap-[30px]">
                <div
                    class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                    <div>
                        <img src="assets/icon/medal-star.svg" alt="icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">Grow Your Career</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-bold text-[36px] leading-[52px]">Get Your Answers</h2>
                    <p class="text-lg text-[#475466]">It’s time to upgrade skills without limits!</p>
                </div>
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">Contact
                    Our Sales</a>
            </div>
            <div class="flex flex-col gap-[30px] w-[552px] shrink-0">
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-1">
                        <span class="font-semibold text-lg text-left">Can beginner join the course?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="assets/icon/add.svg" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-1" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Yes, we have provided a variety range of course
                            from beginner to intermediate level to prepare your next big career,</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-2">
                        <span class="font-semibold text-lg text-left">How long does the implementation take?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="assets/icon/add.svg" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-2" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Lorem ipsum dolor, sit amet consectetur
                            adipisicing elit. Dolore placeat ut nostrum aperiam mollitia tempora aliquam perferendis
                            explicabo eligendi commodi.</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-3">
                        <span class="font-semibold text-lg text-left">Do you provide the job-guarantee program?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="assets/icon/add.svg" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-3" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Molestiae itaque facere ipsum animi sunt iure!</p>
                    </div>
                </div>
                <div
                    class="flex flex-col p-5 rounded-2xl bg-[#FFF8F4] has-[.hide]:bg-transparent border-t-4 border-[#FF6129] has-[.hide]:border-0 w-full">
                    <button class="accordion-button flex justify-between gap-1 items-center"
                        data-accordion="accordion-faq-4">
                        <span class="font-semibold text-lg text-left">How to issue all course certificates?</span>
                        <div class="arrow w-9 h-9 flex shrink-0">
                            <img src="assets/icon/add.svg" alt="icon">
                        </div>
                    </button>
                    <div id="accordion-faq-4" class="accordion-content hide">
                        <p class="leading-[30px] text-[#475466] pt-[10px]">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Molestiae itaque facere ipsum animi sunt iure!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style')
    <style>
        .grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 30px;
        }

        @media (min-width: 640px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .thumbnail img {
            transition: transform 0.3s;
        }

        .thumbnail:hover img {
            transform: scale(1.1);
        }
    </style>
@endpush
