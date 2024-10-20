<x-slot:title>
    Sections
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Sections</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Sections</li>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sections as $section)
                        <tr>
                            <td><div class="font-bold">{{ $section->id }}</div></td>
                            <td><div class="">{{ $section->program }} {{ $section->year }}{{ $section->block }}</div></td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Sections Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $sections->links() }}
                </div>
            </div>
        </div>
    </div>
</div>