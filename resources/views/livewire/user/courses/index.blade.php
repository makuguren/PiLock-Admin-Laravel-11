<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.user.courses.enrollment')

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
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-4">
                @forelse ($courses as $course)
                    <div class="p-6 border-gray-200 rounded-md shadow-md bg-base-200 shadow-black/5">
                        <div class="text-lg font-bold">{{ $course->course_title }}</div>
                        <div class="mb-3 text-sm">{{ $course->course_code }} | {{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</div>
                        <div class="mt-3">Faculty: {{ $course->faculty->first_name }} {{ $course->faculty->last_name }}</div>

                        {{-- Check if the Course is Enrolled or Not. --}}
                        @if(in_array($course->id, $checkEnrollCourse))
                            <label class="mt-6 text-white bg-blue-700 btn hover:bg-blue-500">
                                You are Enrolled!
                            </label>
                        @else
                            <label for="enrollment_modal" wire:click="getCourseDetail({{ $course->id }})" class="mt-6 text-white bg-red-700 btn hover:bg-red-500">
                                Enroll Me!
                            </label>
                        @endif

                    </div>
                @empty
                    No Courses Found!
                @endforelse
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('enrollment_modal').checked = false;
        });

        window.addEventListener('invalid-Coursekey', event => {
            document.getElementById('course_key').value = '';
        });

        function cancel_enrollment(){
            document.getElementById('enrollment_modal').checked = false;
            document.getElementById('course_key').value = '';
        }
    </script>
</x-slot>
