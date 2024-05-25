<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($courses as $course)
                    <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $course->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $course->category->name }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Students</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->students->count() }}</h3>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Videos</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->course_videos->count() }}</h3>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Teacher</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->teacher->user->name }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.courses.show', $course) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Manage
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>There is no class added yet</p>
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
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
