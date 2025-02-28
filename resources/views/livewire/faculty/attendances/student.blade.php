<input type="checkbox" id="addStudent_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Student</h3>
        <form wire:submit.prevent="addStudAttendance" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-row mb-2 place-items-center">
                <div class="w-full px-3">
                    <label class="label-text">Student ID</label>
                    <input wire:model="search_student" id="addstud_search" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('search_student') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>

                <button wire:click="findStudent" type="button" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 mt-2 w-32">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <span class="text-white">Search</span>
                </button>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full md:w-1/2 px-3">
                    <label class="label-text">First Name</label>
                    <input wire:model="first_name" id="addstud_fname" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                    @error('student_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <label class="label-text">Last Name</label>
                    <input wire:model="last_name" id="addstud_lname" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                    @error('student_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Section</label>
                    <input wire:model="section" id="addstud_section" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" disabled>
                    @error('section') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Course Title</label>
                    <select wire:model="course_id" id="addstud_courseId" class="select select-bordered flex w-full items-center">
                        <option value="">All Course and Section</option>
                        @foreach($courseSecs as $courseSec)
                            <option value="{{ $courseSec->id }}">
                                {{ $courseSec->course_title ?? 'No Course Title' }} -
                                {{ $courseSec->section->program }}
                                {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Save
                    </button>
                    <button onclick="cancel_student()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
