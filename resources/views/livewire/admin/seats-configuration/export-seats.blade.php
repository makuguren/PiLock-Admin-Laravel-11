<input type="checkbox" id="export_config" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Save Configuration</h3>
        <form wire:submit.prevent="exportConfiguration" method="POST" class="space-y-4">
            @csrf
            <div class="px-3 form-control">
                <label for="name" class="label">
                    <span class="label-text">Name:</span>
                </label>
                <input type="text" wire:model="name" id="name" class="input input-bordered bg-base-300" placeholder="" required>
                @error('name') <span class="error" role="alert">{{ $message }}</span> @enderror
            </div>
            <div class="modal-action">
                <button type="button" onclick="cancel_export()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                    Cancel
                </button>
                <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
