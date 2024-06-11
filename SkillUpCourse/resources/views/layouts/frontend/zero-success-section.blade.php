<section id="Zero-to-Success"
    class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
    <div class="flex flex-col gap-[30px] items-center text-center">
        <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
            <div>
                <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#FF6129]">Zero to Success People</p>
        </div>
        <div class="flex flex-col">
            <h2 class="font-bold text-[40px] leading-[60px]">Happy & Success Students</h2>
            <p class="text-[#6D7786] text-lg -tracking-[2%]">Acquiring skills and new high paying career become much
                easier</p>
        </div>
    </div>
    <div class="testi w-full overflow-hidden flex flex-col gap-6 relative">
        <div class="fade-overlay absolute z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA] to-[#F5F8FA00]">
        </div>
        <div class="fade-overlay absolute right-0 z-10 h-full w-[50px] bg-gradient-to-r from-[#F5F8FA00] to-[#F5F8FA]">
        </div>
        <div class="group/slider flex flex-nowrap w-max items-center">
            <div
                class="testi-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap">
                @foreach ($reviews as $review)
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ Storage::url($review->user->avatar) }}" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">{{ $review->user->name }}</p>
                        </div>
                        <p class="text-sm text-[#475466]">{{ $review->note }}</p>
                        <div class="flex gap-[2px]">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <div>
                                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                </div>
                            @endfor

                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="logo-container animate-[slideToL_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap ">
                @foreach ($reviews as $review)
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ Storage::url($review->user->avatar) }}" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">{{ $review->user->name }}</p>
                        </div>
                        <p class="text-sm text-[#475466]">{{ $review->note }}</p>
                        <div class="flex gap-[2px]">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <div>
                                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                </div>
                            @endfor

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="group/slider flex flex-nowrap w-max items-center">
            <div
                class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap">
                @foreach ($reviews as $review)
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ Storage::url($review->user->avatar) }}" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">{{ $review->user->name }}</p>
                        </div>
                        <p class="text-sm text-[#475466]">{{ $review->note }}</p>
                        <div class="flex gap-[2px]">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <div>
                                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                </div>
                            @endfor

                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="logo-container animate-[slideToR_50s_linear_infinite] group-hover/slider:pause-animate flex gap-6 pl-6 items-center flex-nowrap ">
                @foreach ($reviews as $review)
                    <div class="test-card w-[300px] flex flex-col h-full bg-white rounded-xl gap-3 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ Storage::url($review->user->avatar) }}" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <p class="font-semibold">{{ $review->user->name }}</p>
                        </div>
                        <p class="text-sm text-[#475466]">{{ $review->note }}</p>
                        <div class="flex gap-[2px]">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <div>
                                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                </div>
                            @endfor

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
