<input type="checkbox" id="download_seats" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Download Seat Plan</h3>
        <form wire:submit.prevent="downloadSeatPlan" method="POST" class="space-y-4">
            @csrf
            <div class="px-3 form-control">
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
                <button type="button" onclick="cancel_downloadseats()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">Cancel</button>
                <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">Download</button>
            </div>
        </form>
    </div>
</div>
