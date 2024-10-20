<input type="checkbox" id="view_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">View Event</h3>
        <form wire:submit.prevent="updateEvent" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Title</label> <span class="text-red-600">*</span>
                    <input wire:model="title" id="editevent_title" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="text" disabled>
                    @error('title') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Description</label> <span class="text-red-600">*</span>
                    <input wire:model="description" id="editevent_description" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="text" disabled>
                    @error('description') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Date</label> <span class="text-red-600">*</span>
                    <input wire:model="date" id="editevent_date" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="text" disabled>
                    @error('date') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Event Start</label> <span class="text-red-600">*</span>
                    <input wire:model="event_start" id="editevent_start" class="flex-row block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="time" disabled>
                    @error('event_start') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Event End</label> <span class="text-red-600">*</span>
                    <input wire:model="event_end" id="editevent_end" class="flex-row block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="time" disabled>
                    @error('event_end') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button onclick="cancel_event()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
