<input type="checkbox" id="download_logs_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Download Logs</h3>
        <form wire:submit.prevent="downloadLogs" method="dialog" class="w-full mt-6">

            {{-- <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <input type="number" min="1900" max="2099" step="1" value="" />
                </div>
            </div> --}}

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Course and Section</label>
                    <select wire:model="dlsection_id" id="selsection_id" class="block w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300 form-control" required>
                        <option value="" selected>--Select Course & Section--</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_title }} -
                                {{ $course->section->program }}
                                {{ $course->section->year }}{{ $course->section->block }} -
                                {{ $course->faculty->first_name }} {{ $course->faculty->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('dlsection_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">From</label>
                    <label class="flex items-center">
                        <input type="date" wire:model="dlfromdate" id="dlpdfdate" class="block w-full px-4 py-3 mt-1 mb-1 text-sm input input-bordered form-control bg-base-300" />
                    </label>
                    @error('dlfromdate') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">To</label>
                    <label class="flex items-center">
                        <input type="date" wire:model="dltodate" id="dlpdfdate" class="block w-full px-4 py-3 mt-1 mb-1 text-sm input input-bordered form-control bg-base-300" />
                    </label>
                    @error('dltodate') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download
                    </button>
                    <button onclick="cancel_logs()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
