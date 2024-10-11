<input type="checkbox" id="import_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Import Schedule</h3>
      <h3 class="text-sm">You can import .xlsx, .csv</h3>

          <!-- Display validation errors from the import -->
        @if ($errors->has('import_error'))
            <div class="mt-3">
                @foreach ($errors->get('import_error') as $error)
                    <div class="text-red-500 text-md">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form wire:submit.prevent="importSchedule" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <input type="file" wire:model="import_file" id="import_file" class="file-input file-input-bordered w-full" onchange="disableButton()" />
                    <span id="timer" class="mt-1 text-red-500 text-md"></span>
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white" id="upload-button" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        Import
                    </button>
                    <button onclick="cancel_sched()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
