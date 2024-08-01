<div>
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Current Attendances</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Current Attendances</li>
                </ul>
            </div>
            {{-- @can('Create Instructors') --}}
            {{-- <a href="{{ route('admin.instructors.addtaguid') }}" class="btn btn-ghost bg-green-700 hover:bg-green-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                <span class="text-white text-sm">Add Tag UID</span>
            </a> --}}

            {{-- <label for="add_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                <span class="text-white text-sm">Add Instructor</span>
            </label> --}}
            {{-- @endcan --}}
        </div>

        <div wire:poll class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>STUDENT ID</th>
                            <th>NAME AND EMAIL</th>
                            <th>SECTION</th>
                            <th>SUBJECT</th>
                            <th>IS PRESENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td><div class="font-bold">{{ $attendance->student->student_id }}</div></td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                          <div class="mask mask-squircle h-12 w-12">
                                            <img
                                              src="{{ $attendance->student->avatar ?? '' }}" />
                                          </div>
                                        </div>
                                        <div>
                                          <div class="font-bold">{{ $attendance->student->name }}</div>
                                          <div class="text-sm opacity-50">{{ $attendance->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="">{{ $attendance->student->section->section_name }}</div></td>
                                <td><div class="">{{ $attendance->subject->subject_name }}</div></td>
                                <td>
                                    <div class="">
                                        @if ($attendance->isPresent == '0')
                                            <div class="badge bg-red-700 gap-2 text-white">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                Absent
                                            </div>
                                        @else
                                            <div class="badge bg-green-700 gap-2 text-white">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                Present
                                            </div>
                                        @endif
                                    </div>
                                </td>
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
