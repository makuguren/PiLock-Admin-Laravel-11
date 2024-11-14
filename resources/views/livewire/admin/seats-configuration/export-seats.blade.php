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
                <button type="button" onclick="cancel_export()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">Cancel</button>
                <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">Save</button>
            </div>
        </form>
    </div>
</div>
