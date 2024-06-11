@extends('layouts.frontend.main')
@section('title')
    Learning Course Page
@endsection
@section('content')
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full h-[393px] flex flex-col gap-10 pb-[50px] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden absolute transform -translate-x-1/2 left-1/2">
        @include('layouts.frontend.navbar')
    </div>

    <div class="top-right-container">
        @if (session('success'))
            <div class="alert alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Success!</strong><br> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Error!</strong> <br> {{ session('error') }}
            </div>
        @endif
    </div>



    <section id="video-content" class="max-w-[1100px] w-full mx-auto mt-[130px]">
        <div class="video-player relative flex flex-nowrap gap-5">
            <div class="plyr__video-embed w-full overflow-hidden relative rounded-[20px]" id="player">
                <iframe src="https://www.youtube.com/embed/{{ $video->path_video }}" allowfullscreen allowtransparency
                    allow="autoplay"></iframe>
            </div>
            <div
                class="video-player-sidebar flex flex-col shrink-0 w-[330px] h-[470px] bg-[#F5F8FA] rounded-[20px] p-5 gap-5 pb-0 overflow-y-scroll no-scrollbar">
                <p class="font-bold text-lg text-black">{{ $course->course_videos->count() }} Lessons</p>
                <div class="flex flex-col gap-3">
                    <div
                        class="group p-[12px_16px] flex items-center gap-[10px] bg-[#E9EFF3] rounded-full hover:bg-[#3525B3] transition-all duration-300">
                        <div class="text-black group-hover:text-white transition-all duration-300">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <a href="{{ route('front.details', $course) }}">
                            <p class="font-semibold group-hover:text-white transition-all duration-300">Course Trailer
                            </p>
                        </a>
                    </div>
                    @forelse ($course->course_videos as $index => $video)
                        @php
                            $currentVideoId = Route::current()->parameter('courseVideoId');
                            $isActive = $currentVideoId == $video->id;
                        @endphp
                        <div id="video-{{ $video->id }}"
                            class="group p-[12px_16px] flex items-center gap-[10px] {{ $isActive ? 'bg-[#3525B3]' : 'bg-[#E9EFF3]' }}  rounded-full hover:bg-[#3525B3] transition-all duration-300">
                            @if ($isActive)
                                <div class="text-white group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                            @else
                                <div class="text-black group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.97 2C6.44997 2 1.96997 6.48 1.96997 12C1.96997 17.52 6.44997 22 11.97 22C17.49 22 21.97 17.52 21.97 12C21.97 6.48 17.5 2 11.97 2ZM14.97 14.23L12.07 15.9C11.71 16.11 11.31 16.21 10.92 16.21C10.52 16.21 10.13 16.11 9.76997 15.9C9.04997 15.48 8.61997 14.74 8.61997 13.9V10.55C8.61997 9.72 9.04997 8.97 9.76997 8.55C10.49 8.13 11.35 8.13 12.08 8.55L14.98 10.22C15.7 10.64 16.13 11.38 16.13 12.22C16.13 13.06 15.7 13.81 14.97 14.23Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                            @endif
                            <a href="{{ route('front.learning', [$course, 'courseVideoId' => $video->id]) }}">
                                <p
                                    class="font-semibold group-hover:text-white transition-all duration-300 {{ $isActive ? 'text-white' : 'text-black' }}">
                                    {{ $video->name }}
                                    @if ($video->watched)
                                        <span class="check-icon inline-block text-green-500 ml-2"><i
                                                class="fas fa-check-circle"></i></span>
                                    @endif
                                </p>
                            </a>
                        </div>
                    @empty
                        <p>No videos available.</p>
                    @endforelse
                </div>
                <div class="mt-5 text-center">
                    <button id="nextButton" class="btn-primary">Next</button>
                </div>
                <form id="reviewForm" action="{{ route('admin.reviews.add', $course) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="rating" id="form-rating">
                    <input type="hidden" name="note" id="form-note">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="courseVideoId" value="{{ $currentVideoId }}">
                </form>
            </div>
        </div>
    </section>
    @include('layouts.frontend.course_resources_section')
    @include('layouts.frontend.faq-section')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextButton = document.getElementById('nextButton');

        nextButton.addEventListener('click', function() {
            const currentVideoId = '{{ $currentVideoId }}';
            markWatched(currentVideoId);
        });

        function markWatched(currentVideoId) {
            fetch(`/course-videos/${currentVideoId}/watched`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const currentElement = document.querySelector(`#video-${currentVideoId}`);
                        const checkIcon = currentElement.querySelector('.check-icon');
                        if (checkIcon) {
                            checkIcon.classList.remove('hidden');
                        }

                        const nextElement = currentElement.nextElementSibling;
                        if (nextElement) {
                            const nextVideoId = nextElement.id.split('-')[1];
                            const nextVideoUrl =
                                `{{ route('front.learning', [$course, 'courseVideoId' => ':videoId']) }}`
                                .replace(':videoId', nextVideoId);
                            window.location.href = nextVideoUrl;
                        } else {
                            nextButton.textContent = 'Finish';
                            nextButton.addEventListener('click', function() {
                                showRatingModal();
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to mark video as watched',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
        }

        function showRatingModal() {
            Swal.fire({
                title: 'Rate this course',
                html: `
                    <div class="flex justify-center">
                        <div id="star-rating" class="flex space-x-2">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                    </div>
                    <textarea id="rating-note" class="swal2-textarea" style="width: 80%; height: 150px;" placeholder="Add a note (optional)" rows="3"></textarea>
                `,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const stars = document.querySelectorAll('.star.selected').length;
                    const note = document.getElementById('rating-note').value;
                    document.getElementById('form-rating').value = stars;
                    document.getElementById('form-note').value = note;
                    return {
                        stars,
                        note
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reviewForm').submit();
                }
            });

            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    highlightStars(star.dataset.value);
                });
                star.addEventListener('mouseout', resetStars);
                star.addEventListener('click', () => {
                    selectStars(star.dataset.value);
                });
            });

            function highlightStars(count) {
                stars.forEach((star, index) => {
                    star.classList.toggle('highlight', index < count);
                });
            }

            function resetStars() {
                stars.forEach(star => {
                    star.classList.remove('highlight');
                });
            }

            function selectStars(count) {
                stars.forEach((star, index) => {
                    star.classList.toggle('selected', index < count);
                });
            }
        }
    });
</script>
<style>
    .top-right-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .alert {
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        display: inline-block;
        width: 300px;
        position: relative;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .closebtn {
        color: #721c24;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: #000;
    }
</style>
