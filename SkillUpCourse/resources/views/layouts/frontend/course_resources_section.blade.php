<section id="Video-Resources" class="flex flex-col mt-5">
    <div class="max-w-[1100px] w-full mx-auto flex flex-col gap-3">
        <h1 class="title font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/crown.svg') }}" alt="icon">
                </div>
                <p class="font-semibold">{{ $course->category->name }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/award-outline.svg') }}" alt="icon">
                </div>
                <p class="font-semibold">Certificate</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/profile-2user.svg') }}" alt="icon">
                </div>
                <p class="font-semibold">{{ $course->students->count() }} students</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/brifecase-tick.svg') }}" alt="icon">
                </div>
                <p class="font-semibold">Job-Guarantee</p>
            </div>
        </div>
    </div>
    <div
        class="max-w-[1100px] w-full mx-auto mt-10 tablink-container flex gap-3 px-4 sm:p-0 no-scrollbar overflow-x-scroll">
        <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
            onclick="openPage('About', this)" id="defaultOpen">About</div>
        {{-- <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
            onclick="openPage('Resources', this)">Resources</div> --}}
        <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
            onclick="openPage('Reviews', this)">Reviews</div>
        {{-- <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
            onclick="openPage('Discussions', this)">Discussions</div> --}}
        {{-- <div class="tablink font-semibold text-lg h-[47px] transition-all duration-300 cursor-pointer hover:text-[#FF6129]"
            onclick="openPage('Rewards', this)">Rewards</div> --}}
    </div>
    <div class="bg-[#F5F8FA] py-[50px]">
        <div class="max-w-[1100px] w-full mx-auto flex flex-col gap-[70px]">
            <div class="flex gap-[50px]">
                <div class="tabs-container w-[700px] flex shrink-0">
                    <div id="About" class="tabcontent hidden">
                        <div class="flex flex-col gap-5 w-[700px] shrink-0">
                            <h3 class="font-bold text-2xl">Grow Your Career</h3>
                            <p class="font-medium leading-[30px]">{!! $course->about !!}</p>
                            <div class="grid grid-cols-2 gap-x-[30px] gap-y-5">
                                @forelse ($course->course_keypoints as $keypoint)
                                    <div class="benefit-card flex items-center gap-3">
                                        <div class="w-6 h-6 flex shrink-0">
                                            <img src="{{ asset('assets/icon/tick-circle.svg') }}" alt="icon">
                                        </div>
                                        <p class="font-medium leading-[30px]">{{ $keypoint->name }}</p>
                                    </div>
                                @empty
                                    <p>No keypoints available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div id="Resources" class="tabcontent hidden">
                        <div class="flex flex-col gap-5 w-[700px] shrink-0">
                            <h3 class="font-bold text-2xl">Resources</h3>
                            <p class="font-medium leading-[30px]">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Nesciunt eos et accusantium quia exercitationem reiciendis? Doloribus, voluptate
                                natus voluptas deserunt aliquam nesciunt blanditiis ipsum porro hic! Iusto maxime ullam
                                soluta.</p>
                        </div>
                    </div>
                    <div id="Reviews" class="tabcontent hidden">
                        <div class="flex flex-col gap-5 w-[700px] shrink-0">
                            <h3 class="font-bold text-2xl">Reviews</h3>
                            @foreach ($reviews as $review)
                                <div class="review-card relative">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <a href="#"
                                                class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                                <img src="{{ Storage::url($review->user->avatar) }}"
                                                    class="w-full h-full object-cover" alt="photo">
                                            </a>
                                        </div>
                                        <div class="user-info">
                                            <p class="font-semibold">{{ $review->user->name }}</p>
                                            <div class="flex items-center gap-[2px]">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <div>
                                                        <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                                                    </div>
                                                @endfor
                                            </div>
                                            <p class="text-sm text-gray-500">{{ $review->note }}</p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($allReviews->count() > 3)
                            <div class="flex justify-center mt-6 w-full">
                                <button id="loadMoreReviews"
                                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">
                                    Load More
                                </button>
                            </div>
                        @endif


                    </div>


                </div>
                <div class="mentor-sidebar flex flex-col gap-[30px] w-full">
                    <div class="mentor-info bg-white flex flex-col gap-4 rounded-2xl p-5">
                        <p class="font-bold text-lg text-left w-full">Teacher</p>
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-3">
                                <a href="" class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ Storage::url($course->teacher->user->avatar) }}"
                                        class="w-full h-full object-cover" alt="photo">
                                </a>
                                <div class="flex flex-col gap-[2px]">
                                    <a href="" class="font-semibold">{{ $course->teacher->user->name }}</a>
                                    <p class="text-sm text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
                                </div>
                            </div>
                            <a href=""
                                class="p-[4px_12px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">Follow</a>
                        </div>
                    </div>
                    <div class="bg-white flex flex-col gap-5 rounded-2xl p-5">
                        <p class="font-bold text-lg text-left w-full">Unlock Badges</p>
                        <div class="flex items-center gap-3">
                            <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/icon/Group 7.svg') }}" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <div class="font-semibold">Spirit of Learning</div>
                                <p class="text-sm text-[#6D7786]">18,393 earned</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/icon/Group 7-1.svg') }}" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <div class="font-semibold">Everyday New</div>
                                <p class="text-sm text-[#6D7786]">6,392 earned</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets/icon/Group 7-2.svg') }}"
                                    class="w-full h-full object-cover" alt="icon">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <div class="font-semibold">Quick Learner Pro</div>
                                <p class="text-sm text-[#6D7786]">44 earned</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Screenshots" class="flex flex-col gap-3">
                <h3 class="title-section font-bold text-xl leading-[30px]">Sneak Peek Project</h3>
                <div class="grid grid-cols-4 gap-5">
                    @forelse ($courseImage as $image)
                        <div
                            class="rounded-[20px] overflow-hidden w-full h-[200px] hover:shadow-[0_10px_20px_0_#0D051D20] transition-all duration-300">
                            <a href="{{ Storage::url($image->image) }}" data-fancybox="gallery"
                                data-caption="Caption">
                                <img src="{{ Storage::url($image->image) }}" class="object-cover h-full w-full"
                                    alt="image">
                            </a>
                        </div>
                    @empty
                        <p>No images available for this course.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
    }

    function showEditModal(reviewId) {

        fetch(`/reviews/${reviewId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('review-id').value = data.id;
                document.getElementById('edit-rating').value = data.rating;
                document.getElementById('edit-note').value = data.note;
                document.getElementById('edit-review-form').action = `admin.reviews/${reviewId}`;
                document.getElementById('edit-modal').classList.remove('hidden');
            });
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }


    let skip = 3;
    document.getElementById('loadMoreReviews').addEventListener('click', function() {
        fetch('{{ route('load-more-reviews', ['course' => $course->id]) }}?skip=' + skip)
            .then(response => response.json())
            .then(data => {
                const reviewsContainer = document.querySelector('#Reviews .flex.flex-col');
                data.forEach(review => {
                    const reviewCard = document.createElement('div');
                    reviewCard.classList.add('review-card', 'relative');
                    reviewCard.innerHTML = `
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <a href="#" class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ Storage::url('${review.user.avatar}') }}" class="w-full h-full object-cover" alt="photo">
                                </a>
                            </div>
                            <div class="user-info">
                                <p class="font-semibold">${review.user.name}</p>
                                <div class="flex items-center gap-[2px]">
                                    ${'★'.repeat(review.rating)}
                                </div>
                                <p class="text-sm text-gray-500">${review.note}</p>
                            </div>
                        </div>
                    `;
                    reviewsContainer.appendChild(reviewCard);
                });

                skip += data.length;


                if (data.length < 4) {
                    document.getElementById('loadMoreReviews').style.display = 'none';
                }
            })
            .catch(error => console.error('Error loading more reviews:', error));
    });
</script>
