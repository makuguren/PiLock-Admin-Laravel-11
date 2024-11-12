<x-slot:title>
    RFID Checker
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">RFID Checker</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Checking for RFID if is Working</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Please Scan the RFID</div>
                </div>

                <div class="overflow-x-auto">
                    <form wire:submit.prevent="checkUIDTag">
                        <div class="w-full">
                            <label class="label-text">Tag UID</label>
                            <input wire:model="tag_uid" id="tag_uid" class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" name="tag_uid" autofocus type="text" placeholder="">
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Student / Faculty Information</div>
                </div>

                <div class="overflow-x-auto">

                    <div class="w-full">
                        <label class="label-text">Student Avatar</label>
                        {{-- <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" value="{{ $info->avatar ?? '' }}" type="text" placeholder="" disabled> --}}
                        <img src="{{ $info->avatar ?? '' }}" class="rounded-md" alt="" srcset="">
                    </div>

                    <div class="w-full">
                        <label class="label-text">Student ID</label>
                        <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" value="{{ $info ? $info->student_id : $info->id ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">UID Tag</label>
                        <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" value="{{ $info->tag_uid ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">Name</label>
                        <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" value="{{ $info->first_name ?? '' }} {{ $info->last_name ?? '' }}" type="text" placeholder="" disabled>
                    </div>

                    <div class="w-full">
                        <label class="label-text">Section (Student)</label>
                        <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300" value="{{ $info->section->program ?? '' }} {{ $info->section->year ?? '' }}{{ $info->section->block ?? '' }}" type="text" placeholder="" disabled>
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
