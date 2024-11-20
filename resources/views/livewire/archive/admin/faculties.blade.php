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
                        @forelse ($faculties as $faculty)
                        <tr>
                            <td><div class="font-bold">{{ $faculty->id }}</div></td>
                            <td>
                                <div class="">
                                    @if ($faculty->tag_uid)
                                        {{ $faculty->tag_uid }}
                                    @else
                                        No UID Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $faculty->first_name }} {{ $faculty->last_name }}</div></td>
                            <td>
                                <div class="">
                                    @if ($faculty->gender)
                                        @if ($faculty->gender == '1')
                                            Male
                                        @elseif ($faculty->gender == '2')
                                            Female
                                        @endif
                                    @else
                                        No Gender Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $faculty->email }}</div></td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Faculties Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $faculties->links() }}
                </div>
            </div>
        </div>
    </div>
</div>