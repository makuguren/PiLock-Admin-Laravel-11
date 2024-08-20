<input type="checkbox" id="code_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">View Course Code</h3>
        <div class="flex flex-wrap mt-6">
            <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text" name="" value="{{ $cpCourseKey }}" id="course_key" disabled>
        </div>
        <div class="modal-action">
            <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                <button onclick="copyCourseCode()" type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Copy
                </button>
                <button onclick="cancel_course()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
