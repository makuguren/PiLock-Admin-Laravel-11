<input type="checkbox" id="execute_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="modal-box w-11/12 max-w-1xl">
        <div class="sticky top-0 bg-base-100">
            <h3 class="text-lg font-bold mb-4">Executing..</h3>
        </div>

        {{-- Content goes here! --}}
        <div class="flex flex-col space-y-4 items-left">
            <div class="flex items-center gap-2">
                <div class="flex items-center">
                    <span class="loading loading-ring loading-lg"></span>
                </div>
                <div class="text-lg font-semibold">Executing Archive... Please do not close the browser.</div>
            </div>            
        </div>
    </div>
</div>
