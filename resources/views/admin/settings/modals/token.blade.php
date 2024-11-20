<input type="checkbox" id="token_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="w-11/12 max-w-2xl modal-box">
        <div class="sticky top-0 bg-base-100">
            <h3 class="mb-4 text-lg font-bold">Your API Token</h3>
            <button onclick="cancel_token()" class="absolute top-0 btn btn-sm btn-circle btn-ghost right-2">✕</button>
        </div>

        {{-- Content goes here! --}}
        <div class="flex flex-col space-y-4">
            <div class="flex items-center space-x-3">
                <input type="text" id="apiToken" class="w-full input input-bordered" placeholder="Your API Token" value="{{ $token }}" readonly>
                <button onclick="copyToken()" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                    Copy
                </button>
            </div>
            <p class="text-sm text-gray-600">Note: This token is used for API requests. Do not share this token with anyone.</p>
        </div>
    </div>
</div>
