<x-slot:title>
    Add Tag UID Faculties
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
                    <a href="{{ route('admin.faculties.index') }}" class="mr-2 font-medium text-gray-400 hover:text-gray-600">Faculties</a>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Add Tag UID</li>
                </ul>
            </div>
            <a href="{{ route('admin.faculties.index') }}" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="text-sm text-white">Cancel</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Code Here --}}
            <form wire:submit.prevent="updateUIDTag" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Tag UID</label>
                        <input wire:model="tag_uid" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="tag_uid" id="tag_uid" onkeydown="focusNext(event, 'faculty_id')" autofocus type="text" placeholder="Tap your ID">
                        @error('tag_uid')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-row mb-6 place-items-center">
                    <div class="w-full px-3">
                        <label class="label-text">ID</label>
                        <input wire:model="faculty_id" id="faculty_id" class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" type="text" placeholder="Enter your ID">
                        @error('faculty_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <button wire:click="findFaculty" type="button" class="w-32 mt-2 bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                        <span class="text-sm text-white">Search</span>
                    </button>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="label-text" for="grid-first-name">Name</label>
                        <input class="w-full input input-bordered bg-base-300" name="name" value="{{ $faculty->first_name ?? '' }} {{ $faculty->last_name ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text" for="">Email</label>
                        <input class="w-full input input-bordered bg-base-300" name="email" value="{{ $faculty->email ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" @if($isDisabled) disabled @endif class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml" id="saveuid">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span class="text-sm text-white">Save</span>
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
