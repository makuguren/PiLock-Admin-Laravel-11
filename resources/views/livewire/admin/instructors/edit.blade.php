<input type="checkbox" id="edit_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Edit Instructor</h3>
        <form wire:submit.prevent="updateInstructor" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full md:w-1/2 px-3 mb-2">
                    <label class="label-text">First Name</label> <span class="text-red-600">*</span>
                    <input wire:model="first_name" id="editinst_first" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-1 mt-1 form-control" type="text">
                    @error('first_name') <span class="error mt-1 text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <label class="label-text">Last Name</label> <span class="text-red-600">*</span>
                    <input wire:model="last_name" id="editinst_last" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-1 mt-1 form-control" type="text">
                    @error('last_name') <span class="error mt-1 text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Gender</label> <span class="text-red-600">*</span>
                    <select wire:model="gender" id="editgender" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-1 mt-1 form-control" required>
                        <option value="">--Select Gender--</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                    @error('gender') <span class="error mt-1 text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-1 mt-1">
                <div class="w-full px-3">
                    <label class="label-text">Email</label> <span class="text-red-600">*</span>
                    <input wire:model="email" id="editinst_email" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-1 mt-1 form-control" type="email">
                    @error('email') <span class="error mt-1 text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Password</label> <span class="text-red-600">*</span>
                    <input wire:model="password" id="editinst_password" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-1 mt-1 form-control" type="password">
                    @error('password') <span class="error mt-1 text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Update
                    </button>
                    <button onclick="cancel_inst()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
