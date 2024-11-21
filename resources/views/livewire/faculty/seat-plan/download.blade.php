<input type="checkbox" id="download_seats" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Download Seat Plan</h3>
        <form wire:submit.prevent="downloadSeatPlan" method="POST" class="space-y-4">
            @csrf
            <div class="px-3 mb-6 form-control">
                <label for="section" class="label">
                    <span class="label-text">Select Section:</span>
                </label>
                <select wire:model="selectedDLCourseSection" id="selectedDLCourseSection" class="flex items-center w-full bg-base-300 select select-bordered" required>
                    <option value="">All Sections</option>
                    @foreach($courseSecs as $courseSec)
                        <option value="{{ $courseSec->id }}">
                            {{ $courseSec->course_title ?? 'No Course Title' }} -
                            {{ $courseSec->section->program }}
                            {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                        </option>
                    @endforeach
                </select>
                @error('selectedDLCourseSection') <span class="error" role="alert">{{ $message }}</span> @enderror
            </div>
            <div class="modal-action">
                <button type="button" onclick="cancel_downloadseats()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                    Cancel
                </button>
                <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                    Download
                </button>
            </div>
        </form>
    </div>
</div>
