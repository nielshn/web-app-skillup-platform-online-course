<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center bg-indigo-100 p-4 rounded-md shadow-sm">
            <h2 class="font-semibold text-2xl text-indigo-900 leading-tight">
                {{ __('Manage Teachers') }}
            </h2>
            <a href="{{ route('admin.teachers.create') }}"
                class="font-bold py-2 px-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-full transition-all duration-300">
                Add New
            </a>
        </div>
    </x-slot>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($teachers as $teacher)
                    <div
                        class="item-card flex flex-row justify-between items-center bg-gray-50 p-5 rounded-md shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{ Storage::url($teacher->user->avatar) }}" alt="Teacher Avatar"
                                class="rounded-2xl object-cover w-[90px] h-[90px] border-2 border-indigo-500">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-900 text-xl font-bold">{{ $teacher->user->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $teacher->user->occupation }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col items-end">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-900 text-xl font-bold">
                                {{ $teacher->user->created_at->format('d M, Y') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="delete-teacher-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-teacher-button font-bold py-2 px-4 bg-red-600 hover:bg-red-500 text-white rounded-full transition-all duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 text-lg">Belum ada guru tersedia</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteTeacherButtons = document.querySelectorAll('.delete-teacher-button');

            deleteTeacherButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest('.delete-teacher-form');
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
