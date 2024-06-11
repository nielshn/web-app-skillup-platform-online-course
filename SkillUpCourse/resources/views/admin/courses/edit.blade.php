<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-8 sm:rounded-lg shadow-md">
                <div class="flex justify-end mb-0">
                    <a href="{{ route('admin.courses.show', $course) }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
                <div class="p-6 sm:p-10">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Terjadi kesalahan!</strong>
                            @foreach ($errors->all() as $error)
                                <span class="block">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.courses.update', $course) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mt-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $course->name }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="Course Thumbnail"
                                class="rounded-lg object-cover w-48 h-36 mt-2">
                            <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail"
                                autofocus autocomplete="thumbnail" />
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="path_trailer" :value="__('Path Trailer')" />
                            <x-text-input id="path_trailer" class="block mt-1 w-full" type="text" name="path_trailer"
                                value="{{ $course->path_trailer }}" required autofocus autocomplete="path_trailer" />
                            <x-input-error :messages="$errors->get('path_trailer')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="category" :value="__('Category')" />
                            <select name="category_id" id="category_id"
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 mt-1 focus:outline-none focus:border-indigo-500">
                                <option value="">Choose category</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="about" :value="__('About')" />
                            <textarea name="about" id="about" rows="5" style="display: none;">{{ $course->about }}</textarea>
                            <div id="editor">{{ $course->about }}</div>
                            <x-input-error :messages="$errors->get('about')" class="mt-2" />
                        </div>

                        <hr class="my-8">

                        <div class="mt-6">
                            <div class="flex flex-col gap-y-4">
                                <x-input-label for="keypoints" :value="__('Key Points')" />
                                @forelse ($course->course_keypoints as $keypoint)
                                    <input type="text"
                                        class="block w-full border border-gray-300 rounded-lg px-4 py-3 mt-1 focus:outline-none focus:border-indigo-500"
                                        value="{{ $keypoint->name }}" name="course_keypoints[]">
                                @empty
                                    <p>Keypoint Data is empty</p>
                                @endforelse
                            </div>
                            <x-input-error :messages="$errors->get('keypoints')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <button type="submit" class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full">
                                Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor.create(document.querySelector('#editor'))
                .then(editor => {
                    editor.setData('{!! $course->about !!}');
                    editor.model.document.on('change:data', () => {
                        document.querySelector('#about').value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

</x-app-layout>
