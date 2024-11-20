<div>
    @include('admin.settings.modals.trunattendances')
    @include('admin.settings.modals.truncourses')
    @include('admin.settings.modals.trunenrolled')
    @include('admin.settings.modals.truninst')
    @include('admin.settings.modals.trunlogs')
    @include('admin.settings.modals.trunscheds')
    @include('admin.settings.modals.trunseatplan')
    @include('admin.settings.modals.trunsections')
    @include('admin.settings.modals.trunstudents')

    {{-- Archived Data Modal --}}
    @include('admin.settings.modals.archived')
    @include('admin.settings.modals.execute')

    {{-- API Token Modal --}}
    @include('admin.settings.modals.token')
    @include('admin.settings.modals.revoke')

    <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
        <div class="flex items-start justify-between mb-4">
            <div class="font-medium">Database Configuration</div>
        </div>

        <div class="grid grid-cols-1 gap-2 mb-6 lg:grid-cols-4">
            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunattendances_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Attendances
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunenrolled_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate EnrolledCourses
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunscheds_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Schedules
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunlogs_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Logs
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunseatplan_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Seat Plan
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="truncourses_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Courses
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunstudents_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Students
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="truninst_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Instructors
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunsections_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Sections
                </label>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
        <div class="p-6 mt-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">Switches</div>
            </div>

            <div class="grid grid-cols-1 gap-2 mb-6 lg:grid-cols-2">

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Maintenance Mode</span>
                    <input type="checkbox" wire:model.live="isMaintenance" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Device Integration</span>
                    <input type="checkbox" wire:model.live="isDevInteg" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Students Via Google</span>
                    <input type="checkbox" wire:model.live="isRegStud" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Login/Register Students</span>
                    <input type="checkbox" wire:model.live="isRegLoginStud" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Instructors</span>
                    <input type="checkbox" wire:model.live="isRegInst" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Admins</span>
                    <input type="checkbox" wire:model.live="isRegAdmins" class="checkbox checkbox-primary" />
                    </label>
                </div>
            </div>
        </div>

        <div class="p-6 mt-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">Website Configuration</div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Archived Data</h3>
                    <p class="text-sm text-gray-600">Archived Data for Students and Faculties and other Configurations.</p>
                </div>
                <label for="archived_modal" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/><path d="M10 12h4"/></svg>
                    Archived Data
                </label>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Laboratory Seats</h3>
                    <p class="text-sm text-gray-600">Laboratory Seats in MAC Laboratory.</p>
                </div>
                <a href="{{ route('admin.seatsconfig.index') }}" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                    Configure
                </a>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">API Token</h3>
                    <p class="text-sm text-gray-600">Generate API Token for API Authentication.</p>
                </div>
                @if ($Checktoken === null)
                    <button wire:click='generateToken' class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key-square"><path d="M12.4 2.7a2.5 2.5 0 0 1 3.4 0l5.5 5.5a2.5 2.5 0 0 1 0 3.4l-3.7 3.7a2.5 2.5 0 0 1-3.4 0L8.7 9.8a2.5 2.5 0 0 1 0-3.4z"/><path d="m14 7 3 3"/><path d="m9.4 10.6-6.814 6.814A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814"/></svg>
                        Generate Token
                    </button>
                @else
                    <label for="revoketoken_modal" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        Revoke Token
                    </label>
                @endif
            </div>

            {{-- <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Tagline</h3>
                    <p class="text-sm text-gray-600">Brief description or slogan for your website</p>
                </div>
                <button class="btn btn-primary">Edit</button>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Site Icon</h3>
                    <p class="text-sm text-gray-600">Upload a small image to be shown as favicon</p>
                </div>
                <button class="btn btn-primary">Upload</button>
            </div> --}}
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('trunattendances_modal').checked = false;
            document.getElementById('trunenrolled_modal').checked = false;
            document.getElementById('trunscheds_modal').checked = false;
            document.getElementById('trunseatplan_modal').checked = false;
            document.getElementById('truncourses_modal').checked = false;
            document.getElementById('trunstudents_modal').checked = false;
            document.getElementById('truninst_modal').checked = false;
            document.getElementById('trunsections_modal').checked = false;
            document.getElementById('trunlogs_modal').checked = false;
            document.getElementById('execute_modal').checked = false;
            document.getElementById('revoketoken_modal').checked = false;
        });

        function cancel_truncate(){
            document.getElementById('trunattendances_modal').checked = false;
            document.getElementById('trunenrolled_modal').checked = false;
            document.getElementById('trunscheds_modal').checked = false;
            document.getElementById('trunseatplan_modal').checked = false;
            document.getElementById('truncourses_modal').checked = false;
            document.getElementById('trunstudents_modal').checked = false;
            document.getElementById('truninst_modal').checked = false;
            document.getElementById('trunsections_modal').checked = false;
            document.getElementById('trunlogs_modal').checked = false;
        }

        function cancel_archive(){
            document.getElementById('archived_modal').checked = false;
        }

        function executeModal(){
            document.getElementById('execute_modal').checked = true;
        }

        window.addEventListener('generate-token', event => {
            document.getElementById('token_modal').checked = true;
        });

        function cancel_token(){
            document.getElementById('token_modal').checked = false;
        }

        function cancel_revoke(){
            document.getElementById('revoketoken_modal').checked = false;
        }

        function copyToken() {
            var tokenInput = document.getElementById('apiToken');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(tokenInput.value).then(() => {
                alert('Token copied to clipboard');
            }).catch(err => {
                console.error('Failed to copy token: ', err);
            });
        }
    </script>
</x-slot>
