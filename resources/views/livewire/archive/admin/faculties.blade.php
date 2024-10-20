<x-slot:title>
    Faculties
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Faculties</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Faculties</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>ID</th>
                            <th>TAG UID</th>
                            <th>NAME</th>
                            <th>GENDER</th>
                            <th>EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instructors as $instructor)
                        <tr>
                            <td><div class="font-bold">{{ $instructor->id }}</div></td>
                            <td>
                                <div class="">
                                    @if ($instructor->tag_uid)
                                        {{ $instructor->tag_uid }}
                                    @else
                                        No UID Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $instructor->first_name }} {{ $instructor->last_name }}</div></td>
                            <td>
                                <div class="">
                                    @if ($instructor->gender)
                                        @if ($instructor->gender == '1')
                                            Male
                                        @elseif ($instructor->gender == '2')
                                            Female
                                        @endif
                                    @else
                                        No Gender Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $instructor->email }}</div></td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Faculties Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $instructors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>