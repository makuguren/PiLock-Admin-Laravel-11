<input type="checkbox" id="edit_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Edit Role</h3>
        <form wire:submit.prevent="updateRole" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Role Name</label> <span class="text-red-600">*</span>
                    <input wire:model="name" id="editrole_name" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                    @error('name') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Update
                    </button>
                    <button onclick="cancel_role()" type="button" class="text-white bg-red-700 btn hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
