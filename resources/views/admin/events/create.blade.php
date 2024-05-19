<input type="checkbox" id="add_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Create Event</h3>
        <form wire:submit.prevent="saveEvent" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Title</label>
                    <input wire:model="title" id="addevent_title" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('title') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Description</label>
                    <input wire:model="description" id="addevent_description" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('description') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Date</label>
                    <input wire:model="date" value="" id="addevent_date" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                    @error('date') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Event Start</label>
                    <input wire:model="event_start" id="addevent_start" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 flex-row form-control" type="time">
                    @error('event_start') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Event End</label>
                    <input wire:model="event_end" id="addevent_end" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 flex-row form-control" type="time">
                    @error('event_end') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">Save</button>
                    <button onclick="cancel_event()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
