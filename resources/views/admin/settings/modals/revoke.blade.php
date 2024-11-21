<input type="checkbox" id="revoketoken_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Revoke Token</h3>
        <form wire:submit.prevent="revokeToken" method="POST" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label for="password" class="label-text">Password</label> <span class="text-red-600">*</span>
                    <input type="password" wire:model="password" id="password" name="password" class="block w-full px-3 py-2 mt-2 mb-2 input input-bordered bg-base-300" required>
                    {{-- <span class="mt-1 text-sm text-red-500" id="password-error">Error: Incorrect password. Please try again.</span> --}}
                    <p class="mt-1 text-sm text-gray-600">Please enter your password to confirm the revocation of your API token. This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        Revoke
                    </button>
                    <button onclick="cancel_revoke()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
