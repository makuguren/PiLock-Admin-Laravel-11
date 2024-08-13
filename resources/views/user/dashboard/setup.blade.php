<!-- Put this part before </body> tag -->
<input type="checkbox" id="updateInfo_modal" class="modal-toggle" {{ $checked ?? '' }}/>
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Setting Up your Information!</h3>
    <h3 class="text-sm">Please Setup your Information for the First time to Continue.</h3>
    <form wire:submit.prevent="updateStudentInfo" method="dialog" class="w-full mt-6">
        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
                <label class="label-text">Student ID</label>
                <input wire:model="student_id" id="addstudent_id" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                @error('student_id') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
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
                <label class="label-text">Birthdate</label>
                <input wire:model="birthdate" id="addbirthdate" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="date">
                @error('birthdate') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="modal-action">
            <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Update</button>
            </div>
        </div>
    </form>
    <div class="modal-action">
      {{-- <label for="my_modal_6" class="btn btn-ghost">Close!</label> --}}
    </div>
  </div>
</div>
