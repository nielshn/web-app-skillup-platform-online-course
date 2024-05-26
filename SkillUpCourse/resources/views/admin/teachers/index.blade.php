<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-indigo-100 px-4 py-3 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Manage Teachers</h2>
            <a href="{{ route('admin.teachers.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">Add
                New</a>
        </div>
    </x-slot>

    <!-- Flash messages -->
    @if (session('success'))
        <div id="success-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-sm rounded-md overflow-hidden shadow-lg bg-green-500">
                <div class="px-4 py-3 flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">Success</span>
                    <button onclick="closeMessage('success-message')" class="text-white">&times;</button>
                </div>
                <p class="text-white px-4 pb-3">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-sm rounded-md overflow-hidden shadow-lg bg-red-500">
                <div class="px-4 py-3 flex justify-between items-center">
                    <span class="text-lg font-semibold text-white">Error</span>
                    <button onclick="closeMessage('error-message')" class="text-white">&times;</button>
                </div>
                <p class="text-white px-4 pb-3">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($teachers as $teacher)
                    <div
                        class="item-card flex flex-row justify-between items-center bg-gray-50 p-5 rounded-md shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{ Storage::url($teacher->user->avatar) }}" alt="Teacher Avatar"
                                class="rounded-full object-cover w-24 h-24 border-2 border-indigo-500">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-900 text-xl font-semibold">{{ $teacher->user->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $teacher->user->occupation }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col items-end">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-900 text-xl font-semibold">
                                {{ $teacher->user->created_at->format('d M, Y') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                class="delete-teacher-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-teacher-button font-bold py-2 px-4 bg-red-600 hover:bg-red-500 text-white rounded-full transition-all duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 text-lg">No teachers available</p>
                @endforelse
            </div>
        </div>
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
            const deleteTeacherButtons = document.querySelectorAll('.delete-teacher-button');

            deleteTeacherButtons.forEach(button => {
                button.addEventListener('click', function(event) {
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
