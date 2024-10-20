<x-slot:title>Admins</x-slot:title>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Admins</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Admins</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>GENDER</th>
                            <th>EMAIL</th>
                            <th>ROLES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                        <tr>
                            <td><div class="font-bold">{{ $admin->id }}</div></td>
                            <td><div class="">{{ $admin->first_name }} {{ $admin->last_name }}</div></td>
                            <td>
                                <div class="">
                                    @if ($admin->gender)
                                        @if ($admin->gender == '1')
                                            Male
                                        @elseif ($admin->gender == '2')
                                            Female
                                        @endif
                                    @else
                                        No Gender Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $admin->email }}</div></td>
                            <td>
                                @if (!empty($admin->getRoleNames()))
                                    @forelse ($admin->getRoleNames() as $rolename)
                                        <span class="badge badge-ghost badge-sm">{{ $rolename }}</span>
                                    @empty
                                        No Roles Assigned
                                    @endforelse
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Users Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>