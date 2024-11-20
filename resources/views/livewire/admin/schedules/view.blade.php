<input type="checkbox" id="view_schedule_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="w-11/12 max-w-5xl modal-box">
      <h3 class="text-lg font-bold">Manage Schedule</h3>
        <form wire:submit.prevent="updateSchedule" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Course and Section</label> <span class="text-red-600">*</span>
                    <select wire:model="course_id" id="editcourse_id" class="block w-full px-4 py-3 mt-2 mb-4 select select-bordered bg-base-300 form-control" disabled>
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
                    <input value="{{ $course_code ?? '' }}" id="course_code" class="block w-full px-4 py-3 mt-2 mb-4 input input-bordered bg-base-300 form-control" type="name" disabled>
                </div>

                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Faculty</label>
                    <input value="{{ $faculty_fname ?? '' }} {{ $faculty_lname ?? '' }}" id="faculty_name" class="block w-full px-4 py-3 mt-2 mb-4 input input-bordered bg-base-300 form-control" type="name" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Select Day(s)</label> <span class="text-red-600">*</span>
                    <select wire:model="days" id="editdays" class="block w-full px-4 py-3 mt-2 mb-4 select select-bordered bg-base-300 form-control" disabled>
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
                    <select wire:model="time_start" id="edittime_start" class="block w-full px-4 py-3 mt-2 mb-4 select select-bordered bg-base-300 form-control" disabled>
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
                    <select wire:model="time_end" id="edittime_end" class="block w-full px-4 py-3 mt-2 mb-4 select select-bordered bg-base-300 form-control" disabled>
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
                    <input wire:model="lateDuration" id="editlate_duration" class="block w-full px-4 py-3 mt-2 mb-4 input input-bordered bg-base-300 form-control" type="number" placeholder="0 - 60 minutes" disabled>
                    @error('lateDuration') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button disabled type="submit" id="updateBtn" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Update
                    </button>
                    <button onclick="enable_sched()" id="editBtn" type="button" class="text-white bg-green-700 btn btn-ghost hover:bg-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                        Edit
                    </button>
                    <button disabled onclick="delete_sched()" id="deleteBtn" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        Delete
                    </button>
                    <button onclick="cancel_sched()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
