<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-indigo-100 px-4 py-3 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Manage Courses</h2>
            <a href="{{ route('admin.teachers.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">Add
                New</a>
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
                    <div
                        class="item-card flex flex-col md:flex-row gap-y-5 justify-between items-center p-6 bg-gray-100 rounded-lg shadow-md">
                        <div class="flex flex-row items-center gap-x-5 md:gap-x-8">
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}"
                                class="rounded-lg object-cover w-32 h-24">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $course->name }}</h3>
                                <p class="text-gray-600">{{ $course->category->name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center md:gap-x-8">
                            <div class="flex flex-col items-center md:text-left">
                                <p class="text-gray-600">Students</p>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $course->students->count() }}</h3>
                            </div>
                            <div class="flex flex-col items-center md:text-left">
                                <p class="text-gray-600">Videos</p>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $course->course_videos->count() }}
                                </h3>
                            </div>
                            <div class="flex flex-col items-center md:text-left">
                                <p class="text-gray-600">Teacher</p>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $course->teacher->user->name }}</h3>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center md:gap-x-8">
                            <a href="{{ route('admin.courses.show', $course) }}"
                                class="px-6 py-3 bg-indigo-700 text-white rounded-full">Manage</a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 py-3 bg-red-700 text-white rounded-full">Delete</button>
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
</x-app-layout>
