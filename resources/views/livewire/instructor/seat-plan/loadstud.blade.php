<input type="checkbox" id="load_stud" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Load Students</h3>
        <form wire:submit.prevent="loadStudentsData" method="dialog" class="w-full mt-6">
            {{-- <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Subject</label>
                    <select wire:model="subject_id" id="selsubject_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Subject--</option>
                            @foreach ($subjects as $id => $subject)
                                <option value="{{ $id }}">{{ $subject }}</option>
                            @endforeach
                    </select>
                    @error('subject_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div> --}}
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Course & Section</label>
                    <select wire:model="course_id" id="selsection_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Courses & Section--</option>
                        @foreach ($sections as $section)
                            <option value="{{ optional($section->course->first())->id }}">
                                {{ optional($section->course->first())->course_title ?? 'No Course Title' }}  -
                                {{ $section->program }}
                                {{ $section->year }}{{ $section->block }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Save
                    </button>
                    <button onclick="cancel_load()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
