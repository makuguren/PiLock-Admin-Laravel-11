<input type="checkbox" id="enrollment_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Enroll | {{ $course_title ?? '' }}</h3>
      <h3 class="text-md">Please Enroll this Course by using Enrollent Key!</h3>
        <form wire:submit.prevent="enrollCourse" method="dialog" class="w-full mt-6">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Enrollment Key</label>
                    <input wire:model="course_key" id="course_key" class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" type="text">
                    @error('course_key') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white">Enroll Me</button>
                    <button onclick="cancel_enrollment()" type="button" class="btn btn-ghost bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
