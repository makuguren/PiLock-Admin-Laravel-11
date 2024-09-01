<!-- Put this part before </body> tag -->
<input type="checkbox" id="changePass_modal" class="modal-toggle" {{ $checked ?? '' }}/>
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Changing your Password</h3>
    <h3 class="text-sm">Please Change Password first before you Proceed.</h3>
    <form wire:submit.prevent="updateInstPassword" method="dialog" class="w-full mt-6">
        @csrf
        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
                <label class="label-text">Current Password</label>
                <input wire:model="current_password" id="curr_passwd" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="password" placeholder="">
                @error('current_password') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
                <label class="label-text">New Password</label>
                <input wire:model="password" id="new_passwd" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="password" placeholder="">
                @error('password') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-6">
            <div class="w-full px-3">
                <label class="label-text">Confirm Password</label>
                <input wire:model="password_confirmation" id="passwd_confirmation" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="password" placeholder="">
                @error('password_confirmation') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="modal-action">
            <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                    Update
                </button>
            </div>
        </div>
    </form>
    <div class="modal-action">
      {{-- <label for="my_modal_6" class="btn btn-ghost">Close!</label> --}}
    </div>
  </div>
</div>
