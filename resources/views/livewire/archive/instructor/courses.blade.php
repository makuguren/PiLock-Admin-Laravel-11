<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.archive.instructor.courses-key')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Courses</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Courses</li>
                </ul>
            </div>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
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
                                        <label for="code_modal" wire:click="copyEnrollmentKey('{{ Crypt::decryptString($course->course_key) }}')" class="btn btn-ghost bg-orange-700 hover:bg-orange-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                                            <span class="text-white text-sm">Copy Enrollment Key</span>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $instructors->links() }} --}}
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
