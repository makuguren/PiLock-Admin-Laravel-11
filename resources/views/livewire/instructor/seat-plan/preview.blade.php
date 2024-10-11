<input type="checkbox" id="preview_seat_modal" class="modal-toggle" />
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
                    <button onclick="cancel_previewseat()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
