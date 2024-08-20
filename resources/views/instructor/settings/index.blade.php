<x-instructor-app-layout>

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
                    <div class="font-medium">Admin Profile Information</div>
                </div>

                {{-- Code Here --}}
                <form action="{{ route('instructor.settings.updateProfile') }}" method="POST" class="w-full">
                    @csrf
                    @method('patch')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Full Name</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="name" value="{{ $user->name }}" id="" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Email Address</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="email" value="{{ $user->email }}" id="" type="email" placeholder="">
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Theme</label>
                            <select name="instructor_theme" class="select select-bordered w-full bg-base-300">
                                <option value="light" {{ $user->instructor_theme == 'light' ? 'selected':'' }}>Light</option>
                                <option value="dark" {{ $user->instructor_theme == 'dark' ? 'selected':'' }}>Dark</option>
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

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Admin Change Password</div>
                </div>

                <form action="{{ route('instructor.password.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Current Password</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="current_password" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">New Password</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="password" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text">Confirm Password</label>
                            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" name="password_confirmation" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
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

</x-instructor-app-layout>
