<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.archive.faculty.courses-key')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Courses</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Courses</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>ID</th>
                            <th>CODE</th>
                            <th>TITLE</th>
                            <th>SECTION</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td><div class="font-bold">{{ $course->id }}</div></td>
                                <td><div class="">{{ $course->course_code }}</div></td>
                                <td><div class="">{{ $course->course_title }}</div></td>
                                <td><div class="">{{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</div></td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        <label for="code_modal" wire:click="copyEnrollmentKey('{{ Crypt::decryptString($course->course_key) }}')" class="bg-orange-700 btn btn-ghost hover:bg-orange-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                                            <span class="text-sm text-white">Copy Enrollment Key</span>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $faculties->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        function cancel_course(){
            document.getElementById('code_modal').checked = false;
        }

        function copyEnrollmentKey(){
            var cpEnrollmentKey = document.getElementById("course_key");
            navigator.clipboard.writeText(cpEnrollmentKey.value);
            console.log(cpEnrollmentKey.value);
        }
    </script>
</x-slot>
