<x-admin-app-layout>

    <x-slot:title>
        Settings
    </x-slot:title>

    {{-- @include('admin.settings.modals.trunattendances')
    @include('admin.settings.modals.truncourses')
    @include('admin.settings.modals.trunenrolled')
    @include('admin.settings.modals.truninst')
    @include('admin.settings.modals.trunlogs')
    @include('admin.settings.modals.trunscheds')
    @include('admin.settings.modals.trunseatplan')
    @include('admin.settings.modals.trunsections')
    @include('admin.settings.modals.trunstudents') --}}

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

        {{-- Alert Message --}}
        @if (session('message'))
            <div role="alert" class="mb-4 alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-1">
            @can('Update Settings')
            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Website Configuration</div>
                </div>
                {{-- Code Here --}}
                <form action="{{ route('admin.settings.saveSettings') }}" method="POST" class="w-full">
                    @csrf
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Website Title</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="website_title" value="{{ $setting->website_title ?? '' }}" id="" type="text" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <button type="submit" class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span class="text-sm text-white">Save</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Switches Section --}}
            <livewire:global.switches.configuration />
            @endcan

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Admin Profile Information</div>
                </div>

                {{-- Code Here --}}
                <form action="{{ route('admin.settings.updateProfile') }}" method="POST" class="w-full">
                    @csrf
                    @method('patch')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3 md:w-1/2">
                            <label class="label-text">First Name</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="first_name" value="{{ $user->first_name }}" id="" type="text" placeholder="">
                        </div>

                        <div class="w-full px-3 md:w-1/2">
                            <label class="label-text">Last Name</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="last_name" value="{{ $user->last_name }}" id="" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Email Address</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="email" value="{{ $user->email }}" id="" type="email" placeholder="">
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Theme</label>
                            <select name="admin_theme" class="w-full mt-2 mb-2 select select-bordered bg-base-300">
                                <option value="light" {{ $user->admin_theme == 'light' ? 'selected':'' }}>Light</option>
                                <option value="dark" {{ $user->admin_theme == 'dark' ? 'selected':'' }}>Dark</option>
                            </select>
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Theme</label>
                            <select name="theme" class="w-full select select-bordered bg-base-300">
                                <option value="light" {{ $setting->theme == 'light' ? 'selected':'' }}>Light</option>
                                <option value="dark" {{ $setting->theme == 'dark' ? 'selected':'' }}>Dark</option>
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label class="label-text" for="grid-first-name">Theme</label>
                            <input class="w-full input input-bordered bg-base-300" id="" type="text" placeholder="">
                        </div>
                        <div class="w-full px-3 md:w-1/2">
                            <label class="label-text" for="">Last Name</label>
                            <input class="w-full input input-bordered bg-base-300" id="" type="text" placeholder="">
                        </div>
                    </div> --}}
                    {{-- <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text" for="">Section</label>
                            <select class="w-full select select-bordered bg-base-300">
                                <option disabled selected>Select your Section</option>
                                <option>BSIT 3A</option>
                                <option>BSIT 3B</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="flex flex-row-reverse">
                        <button type="submit" class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                            <span class="text-sm text-white">Save</span>
                        </button>
                    </div>
                    {{-- <div class="flex flex-wrap mb-2">
                        <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-city">
                                City
                            </label>
                            <input
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" type="text" placeholder="Albuquerque">
                        </div>
                        <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state">
                                State
                            </label>
                            <div class="relative">
                                <select
                                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-state">
                                    <option>New Mexico</option>
                                    <option>Missouri</option>
                                    <option>Texas</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-zip">
                                Zip
                            </label>
                            <input
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-zip" type="text" placeholder="90210">
                        </div>
                    </div> --}}
                </form>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Admin Change Password</div>
                </div>

                <form action="{{ route('admin.password.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">Current Password</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="current_password" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-3">
                        <div class="w-full px-3">
                            <label class="label-text">New Password</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="password" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <div class="w-full px-3">
                            <label class="label-text">Confirm Password</label>
                            <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300 form-control" name="password_confirmation" id="" type="password" placeholder="">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
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

</x-admin-app-layout>
