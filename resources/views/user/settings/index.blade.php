<x-app-layout>

    <x-slot:title>
        Settings
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Settings</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Settings</li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Profile Information</div>
                </div>

                {{-- Code Here --}}
                <form action="{{ route('user.settings.updateProfile') }}" method="POST" class="w-full">
                    @csrf
                    @method('patch')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Full Name</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="name" value="{{ $user->name }}" id="" type="text" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Email Address</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="email" value="{{ $user->email }}" id="" type="email" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Student ID</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="student_id" value="{{ $user->student_id }}" id="" type="text" placeholder="" disabled>
                            @error('student_id')<small class="text-danger">{{$message}}</small> @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Section</label>
                            <select class="select select-bordered w-full bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="section_id" disabled>
                                <option>--Select your Section--</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $section->id == $user->section_id ? 'Selected':'' }}>{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                                @endforeach
                            </select>
                            @error('section_id')<small class="text-danger">{{$message}}</small> @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Birthdate</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="birthdate" value="{{ $user->birthdate }}" type="date" placeholder="">
                            @error('birthdate')<small class="text-danger">{{$message}}</small> @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Theme</label>
                            <select name="user_theme" class="select select-bordered w-full bg-base-300">
                                <option value="light" {{ $user->user_theme == 'light' ? 'selected':'' }}>Light</option>
                                <option value="dark" {{ $user->user_theme == 'dark' ? 'selected':'' }}>Dark</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-ml mt-5 w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span class="text-white text-sm">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
