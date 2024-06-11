@extends('layouts.frontend.main')
@section('title')
    My Course Page
@endsection

@section('content')
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('layouts.frontend.navbar')
    </div>
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px] gap-[30px]">
        <div class="search-form flex items-center">
            <form action="{{ route('front.my_courses') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search courses" class="search-input"
                    value="{{ request('search') }}">
                <select name="category" id="category" class="search-dropdown">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="flex flex-col gap-[30px]">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">My Courses</p>
            </div>
            <div id="courses-container" class="grid grid-cols-3 gap-[30px] w-full">
                @forelse ($initialCourses as $course)
                    <div class="course-card">
                        <div
                            class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white w-full pb-[10px] overflow-hidden ring-1 ring-[#DADEE4] transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                            <a href="{{ route('front.details', $course->slug) }}"
                                class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </a>
                            <div class="flex flex-col px-4 gap-[32px]">
                                <div class="flex flex-col gap-[10px]">
                                    <a href="{{ route('front.details', $course->slug) }}"
                                        class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">{{ $course->name }}</a>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-[2px]">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($course->averageRating()))
                                                    <div>
                                                        <img src="{{ asset('assets/icon/star.svg') }}" alt="Filled Star">
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="text-right text-[#6D7786]">{{ $course->students->count() }} students</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 flex-shrink-0 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($course->teacher->user->avatar) }}"
                                            class="w-full h-full object-cover" alt="icon">
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="font-semibold">{{ $course->teacher->user->name }}</p>
                                        <p class="text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
                                    </div>
                                    @if ($course->students->contains(Auth::id()))
                                        <div style="background-color: #34D399; border-radius: 9999px;"
                                            class="w-40 h-8 flex items-center justify-center ml-auto">
                                            <span class="check-icon inline-block text-white ml-2"><i
                                                    class="fas fa-check-circle"></i></span>
                                            <span class="text-black text-sm font-semibold ml-1"
                                                style="padding: 0 8px;">Joined</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Anda belum mengakses kelas apapun</p>
                @endforelse
            </div>


            @if ($allCourses->count() > 3)
                <div class="flex justify-center mt-6 w-full">
                    <button id="loadMoreCourses"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] btn btn-primary transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Load
                        More</button>
                </div>
            @endif
        </div>
    </section>

    @include('layouts.frontend.zero-success-section')
    @include('layouts.frontend.faq-section')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let coursesDisplayed = 4;

        document.getElementById('loadMoreCourses').addEventListener('click', function() {
            let search = document.querySelector('input[name="search"]').value || '';
            let category = document.querySelector('select[name="category"]').value || '';
            let url = '{{ route('load_more_courses') }}' + '?skip=' + coursesDisplayed + '&search=' +
                encodeURIComponent(search) + '&category=' + category;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.length > 0) {
                        let container = document.getElementById('courses-container');
                        data.forEach(course => {
                            let courseCard = document.createElement('div');
                            courseCard.className = 'course-card';
                            courseCard.innerHTML = `
                            <div class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white w-full pb-[10px] overflow-hidden ring-1 ring-[#DADEE4] transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                                <a href="/course/${course.id}" class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                    <img src="/storage/${course.thumbnail}" class="w-full h-full object-cover" alt="thumbnail">
                                </a>
                                <div class="flex flex-col px-4 gap-[32px]">
                                    <div class="flex flex-col gap-[10px]">
                                        <a href="/course/${course.id}" class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">${course.name}</a>
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-[2px]">
                                                ${generateRating(course.averageRating)}
                                            </div>
                                            <p class="text-right text-[#6D7786]">${course.students.length} students</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 flex-shrink-0 rounded-full overflow-hidden">
                                            <img src="/storage/${course.teacher.user.avatar}" class="w-full h-full object-cover" alt="icon">
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="font-semibold">${course.teacher.user.name}</p>
                                            <p class="text-[#6D7786]">${course.teacher.user.occupation}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            container.appendChild(courseCard);
                        });
                        coursesDisplayed += data.length;

                        // Sembunyikan tombol jika semua kursus sudah ditampilkan
                        if (coursesDisplayed >= {{ $allCourses->count() }}) {
                            document.getElementById('loadMoreCourses').style.display = 'none';
                        }
                    } else {
                        document.getElementById('loadMoreCourses').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function generateRating(rating) {
            let stars = '';
            for (let i = 0; i < 5; i++) {
                stars += i < rating ?
                    `<div><img src="{{ asset('assets/icon/star.svg') }}" alt="Filled Star"></div>` : '';
            }
            return stars;
        }
    });
</script>

<style>
    .search-form {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 8px;
    }

    .search-input {
        border: 1px solid #ccc;
        border-radius: 0.375rem 0 0 0.375rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        border-color: #3b82f6;
    }

    .search-button {
        background-color: #3b82f6;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0 0.375rem 0.375rem 0;
        cursor: pointer;
        outline: none;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #2563eb;
    }

    .search-button .fa-search {
        margin: 0;
    }

    .search-dropdown {
        border: 1px solid #ccc;
        border-radius: 0 0.375rem 0.375rem 0;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-dropdown:focus {
        border-color: #3b82f6;
    }
</style>
