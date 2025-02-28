<x-slot:title>
    Make-Up Approvals
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Make-Up Schedule Approvals</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Schedules</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>FACULTY</th>
                            <th>DAYS</th>
                            <th>SECTION</th>
                            <th>TIME START</th>
                            <th>TIME END</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                        <tr>
                            <td>
                                <div class="">
                                    @if ($schedule->course_id)
                                        {{ $schedule->course->course_title }}
                                    @else
                                        No Course
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($schedule->course_id)
                                        {{ $schedule->course->faculty->first_name }} {{ $schedule->course->faculty->last_name }}
                                    @else
                                        No Faculty
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $schedule->days }}</div></td>
                            <td>
                                <div class="">
                                    @if ($schedule->course_id)
                                        {{ $schedule->course->section->program }} {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                                    @else
                                        No Section
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }}</div></td>
                            <td><div class="">{{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div></td>
                            <th>
                                <div class="flex flex-row space-x-2">
                                    @can('Approve Make-Up SchedApprovals')
                                    <a wire:click="makeupApprove({{ $schedule->id }})" class="h-8 bg-green-700 btn btn-ghost hover:bg-green-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                        <span class="text-sm text-white">Approve</span>
                                    </a>
                                    @endcan

                                    @can('Decline Make-Up SchedApprovals')
                                    <a wire:click="makeupDecline({{ $schedule->id }})" class="h-8 bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        <span class="text-sm text-white">Decline</span>
                                    </a>
                                    @endcan
                                </div>
                            </th>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Make-Up Approvals Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $schedules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
