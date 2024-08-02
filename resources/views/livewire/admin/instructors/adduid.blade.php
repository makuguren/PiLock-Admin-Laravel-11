<x-slot:title>
    Add Tag UID Instructors
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
                    <a href="{{ route('admin.instructors.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Instructors</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Add Tag UID</li>
                </ul>
            </div>
            <a href="{{ route('admin.instructors.index') }}" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
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
                        <input wire:model="tag_uid" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="tag_uid" id="tag_uid" onkeydown="focusNext(event, 'instructor_id')" autofocus type="text" placeholder="">
                        @error('tag_uid')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-row mb-6 place-items-center">
                    <div class="w-full px-3">
                        <label class="label-text">Instructor ID</label>
                        <input wire:model="instructor_id" id="instructor_id" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" type="text" placeholder="">
                        @error('instructor_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <button wire:click="findInstructor" type="button" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 mt-2 w-32">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                        <span class="text-white text-sm">Search</span>
                    </button>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="label-text" for="grid-first-name">Instructor Name</label>
                        <input class="input input-bordered w-full bg-base-300" name="name" value="{{ $instructor->name ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="label-text" for="">Instructor Email</label>
                        <input class="input input-bordered w-full bg-base-300" name="email" value="{{ $instructor->email ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" @if($isDisabled) disabled @endif class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-ml mt-5 w-32" id="saveuid">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span class="text-white text-sm">Save</span>
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
