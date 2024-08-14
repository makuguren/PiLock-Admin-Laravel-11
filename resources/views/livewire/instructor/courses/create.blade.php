<input type="checkbox" id="create_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Create Course</h3>
        <form wire:submit.prevent="saveCourse" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Code</label>
                    <input wire:model="course_code" id="addcourse_code" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_code') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Title</label>
                    <input wire:model="course_title" id="addcourse_title" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_title') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-wrap mb-2">
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
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">Save</button>
                    <button onclick="cancel_course()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
