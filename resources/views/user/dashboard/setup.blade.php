<!-- Put this part before </body> tag -->
<input type="checkbox" id="updateInfo_modal" class="modal-toggle" {{ $checked ?? '' }}/>
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Setting Up your Information!</h3>
    <h3 class="text-sm">Please Setup your Information for the First time to Continue.</h3>
    <form wire:submit.prevent="updateStudentInfo" method="dialog" class="w-full mt-6">
        @csrf
        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
                <label class="label-text">Student ID</label>
                <input wire:model="student_id" id="addstudent_id" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                @error('student_id') <span class="error text-sm text-red-600 space-y-1" role="alert">{{ $message }}</span> @enderror
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
            <div class="w-full px-3">
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
        </div>

        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
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
        </div>

        <div class="flex flex-wrap mb-2">
            <div class="w-full px-3">
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
                <label class="label-text">Gender</label>
                <select wire:model="gender" id="addgender" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                    <option value="">--Select Gender--</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                @error('gender') <span class="error" role="alert">{{ $message }}</span> @enderror
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
                <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                    Update
                </button>
            </div>
        </div>
    </form>
    <div class="modal-action">
      {{-- <label for="my_modal_6" class="btn btn-ghost">Close!</label> --}}
    </div>
  </div>
</div>
