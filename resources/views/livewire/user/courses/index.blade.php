<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.user.courses.enrollment')

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
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                @forelse ($courses as $course)
                    <div class="bg-base-200 border-gray-200 shadow-md shadow-black/5 p-6 rounded-md">
                        <div class="font-bold text-lg">{{ $course->course_title }}</div>
                        <div class="text-sm mb-3">{{ $course->course_code }} | {{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</div>
                        <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. At ipsa commodi tempora qui libero. Temporibus veritatis debitis fugiat deserunt recusandae aspernatur magni unde. Commodi temporibus, suscipit amet qui error dolorem?</div>
                        <div class="mt-3">Instructor: {{ $course->instructor->name }}</div>

                        {{-- @if ($checkEnrollCourse->course_id == $course->id)
                            <label class="btn bg-blue-700 hover:bg-blue-500 text-white mt-6">
                                You are Enrolled!
                            </label>
                        @else
                            <label for="enrollment_modal" wire:click="getCourseDetail({{ $course->id }})" class="btn bg-red-700 hover:bg-red-500 text-white mt-6">
                                Enroll Me!
                            </label>
                        @endif --}}

                        <label for="enrollment_modal" wire:click="getCourseDetail({{ $course->id }})" class="btn bg-red-700 hover:bg-red-500 text-white mt-6">
                            Enroll Me!
                        </label>
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
