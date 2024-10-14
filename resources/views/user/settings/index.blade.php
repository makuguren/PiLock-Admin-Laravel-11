<x-app-layout>

    <x-slot:title>
        Settings
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Settings</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ url('/') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Settings</li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-1">
            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Profile Information</div>
                </div>

                {{-- Code Here --}}
                <form action="{{ route('user.settings.updateProfile') }}" method="POST" class="w-full">
                    @csrf
                    @method('patch')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Full Name</label>
                            <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300 form-control" name="name" value="{{ $user->name }}" id="" type="text" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Email Address</label>
                            <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300 form-control" name="email" value="{{ $user->email }}" id="" type="email" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Student ID</label>
                            <input class="block w-full px-4 py-3 mb-3 input input-bordered bg-base-300 form-control" name="student_id" value="{{ $user->student_id }}" id="" type="text" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Section</label>
                            <select class="block w-full px-4 py-3 mb-3 select select-bordered bg-base-300 form-control" name="section_id" disabled>
                                <option>--Select your Section--</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $section->id == $user->section_id ? 'Selected':'' }}>{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Theme</label>
                            <select name="user_theme" class="w-full select select-bordered bg-base-300">
                                <option value="light" {{ $user->user_theme == 'light' ? 'selected':'' }}>Light</option>
                                <option value="dark" {{ $user->user_theme == 'dark' ? 'selected':'' }}>Dark</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <button type="submit" class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span class="text-sm text-white">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
