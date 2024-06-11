<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-8 sm:rounded-lg shadow-md">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.faqs.index') }}"
                        class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="question"
                            class="block text-sm font-medium text-gray-700">{{ __('Question') }}</label>
                        <input id="question" class="form-input mt-1 block w-full rounded-md shadow-sm" type="text"
                            name="question" value="{{ $faq->question }}" required autofocus />
                    </div>

                    <div class="mb-6">
                        <label for="answer"
                            class="block text-sm font-medium text-gray-700">{{ __('Answer') }}</label>
                        <textarea name="answer" id="answer" cols="30" rows="5" style="display: none;">{{ $faq->answer }}</textarea>
                        <div id="editor">{!! $faq->answer !!}</div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">{{ __('Add New FAQ') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        document.querySelector('#answer').value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</x-app-layout>
