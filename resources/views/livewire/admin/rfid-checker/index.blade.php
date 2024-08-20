<x-slot:title>
    RFID Checker
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">RFID Checker</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Checking for RFID if is Working</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Please Scan the RFID</div>
                </div>

                <div class="overflow-x-auto">
                    <form wire:submit.prevent="checkUIDTag">
                        <div class="w-full">
                            <label class="label-text">Tag UID</label>
                            <input wire:model="tag_uid" id="tag_uid" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="tag_uid" autofocus type="text" placeholder="">
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Student / Instructor Information</div>
                </div>

                <div class="overflow-x-auto">

                    <div class="w-full">
                        <label class="label-text">Student Avatar</label>
                        {{-- <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" value="{{ $info->avatar ?? '' }}" type="text" placeholder="" disabled> --}}
                        <img src="{{ $info->avatar ?? '' }}" class="rounded-md" alt="" srcset="">
                    </div>

                    <div class="w-full">
                        <label class="label-text">Student ID</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" value="{{ $info ? $info->student_id : $info->id ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">UID Tag</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" value="{{ $info->tag_uid ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">Name</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" value="{{ $info->name ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">Section (Student)</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" value="{{ $info->section->program ?? '' }} {{ $info->section->year ?? '' }}{{ $info->section->block ?? '' }}" type="text" placeholder="" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        var input = document.getElementById("tag_uid");
        input.addEventListener("keypress", function(event) {
            if(event.key === "Enter") {
                const taguid = document.getElementById("tag_uid").value = "";
            }
        });
    </script>
</x-slot>
