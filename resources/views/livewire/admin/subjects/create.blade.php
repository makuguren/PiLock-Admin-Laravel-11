<input type="checkbox" id="create_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="text-lg font-bold">Create Course</h3>
        <form wire:submit.prevent="saveCourse" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full md:w-1/2 px-3">
                    <label class="label-text">Code</label>
                    <input wire:model="course_code" id="addcourse_code" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_code') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <label class="label-text">Title</label>
                    <input wire:model="course_title" id="addcourse_title" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_title') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Section</label>
                    <select wire:model="section_id" id="addsection_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Section--</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                        @endforeach
                    </select>
                    @error('section_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div> --}}

            <div class="flex flex-wrap mb-2">
                <div class="w-full md:w-1/3 px-3">
                    <label class="label-text">Programs</label>
                    <select wire:model="program" id="addprogram" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Program--</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BLIS">BLIS</option>
                        <option value="BSIS">BSIS</option>
                    </select>
                    @error('program') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <label class="label-text">Year</label>
                    <select wire:model="year" id="addyear" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Year--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    @error('year') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <label class="label-text">Block</label>
                    <select wire:model="block" id="addblock" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
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
                    @error('block') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Instructor</label>
                    <select wire:model="instructor_id" id="addinstructor_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Instructor--</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->first_name }} {{ $instructor->last_name }}</option>
                        @endforeach
                    </select>
                    @error('instructor_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Enrollment Key</label>
                    <input wire:model="course_key" id="addcourse_key" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_key') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Save
                    </button>
                    <button onclick="cancel_course()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
