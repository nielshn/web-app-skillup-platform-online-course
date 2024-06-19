<!-- resources/views/front/all_courses.blade.php -->

@extends('layouts.frontend.main')
@section('title')
    All Courses
@endsection

@section('content')
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('layouts.frontend.navbar')
    </div>
    <section id="All-Courses" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px] gap-[30px]">
        <div class="search-form flex items-center">
            <form action="{{ route('front.all_courses') }}" method="GET" class="flex items-center">
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
                <p class="font-medium text-sm text-[#FF6129]">All Courses</p>
            </div>
            <div id="courses-container" class="grid grid-cols-3 gap-[30px] w-full">
                @forelse ($courses as $course)
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
                                            @php
                                                $averageRating = $course->averageRating();
                                                $roundedRating = floor($averageRating);
                                                $displayRating = 0;
                                                if ($averageRating == 5) {
                                                    $displayRating = 5;
                                                } elseif ($averageRating >= 4 && $averageRating < 5) {
                                                    $displayRating = 4;
                                                } elseif ($averageRating >= 3 && $averageRating < 4) {
                                                    $displayRating = 3;
                                                } elseif ($averageRating >= 2 && $averageRating < 3) {
                                                    $displayRating = 2;
                                                } elseif ($averageRating >= 1 && $averageRating < 2) {
                                                    $displayRating = 1;
                                                }
                                            @endphp
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $displayRating)
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
                    <p>No courses available</p>
                @endforelse
            </div>

            @if ($courses->count() > 4)
                <div class="flex justify-center mt-6 w-full">
                    <button id="loadMoreCourses"
                        class="text-white font-semibold rounded-[30px] p-[16px_32px] btn btn-primary transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Load
                        More</button>
                </div>
            @endif
        </div>
    </section>
@endsection


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
