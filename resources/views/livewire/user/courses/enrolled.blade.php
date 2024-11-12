<x-slot:title>
    Your Courses
</x-slot:title>

<div>
    @include('livewire.user.courses.unenroll')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Your Courses</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Your Courses</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-4">
                @forelse ($enrolledCourses as $enrolledCourse)
                    <div class="p-6 border-gray-200 rounded-md shadow-md bg-base-200 shadow-black/5">
                        <div class="text-lg font-bold">{{ $enrolledCourse->course->course_title }}</div>
                        <div class="mb-3 text-sm">{{ $enrolledCourse->course->course_code }} | {{ $enrolledCourse->course->section->program }} {{ $enrolledCourse->course->section->year }}{{ $enrolledCourse->course->section->block }}</div>
                        {{-- <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. At ipsa commodi tempora qui libero. Temporibus veritatis debitis fugiat deserunt recusandae aspernatur magni unde. Commodi temporibus, suscipit amet qui error dolorem?</div> --}}
                        <div class="mt-3">Faculty: {{ $enrolledCourse->course->faculty->first_name }} {{ $enrolledCourse->course->faculty->last_name }}</div>

                        <label for="unenroll_modal" wire:click="getEnrolledCourseID({{ $enrolledCourse->id }})" class="mt-6 text-white bg-red-700 btn hover:bg-red-500">
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
