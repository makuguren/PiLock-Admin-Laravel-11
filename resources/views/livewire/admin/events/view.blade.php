<input type="checkbox" id="view_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">View Event</h3>
        <form wire:submit.prevent="updateEvent" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Title</label> <span class="text-red-600">*</span>
                    <input wire:model="title" id="editevent_title" class="input input-bordered bg-base-300 block w-full py-3 px-4 mt-1 mb-1 form-control" type="text" disabled>
                    @error('title') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Description</label> <span class="text-red-600">*</span>
                    <input wire:model="description" id="editevent_description" class="input input-bordered bg-base-300 block w-full py-3 px-4 mt-1 mb-1 form-control" type="text" disabled>
                    @error('description') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Date</label> <span class="text-red-600">*</span>
                    <input wire:model="date" id="editevent_date" class="input input-bordered bg-base-300 block w-full py-3 px-4 mt-1 mb-1 form-control" type="text" disabled>
                    @error('date') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Event Start</label> <span class="text-red-600">*</span>
                    <input wire:model="event_start" id="editevent_start" class="input input-bordered bg-base-300 block w-full py-3 px-4 mt-1 mb-1 flex-row form-control" type="time" disabled>
                    @error('event_start') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Event End</label> <span class="text-red-600">*</span>
                    <input wire:model="event_end" id="editevent_end" class="input input-bordered bg-base-300 block w-full py-3 px-4 mt-1 mb-1 flex-row form-control" type="time" disabled>
                    @error('event_end') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button disabled type="submit" id="updateBtn" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Update
                    </button>
                    @can('Update Events')
                        <button onclick="enable_event()" id="editBtn" type="button" class="btn btn-ghost bg-green-700 hover:bg-green-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                            Edit
                        </button>
                    @endcan
                    @can('Delete Events')
                        <button onclick="delete_event()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            Delete
                        </button>
                    @endcan
                    <button onclick="cancel_event()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
