<input type="checkbox" id="view_seat_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">View Seat</h3>

        <div class="w-full mt-6">
            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Seat ID</label>
                    <input wire:model="seat_id" id="viewseat_id" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text" readonly>
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Name</label>
                    <input wire:model="student_name" id="viewstudent_name" class="block w-full px-4 py-3 mt-2 mb-3 input input-bordered bg-base-300 form-control" type="text" readonly>
                </div>
            </div>

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Seat Number</label>
                    <input wire:model="seat_number" id="viewseat_number" class="block w-full px-4 py-3 mt-2 mb-3 input input-bordered bg-base-300 form-control" type="text" readonly>
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button wire:click="destroySeat({{ $seat_id }})" type="button" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        Delete
                    </button>
                    <button onclick="cancel_viewseat()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
