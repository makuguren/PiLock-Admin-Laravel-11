<input type="checkbox" id="view_seat_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">View Seat</h3>

        <div class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Seat ID</label>
                    <input wire:model="seat_id" id="viewseat_id" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Name</label>
                    <input wire:model="student_name" id="viewstudent_name" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Seat Number</label>
                    <input wire:model="seat_number" id="viewseat_number" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button wire:click="destroySeat({{ $seat_id }})" type="button" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Delete</button>
                    <button onclick="cancel_viewseat()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
