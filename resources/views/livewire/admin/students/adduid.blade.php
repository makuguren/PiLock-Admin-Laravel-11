<x-slot:title>
    Add Tag UID Students
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Add Tag UID</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ route('admin.dashboard.index') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <a href="{{ route('admin.students.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Students</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Add Tag UID</li>
                </ul>
            </div>
            <a wire:navigate.hover href="{{ route('admin.students.index') }}" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-white text-sm">Cancel</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            {{-- Code Here --}}
            <form wire:submit.prevent="updateUIDTag" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Tag UID</label>
                        <input wire:model="tag_uid" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="tag_uid" id="tag_uid" onkeydown="focusNext(event, 'student_id')" autofocus type="text" placeholder="">
                        @error('tag_uid')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-row mb-6 place-items-center">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label>
                        <input wire:model="student_id" id="student_id" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" type="text" placeholder="">
                        @error('student_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <button wire:click="findStudent" type="button" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 mt-2 w-32">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span class="text-white">Search</span>
                    </button>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text" for="">Name</label>
                        <input class="input input-bordered w-full bg-base-300" name="name" value="{{ $student->name ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Section</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="section" id="section" value="{{ $student->section->program ?? '' }} {{ $student->section->year ?? '' }}{{ $student->section->block ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" @if($isDisabled) disabled @endif class="btn btn-ghost bg-blue-700 hover:bg-blue-500 mt-5 w-32" id="saveuid">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-slot:scirpts>
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
