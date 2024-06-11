<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white px-4 py-3 rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">Course Details</h2>
        </div>
    </x-slot>

    <!-- Flash messages -->
    @include('layouts.backend.session-message')

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 space-y-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.courses.index') }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}"
                        class="rounded-lg object-cover w-48 h-36">
                    <div class="flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $course->name }}</h3>
                        <p class="text-gray-600">{{ $course->category->name }}</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="text-gray-600">Students</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $course->students->count() }}</h3>
                    </div>
                    <div class="ml-auto flex space-x-3">
                        <a href="{{ route('admin.courses.edit', $course) }}"
                            class="flex items-center justify-center px-4 py-2 bg-yellow-400 text-white rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                            </svg>
                            <span class="ml-2">Edit</span>
                        </a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-btn"
                                class="flex items-center justify-center px-4 py-2 bg-red-700 text-white rounded-md">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                                        fill="white" />
                                    <path
                                        d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                                        fill="white" />
                                </svg>
                                <span class="ml-2">Delete</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col">
                            <h3 class="text-2xl font-bold text-gray-800">Course Videos</h3>
                            <p class="text-gray-600">{{ $course->course_videos->count() }}</p>
                        </div>
                        {{-- @role('teacher') --}}
                        <a href="{{ route('admin.course.add_video', $course->id) }}"
                            class="px-4 py-2 bg-indigo-700 text-white rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="ml-2">Add New Video</span>
                        </a>
                        {{-- @endrole --}}
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
                            <div class="ml-auto flex space-x-3">
                                <a href="{{ route('admin.course_videos.edit', $video) }}"
                                    class="px-4 py-2 bg-yellow-400 text-white rounded-md flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                                    </svg>
                                    <span class="ml-2">Edit</span>
                                </a>
                                <form action="{{ route('admin.course_videos.destroy', $video) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete-btn"
                                        class="flex items-center justify-center px-4 py-2 bg-red-700 text-white rounded-md">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                                                fill="white" />
                                            <path
                                                d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                                                fill="white" />
                                        </svg>
                                        <span class="ml-2">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    @empty
                        <p class="text-gray-500">No videos available for this course.</p>
                    @endforelse

                    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-12">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-800">Course Images</h2>
                                <a href="{{ route('admin.course.add_image', $course->id) }}"
                                    class="px-4 py-2 bg-indigo-700 text-white rounded-md flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="ml-1">Add New Image</span>
                                </a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Sneak Peek</th>
                                            <th class="px-4 py-2 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($course->course_images as $image)
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    <img src="{{ Storage::url($image->image) }}" alt="Course Image"
                                                        class="rounded-lg object-cover w-60 h-42 mt-2">
                                                </td>
                                                <td class="border px-4 py-2">
                                                    <div class="flex space-x-2 items-center">
                                                        <a href="{{ route('admin.course_images.edit', $image) }}"
                                                            class="px-3 py-2 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                                                            </svg>
                                                            <span class="ml-2">Edit</span>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.course_images.destroy', $image) }}"
                                                            method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="delete-btn"
                                                                class="flex items-center justify-center px-4 py-2 bg-red-700 text-white rounded-md">
                                                                <svg width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                                                                        fill="white" />
                                                                    <path
                                                                        d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                                                                        fill="white" />
                                                                </svg>
                                                                <span class="ml-2">Delete</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="border px-4 py-2 text-center">No images
                                                    available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
