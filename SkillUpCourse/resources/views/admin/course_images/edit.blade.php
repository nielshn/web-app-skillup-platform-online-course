<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-8 sm:rounded-lg shadow-md">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.courses.show', $courseImage->course_id) }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($courseImage->course->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $courseImage->course->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $courseImage->course->category->name }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Teacher</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $courseImage->course->teacher->user->name }}
                        </h3>
                    </div>
                </div>

                <hr class="my-5">

                <form method="POST" action="{{ route('admin.course_images.update', $courseImage) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <img src="{{ Storage::url($courseImage->image) }}" alt="Course Thumbnail"
                            class="rounded-lg object-cover w-48 h-36 mt-2">
                        <x-input-label for="image" :value="__('Course Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" required
                            autofocus autocomplete="image" multiple />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Video
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
