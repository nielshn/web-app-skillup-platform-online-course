<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-indigo-100 px-4 py-3 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Manage Categories</h2>
            <a href="{{ route('admin.teachers.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">Add
                New</a>
        </div>
    </x-slot>

    <!-- Flash messages -->
    @if (session('success'))
        <div id="success-message" class="fixed top-5 right-5 z-50">
            <div class="max-w-sm rounded-md overflow-hidden shadow-lg bg-green-500">
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
            <div class="max-w-sm rounded-md overflow-hidden shadow-lg bg-red-500">
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
        // Function to hide success message after 5 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000);

        // Function to hide error message after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.remove();
            }
        }, 5000);

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
                @forelse ($categories as $category)
                    <div
                        class="item-card flex flex-row justify-between items-center bg-gray-50 p-5 rounded-md shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($category->icon) }}" alt=""
                                class="rounded-full object-cover w-24 h-24">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-semibold text-indigo-950">{{ $category->name }}</h3>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-sm text-slate-500">Created At</p>
                            <h3 class="text-xl font-semibold text-indigo-950">
                                {{ $category->created_at->format('d M, Y') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="px-6 py-3 bg-indigo-700 text-white rounded-full">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 py-3 bg-red-700 text-white rounded-full">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No categories available</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
