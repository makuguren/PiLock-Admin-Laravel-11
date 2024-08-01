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
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="student_id" value="{{ $user->student_id }}" id="" type="text" placeholder="">
                            @error('student_id')<small class="text-danger">{{$message}}</small> @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Section</label>
                            <select class="select select-bordered w-full bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="section_id">
                                <option>--Select your Section--</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $section->id == $user->section_id ? 'Selected':'' }}>{{ $section->section_name }}</option>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            <span class="text-white text-sm">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
