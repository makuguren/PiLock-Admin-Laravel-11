<x-slot:title>
    Your Courses
</x-slot:title>

<div>
    @include('livewire.user.courses.unenroll')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Your Courses</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Your Courses</li>
                </ul>
            </div>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                @forelse ($enrolledCourses as $enrolledCourse)
                    <div class="bg-base-200 border-gray-200 shadow-md shadow-black/5 p-6 rounded-md">
                        <div class="font-bold text-lg">{{ $enrolledCourse->course->course_title }}</div>
                        <div class="text-sm mb-3">{{ $enrolledCourse->course->course_code }} | {{ $enrolledCourse->course->section->program }} {{ $enrolledCourse->course->section->year }}{{ $enrolledCourse->course->section->block }}</div>
                        {{-- <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. At ipsa commodi tempora qui libero. Temporibus veritatis debitis fugiat deserunt recusandae aspernatur magni unde. Commodi temporibus, suscipit amet qui error dolorem?</div> --}}
                        <div class="mt-3">Instructor: {{ $enrolledCourse->course->instructor->first_name }} {{ $enrolledCourse->course->instructor->last_name }}</div>

                        <label for="unenroll_modal" wire:click="getEnrolledCourseID({{ $enrolledCourse->id }})" class="btn bg-red-700 hover:bg-red-500 text-white mt-6">
                            Unenroll
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
            document.getElementById('unenroll_modal').checked = false;
        });

        function cancel_enrollment(){
            document.getElementById('unenroll_modal').checked = false;
        }
    </script>
</x-slot>
