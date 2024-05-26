<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center bg-white px-4 py-3 rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">Course Details</h2>
        </div>
    </x-slot>

    <!-- Flash messages -->
    @if (session('success'))
        <div id="success-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-md rounded-md overflow-hidden shadow-lg bg-green-500">
                <div class="px-4 py-3 flex justify-between items-center">
                    <span class="text-lg font-bold text-white">Success</span>
                    <button onclick="closeMessage('success-message')" class="text-white">&times;</button>
                </div>
                <p class="text-white px-4 pb-3">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-md rounded-md overflow-hidden shadow-lg bg-red-500">
                <div class="px-4 py-3 flex justify-between items-center">
                    <span class="text-lg font-bold text-white">Error</span>
                    <button onclick="closeMessage('error-message')" class="text-white">&times;</button>
                </div>
                <p class="text-white px-4 pb-3">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.courses.index') }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full">
                        Back
                    </a>
                </div>
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($course->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[200px] h-[150px]">

                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $course->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $course->name }}</h3>
                        <p class="text-gray-600">{{ $course->category->name }}</p>
                    </div>
                    <<<<<<< HEAD <div class="flex flex-col items-center">
                        <p class="text-gray-600">Students</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $course->students->count() }}</h3>
                </div>
                <div class="ml-auto flex space-x-3">
                    <a href="{{ route('admin.courses.edit', $course) }}"
                        class="px-4 py-2 bg-yellow-400 text-white rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                        </svg>
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this course?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-700 text-white rounded-md flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                                    fill="white" />
                                <path
                                    d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <hr class="my-6 border-t-2 border-gray-300">

            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <h3 class="text-2xl font-bold text-gray-800">Course Videos</h3>
                    <p class="text-gray-600">{{ $course->course_videos->count() }}</p>
                </div>

                <a href="{{ route('admin.course.add_video', $course->id) }}"
                    class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                    Add New Video
                </a>

            </div>

            @forelse ($course->course_videos as $video)
                <div class="flex flex-col md:flex-row gap-6 items-center bg-gray-100 p-6 rounded-lg shadow-md">
                    <iframe width="160" class="rounded-lg object-cover w-32 h-20" height="90"
                        src="https://www.youtube-nocookie.com/embed/{{ $video->path_video }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800">{{ $video->name }}</h3>
                        <p class="text-gray-600">{{ $video->course->name }}</p>
                    </div>
                    <<<<<<< HEAD <div class="ml-auto flex space-x-3">
                        <a href="{{ route('admin.course_videos.edit', $video) }}"
                            class="px-4 py-2 bg-indigo-700 text-white rounded-md flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                            </svg>
                        </a>

                        <form action="{{ route('admin.course_videos.destroy', $video) }}" method="POST"
                            class="delete-video-form">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="delete-video-button font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                                        fill="white" />
                                    <path
                                        d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                                        fill="white" />
                                </svg>
                            </button>
                        </form>
                </div>
        </div>
    @empty
        <p class="text-gray-500">No videos available for this course.</p>
        @endforelse
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.classList.add('hidden');
            }
        }, 5000);

        // Function to hide error message after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.classList.add('hidden');
            }
        }, 5000);

        function closeMessage(id) {
            var message = document.getElementById(id);
            if (message) {
                message.remove();
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const deleteCourseButtons = document.querySelectorAll('.delete-course-button');
            const deleteVideoButtons = document.querySelectorAll('.delete-video-button');

            deleteCourseButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-course-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            deleteVideoButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-video-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
