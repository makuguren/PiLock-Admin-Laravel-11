<input type="checkbox" id="create_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Student</h3>
        <form wire:submit.prevent="addStudCourse" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-row items-center mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Student ID</label> <span class="text-red-500">*</span>
                    <div class="flex items-center">
                        <input wire:model="search_student" id="addstud_search" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" type="text" placeholder="Enter student ID">
                        <div class="ml-5">
                            <button wire:click="findStudent" type="button" class="w-32 mt-2 mb-2 bg-blue-700 btn btn-ghost hover:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                <span class="text-sm text-white">Search</span>
                            </button>
                        </div>
                    </div>
                    @error('search_student')<small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">First Name</label>
                    <input wire:model="first_name" id="addstud_fname" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text" disabled>
                </div>

                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Last Name</label>
                    <input wire:model="last_name" id="addstud_lname" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Section</label>
                    <input wire:model="section" id="addstud_section" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text" disabled>
                </div>
            </div>

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Course Title</label> <span class="text-red-500">*</span>
                    <select wire:model="course_id" id="addstud_courseId" class="flex items-center w-full mt-2 mb-2 select select-bordered">
                        <option value="">All Course and Section</option>
                        @foreach($courseSecs as $courseSec)
                            <option value="{{ $courseSec->id }}">
                                {{ $courseSec->course_title ?? 'No Course Title' }} -
                                {{ $courseSec->section->program }}
                                {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Save
                    </button>
                    <button onclick="cancel_student()" type="button" class="text-white bg-red-700 btn hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
