<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}"
                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <!-- Flash messages -->
    @if (session('success'))
        <div id="success-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-md rounded-md overflow-hidden shadow-lg bg-green-500">
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-white">Success</span>
                        <button onclick="closeMessage('success-message')" class="text-white">&times;</button>
                    </div>
                    <p class="text-white">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-md rounded-md overflow-hidden shadow-lg bg-red-500">
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-white">Error</span>
                        <button onclick="closeMessage('error-message')" class="text-white">&times;</button>
                    </div>
                    <p class="text-white">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <script>
        function closeMessage(id) {
            var message = document.getElementById(id);
            if (message) {
                message.remove();
            }
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($courses as $course)
                    <<<<<<< HEAD <div
                        class="item-card flex flex-col md:flex-row gap-y-5 justify-between items-center p-6 bg-gray-100 rounded-lg shadow-md">
                        <div class="flex flex-row items-center gap-x-5 md:gap-x-8">
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}"
                                class="rounded-lg object-cover w-32 h-24">
                            =======
                            <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                                <div class="flex flex-row items-center gap-x-3">
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt=""
                                        class="rounded-2xl object-cover w-[120px] h-[90px]">
                                    >>>>>>> c9feccc9a715061e80182db3ebc0549643aeeee2
                                    <div class="flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $course->name }}</h3>
                                        <p class="text-gray-600">{{ $course->category->name }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row items-center md:gap-x-8">
                                    <div class="flex flex-col items-center md:text-left">
                                        <p class="text-gray-600">Students</p>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $course->students->count() }}
                                        </h3>
                                    </div>
                                    <div class="flex flex-col items-center md:text-left">
                                        <p class="text-gray-600">Videos</p>
                                        <h3 class="text-xl font-semibold text-gray-800">
                                            {{ $course->course_videos->count() }}
                                        </h3>
                                    </div>
                                    <div class="flex flex-col items-center md:text-left">
                                        <p class="text-gray-600">Teacher</p>
                                        <h3 class="text-xl font-semibold text-gray-800">
                                            {{ $course->teacher->user->name }}</h3>
                                    </div>
                                </div>
                                <<<<<<< HEAD <div class="flex flex-col md:flex-row items-center md:gap-x-8">
                                    <a href="{{ route('admin.courses.show', $course) }}"
                                        class="px-6 py-3 bg-indigo-700 text-white rounded-full">Manage</a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-6 py-3 bg-red-700 text-white rounded-full">Delete</button>
                                        =======
                                        <div class="hidden md:flex flex-col">
                                            <p class="text-slate-500 text-sm">Videos</p>
                                            <h3 class="text-indigo-950 text-xl font-bold">
                                                {{ $course->course_videos->count() }}</h3>
                                        </div>
                                        <div class="hidden md:flex flex-col">
                                            <p class="text-slate-500 text-sm">Teacher</p>
                                            <h3 class="text-indigo-950 text-xl font-bold">
                                                {{ $course->teacher->user->name }}</h3>
                                        </div>
                                        <div class="hidden md:flex flex-row items-center gap-x-3">
                                            <a href="{{ route('admin.courses.show', $course) }}"
                                                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                                Manage
                                            </a>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-button font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                                    Delete
                                                </button>
                                                >>>>>>> c9feccc9a715061e80182db3ebc0549643aeeee2
                                            </form>
                                        </div>
                            </div>
                        @empty
                            <p class="text-gray-500">There are no courses available.</p>
                @endforelse
            </div>

            <!-- Center and style the pagination links -->
            <div class="mt-4 flex justify-center">
                {{ $courses->links('vendors.pagination.custom') }}
            </div>
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-form');
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
