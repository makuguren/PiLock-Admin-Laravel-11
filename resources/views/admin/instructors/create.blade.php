<input type="checkbox" id="add_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Instructor</h3>
        <form wire:submit.prevent="saveInstructor" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Name</label>
                    <input wire:model="name" id="addinst_name" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('name') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-3">
                <div class="w-full px-3">
                    <label class="label-text">Email</label>
                    <input wire:model="email" id="addinst_email" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="email">
                    @error('email') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Password</label>
                    <input wire:model="password" id="addinst_password" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="password">
                    @error('password') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">Save</button>
                    <button onclick="cancel_inst()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
