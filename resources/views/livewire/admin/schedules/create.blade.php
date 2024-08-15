<input type="checkbox" id="add_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Schedule</h3>
        <form wire:submit.prevent="saveSchedule" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Courses</label>
                    <select wire:model="course_id" id="addcourse_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Courses--</option>
                            @foreach ($courses as $course)
                                <option wire:click="fetchCourseDetails({{ $course->id }})" value="{{ $course->id }}">{{ $course->course_title }} | {{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</option>
                            @endforeach
                    </select>
                    @error('course_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Instructor</label>
                    <input value="{{ $instructor_name }}" id="instructor_name" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="name" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Days</label>
                    <select wire:model="days" id="adddays" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Days--</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    @error('days') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Time Start</label>
                    <input wire:model="time_start" id="addtime_start" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 flex-row form-control" type="time">
                    @error('time_start') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Time End</label>
                    <input wire:model="time_end" id="addtime_end" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 flex-row form-control" type="time">
                    @error('time_end') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Save</button>
                    <button onclick="cancel_sched()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
