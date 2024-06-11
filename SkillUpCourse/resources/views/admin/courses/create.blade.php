<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-8 sm:rounded-lg shadow-md">
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
                <div class="max-w-md mx-auto">
                    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Course Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-6">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input id="thumbnail" name="thumbnail" type="file" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Path Trailer -->
                        <div class="mb-6">
                            <label for="path_trailer" class="block text-sm font-medium text-gray-700">Path
                                Trailer</label>
                            <input id="path_trailer" name="path_trailer" type="text" autocomplete="path_trailer"
                                required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category_id" name="category_id" autocomplete="category_id" required
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- About -->
                        <div class="mb-6">
                            <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                            <textarea id="about" name="about" rows="3" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                        <hr class="my-6">

                        <!-- Keypoints -->
                        <div class="mt-4">

                            <div class="flex flex-col gap-y-5">
                                <x-input-label for="keypoints" :value="__('Keypoints')" />
                                @for ($i = 0; $i < 4; $i++)
                                    <input type="text" class="py-3 rounded-lg border-slate-300 border"
                                        placeholder="Write your copywriting" name="course_keypoints[]">
                                @endfor
                            </div>
                            <x-input-error :messages="$errors->get('keypoints')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New Course') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor.create(document.querySelector('#about'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    document.querySelector('#about').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
