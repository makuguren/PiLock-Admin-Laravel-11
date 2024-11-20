<input type="checkbox" id="view_schedule_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="w-11/12 max-w-5xl modal-box">
      <h3 class="text-lg font-bold">Manage Schedule</h3>
        <form wire:submit.prevent="updateSchedule" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Course and Section</label> <span class="text-red-600">*</span>
                    <select wire:model="course_id" id="editcourse_id" class="block w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300 form-control" disabled>
                        <option value="">--Select Course--</option>
                            @foreach ($courses as $course)
                                <option wire:click="fetchCourseDetails({{ $course->id }})" value="{{ $course->id }}">{{ $course->course_title }} | {{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</option>
                            @endforeach
                    </select>
                    @error('course_id') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Course Code</label>
                    <input value="{{ $course_code ?? '' }}" id="course_code" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="name" disabled>
                </div>

                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Faculty</label>
                    <input value="{{ $faculty_fname ?? '' }} {{ $faculty_lname ?? '' }}" id="faculty_name" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="name" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Select Day(s)</label> <span class="text-red-600">*</span>
                    <select wire:model="days" id="editdays" class="block w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300 form-control" disabled>
                        <option value="">--Select Days--</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    @error('days') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Time Start</label> <span class="text-red-600">*</span>
                    <select wire:model="time_start" id="edittime_start" class="block w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300 form-control" disabled>
                        <option value="">--Select Time Start--</option>
                        <option value="07:00:00">07:00 AM</option>
                        <option value="08:00:00">08:00 AM</option>
                        <option value="09:00:00">09:00 AM</option>
                        <option value="10:00:00">10:00 AM</option>
                        <option value="11:00:00">11:00 AM</option>
                        <option value="12:00:00">12:00 PM</option>
                        <option value="13:00:00">01:00 PM</option>
                        <option value="14:00:00">02:00 PM</option>
                        <option value="15:00:00">03:00 PM</option>
                        <option value="16:00:00">04:00 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                        <option value="18:00:00">06:00 PM</option>
                        <option value="19:00:00">07:00 PM</option>
                        <option value="20:00:00">08:00 PM</option>
                    </select>
                    @error('time_start') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Time End</label> <span class="text-red-600">*</span>
                    <select wire:model="time_end" id="edittime_end" class="block w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300 form-control" disabled>
                        <option value="">--Select Time End--</option>
                        <option value="07:00:00">07:00 AM</option>
                        <option value="08:00:00">08:00 AM</option>
                        <option value="09:00:00">09:00 AM</option>
                        <option value="10:00:00">10:00 AM</option>
                        <option value="11:00:00">11:00 AM</option>
                        <option value="12:00:00">12:00 PM</option>
                        <option value="13:00:00">01:00 PM</option>
                        <option value="14:00:00">02:00 PM</option>
                        <option value="15:00:00">03:00 PM</option>
                        <option value="16:00:00">04:00 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                        <option value="18:00:00">06:00 PM</option>
                        <option value="19:00:00">07:00 PM</option>
                        <option value="20:00:00">08:00 PM</option>
                    </select>
                    @error('time_end') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Late Tolerance</label>
                    <input wire:model="lateDuration" id="editlate_duration" class="block w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300 form-control" type="number" placeholder="0 - 60 minutes" disabled>
                    @error('lateDuration') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button onclick="cancel_sched()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
