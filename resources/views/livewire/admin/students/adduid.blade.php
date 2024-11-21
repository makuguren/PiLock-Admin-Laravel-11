<x-slot:title>
    Add Tag UID Students
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Add Tag UID</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ route('admin.dashboard.index') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <a href="{{ route('admin.students.index') }}" class="mr-2 font-medium text-gray-400 hover:text-gray-600">Students</a>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Add Tag UID</li>
                </ul>
            </div>
            <a wire:navigate.hover href="{{ route('admin.students.index') }}" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-sm text-white">Cancel</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Code Here --}}
            <form wire:submit.prevent="updateUIDTag" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="label-text">Tag UID</label>
                        <input wire:model="tag_uid" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="tag_uid" id="tag_uid" onkeydown="focusNext(event, 'student_id')" autofocus type="text" placeholder="">
                        @error('tag_uid')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-row items-center mb-4">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label>
                        <div class="flex items-center">
                            <input wire:model="student_id" id="student_id" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" type="text" placeholder="Enter student name or ID">
                            <div class="ml-5">
                                <button wire:click="findStudent" type="button" class="w-32 mt-2 mb-2 bg-blue-700 btn btn-ghost hover:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                    <span class="text-sm text-white">Search</span>
                                </button>
                            </div>
                        </div>
                        @error('faculty_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="label-text" for="">Name</label>
                        <input class="w-full mt-2 mb-2 input input-bordered bg-base-300" name="name" value="{{ $student->first_name ?? '' }} {{ $student->last_name ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Section</label>
                        <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="section" id="section" value="{{ $student->section->program ?? '' }} {{ $student->section->year ?? '' }}{{ $student->section->block ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" @if($isDisabled) disabled @endif class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500" id="saveuid">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        $(document).ready(function() {
            $('#tag_uid').focus();
            // $('body').mousemove(function(){
            //     $('#tag_uid').focus();
            // })
        });

        function focusNext(event, nextFieldId) {
            if (event.keyCode === 13) {
                event.preventDefault();

                var nextInput = document.getElementById(nextFieldId);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function enableSave(){
            document.getElementById('saveuid').disabled = false;
        }

    </script>
</x-slot>
