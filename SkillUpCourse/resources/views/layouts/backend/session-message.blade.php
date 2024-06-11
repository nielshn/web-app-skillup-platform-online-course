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
