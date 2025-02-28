<!-- Put this part before </body> tag -->
<input type="checkbox" id="updateInfo_modal" class="modal-toggle" {{ $checked ?? '' }}/>
<div dialog wire:ignore.self class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Setting Up your Information</h3>
    <h3 class="text-sm">Please Setup your Information for the First time to Continue.</h3>
    <form wire:submit.prevent="updateStudentInfo" method="dialog" class="w-full mt-6">
        @csrf
        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Full Name</label>
                <input wire:model="full_name" id="addfull_name" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text" readonly>
                @error('full_name') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">First Name</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <input wire:model="first_name" id="addfirst_name" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                @error('first_name') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Last Name</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <input wire:model="last_name" id="addstudent_id" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                @error('last_name') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Student ID</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <input wire:model="student_id" id="addstudent_id" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" type="text">
                @error('student_id') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Programs</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <select wire:model="program" id="addprogram" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                    <option value="">--Select Program--</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSCS">BSCS</option>
                    <option value="BLIS">BLIS</option>
                    <option value="BSIS">BSIS</option>
                </select>
                @error('program') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Year</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <select wire:model="year" id="addyear" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                    <option value="">--Select Year--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                @error('year') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-4">
            <div class="w-full px-3">
                <label class="label-text">Block</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
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
                @error('block') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap mb-6">
            <div class="w-full px-3">
                <label class="label-text">Gender</label> <span class="space-y-1 text-sm text-red-600 error">*</span>
                <select wire:model="gender" id="addgender" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control">
                    <option value="">--Select Gender--</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                @error('gender') <span class="space-y-1 text-sm text-red-600 error" role="alert">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="modal-action">
            <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
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
