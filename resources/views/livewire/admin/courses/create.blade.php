<input type="checkbox" id="create_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="w-11/12 max-w-5xl modal-box">
      <h3 class="text-lg font-bold">Add Course</h3>
        <form wire:submit.prevent="saveCourse" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Code</label> <span class="text-red-600">*</span>
                    <input wire:model="course_code" id="addcourse_code" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                    @error('course_code') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full px-3 md:w-1/2">
                    <label class="label-text">Title</label> <span class="text-red-600">*</span>
                    <input wire:model="course_title" id="addcourse_title" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                    @error('course_title') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Program</label> <span class="text-red-600">*</span>
                    <select wire:model="program" id="addprogram" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                        <option value="">--Select Program--</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BLIS">BLIS</option>
                        <option value="BSIS">BSIS</option>
                    </select>
                    @error('program') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Year</label> <span class="text-red-600">*</span>
                    <select wire:model="year" id="addyear" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                        <option value="">--Select Year--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    @error('year') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full px-3 md:w-1/3">
                    <label class="label-text">Block</label> <span class="text-red-600">*</span>
                    <select wire:model="block" id="addblock" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                        <option value="">--Select Block--</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                    </select>
                    @error('block') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Faculty</label> <span class="text-red-600">*</span>
                    <select wire:model="faculty_id" id="addfaculty_id" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                        <option value="">--Select Faculties--</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->first_name }} {{ $faculty->last_name }}</option>
                        @endforeach
                    </select>
                    @error('faculty_id') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Enrollment Key</label> <span class="text-red-600">*</span>
                    <input wire:model="course_key" id="addcourse_key" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                    @error('course_key') <span class="mt-1 space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Save
                    </button>
                    <button onclick="cancel_course()" type="button" class="text-white bg-red-700 btn hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
