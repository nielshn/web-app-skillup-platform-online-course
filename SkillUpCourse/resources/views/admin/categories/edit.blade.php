<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-8 sm:rounded-lg shadow-md">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.categories.index') }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Terjadi kesalahan!</strong>
                        @foreach ($errors->all() as $error)
                            <span class="block">{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.categories.update', $category) }}"
                    enctype="multipart/form-data" class="mt-8">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ $category->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="icon" :value="__('Icon')" />
                        <img src="{{ Storage::url($category->icon) }}" alt="Category Icon"
                            class="rounded-lg object-cover w-24 h-24 mt-2">
                        <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon"
                            autofocus autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 focus:outline-none focus:bg-indigo-800">
                            Update Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
