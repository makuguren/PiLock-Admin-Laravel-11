<x-slot:title>
    Courses
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
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
                            <th>FACULTY</th>
                            {{-- <th>COURSE KEY</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                        <tr>
                            <td><div class="font-bold">{{ $course->id }}</div></td>
                            <td><div class="">{{ $course->course_code }}</div></td>
                            <td><div class="">{{ $course->course_title }}</div></td>
                            <td>
                                <div class="">{{ $course->section->program }}
                                    {{ $course->section->year }}{{ $course->section->block }}
                                </div>
                            </td>
                            <td><div class="">{{ $course->instructor->first_name }} {{ $course->instructor->last_name }}</div></td>
                            {{-- <td><div class="">{{ $course->course_key }}</div></td> --}}
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Subjects Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
