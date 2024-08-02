<input type="checkbox" id="add_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Section</h3>
        <form wire:submit.prevent="saveSection" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Section</label>
                    <input wire:model="section_name" id="addsection_name" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('section_name') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Save</button>
                    <button onclick="cancel_section()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
