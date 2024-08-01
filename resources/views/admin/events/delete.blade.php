<input type="checkbox" id="delete_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Delete Event</h3>
        <form wire:submit.prevent="destroyEvent" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <h5>Are you Sure you want to Delete?</h5>
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Delete</button>
                    <button onclick="cancel_event()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
