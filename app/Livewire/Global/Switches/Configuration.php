<?php

namespace App\Livewire\Global\Switches;

use App\Models\Log;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Archive;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Setting;
use Livewire\Component;
use App\Models\SeatPlan;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\EnrolledCourse;
use App\Jobs\DeactivateArchiveJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log as LaravelLog;

class Configuration extends Component
{
    public $isDevInteg, $isMaintenance, $isRegStud, $isRegLoginStud, $isRegInst, $isRegAdmins = false;
    public $token, $password;

    public function mount(){
        // $maintenance = Setting::where('id', '1')->first();
        $appSetting = View::shared('appSetting');

        // Maintenance Mode
        if($appSetting->isMaintenance == '1'){
            $this->isMaintenance = true;
        } else {
            $this->isMaintenance = false;
        }

        // Device Integration
        if($appSetting->isDevInteg == '1'){
            $this->isDevInteg = true;
        } else {
            $this->isDevInteg = false;
        }

        // Register Students via Google
        if($appSetting->isRegStud == '1'){
            $this->isRegStud = true;
        } else {
            $this->isRegStud = false;
        }

        // Login/Register Students
        if($appSetting->isRegLoginStud == '1'){
            $this->isRegLoginStud = true;
        } else {
            $this->isRegLoginStud = false;
        }

        // Register Instructors
        if($appSetting->isRegInst == '1'){
            $this->isRegInst = true;
        } else {
            $this->isRegInst = false;
        }

        // Register Admins
        if($appSetting->isRegAdmins == '1'){
            $this->isRegAdmins = true;
        } else {
            $this->isRegAdmins = false;
        }
    }

    public function updatedIsMaintenance($isMaintenance){
        $setting = Setting::where('id', '1');
        if ($isMaintenance) {
            $setting->update([
                'isMaintenance' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isMaintenance' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function updatedIsDevInteg($isDevInteg){
        $setting = Setting::where('id', '1');
        if ($isDevInteg) {
            $setting->update([
                'isDevInteg' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isDevInteg' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function updatedIsRegStud($isRegStud){
        $setting = Setting::where('id', '1');
        if ($isRegStud) {
            $setting->update([
                'isRegStud' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isRegStud' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function updatedIsRegLoginStud($isRegLoginStud){
        $setting = Setting::where('id', '1');
        if ($isRegLoginStud) {
            $setting->update([
                'isRegLoginStud' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isRegLoginStud' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function updatedIsRegInst($isRegInst){
        $setting = Setting::where('id', '1');
        if ($isRegInst) {
            $setting->update([
                'isRegInst' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isRegInst' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function updatedIsRegAdmins($isRegAdmins){
        $setting = Setting::where('id', '1');
        if($isRegAdmins) {
            $setting->update([
                'isRegAdmins' => '1'
            ]);
            toastr()->success('Settings Saved Successfully');
        } else {
            $setting->update([
                'isRegAdmins' => '0'
            ]);
            toastr()->success('Settings Saved Successfully');
        }
    }

    public function truncateAttendances(){
        try {
            Schema::disableForeignKeyConstraints();
            Attendance::truncate();
            toastr()->success('Truncate Attendances Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateEnrolledCourses(){
        try {
            Schema::disableForeignKeyConstraints();
            EnrolledCourse::truncate();
            toastr()->success('Truncate EnrolledCourses Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateScheds(){
        try{
            Schema::disableForeignKeyConstraints();
            Schedules::truncate();
            toastr()->success('Truncate Schedules Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateLogs(){
        try {
            Schema::disableForeignKeyConstraints();
            Log::truncate();
            toastr()->success('Truncate Logs Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch (QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateSeatPlan(){
        try {
            Schema::disableForeignKeyConstraints();
            SeatPlan::truncate();
            toastr()->success('Truncate Seat Plan Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch (QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateCourses(){
        try {
            Schema::disableForeignKeyConstraints();
            Course::truncate();
            toastr()->success('Truncate Courses Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateStudents(){
        try {
            Schema::disableForeignKeyConstraints();
            User::truncate();
            toastr()->success('Truncate Students Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateInstructors(){
        try {
            Schema::disableForeignKeyConstraints();
            Faculty::truncate();
            toastr()->success('Truncate Instructors Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function truncateSections(){
        try {
            Schema::disableForeignKeyConstraints();
            Section::truncate();
            toastr()->success('Truncate Sections Successfully');
            Schema::enableForeignKeyConstraints();
            $this->dispatch('close-modal');
        } catch(QueryException $ex) {
            toastr()->error($ex->getMessage());
            $this->dispatch('close-modal');
        }
    }

    public function activateArchive($archive_id){
        $archive = Archive::findOrFail($archive_id);

        if($archive){
            $output = Artisan::call('snapshot:load', [
                'name' => $archive->snapshot_data,
                '--connection' => 'mysql_archive'
            ]);

            if($output == '0'){
                $archive->update([
                    'status' => '1'
                ]);
                $this->dispatch('close-modal');
                toastr()->success('Snapshot Activated Successfully');
            } else {
                $this->dispatch('close-modal');
                toastr()->error('Snapshot Activation Failed');
            }
        }
    }

    public function deactivateArchive($archive_id){
        $archive = Archive::findOrFail($archive_id);

        if($archive){
            try {
                // Log before calling Artisan command
                LaravelLog::info("Attempting to rollback migrations for archive ID: {$archive_id}");

                $output = Artisan::call('migrate:rollback', [
                    '--database' => 'mysql_archive'
                ]);

                if($output == '0'){
                    $archive->update([
                        'status' => '0'
                    ]);

                    $this->dispatch('close-modal');
                    toastr()->success('Snapshot Deactivated and Rollback Migrations Successfully');

                } else {
                    $this->dispatch('close-modal');
                    toastr()->error('Snapshot Deactivation Failed');
                }

            } catch (\Exception $e) {
                $this->dispatch('close-modal');
                LaravelLog::error("Error during deactivation: " . $e->getMessage());
                toastr()->error('An error occurred during deactivation');
            }
        }
    }

    public function generateToken(){
        $admin = Admin::findOrFail(Auth::user()->id);
        if($admin){
            $this->token = $admin->createToken($admin->first_name . ' ' . $admin->last_name)->plainTextToken;
        }
        toastr()->success('Token Generated Successfully');
        $this->dispatch('generate-token');
    }

    public function revokeToken(){
        $admin = Admin::findOrFail(Auth::user()->id);

        if ($admin && Hash::check($this->password, $admin->password)) {
            $admin->tokens()->delete();
            $this->dispatch('close-modal');
            toastr()->success('Token Revoked Successfully');
        } else {
            toastr()->error('Password is incorrect. Token revocation failed.');
        }
    }

    public function render(){
        $archives = Archive::all();

        // Check if has token exists
        $Checktoken = DB::table('personal_access_tokens')->where('tokenable_id', Auth::id())->first();
        return view('livewire.global.switches.configuration', [
            'archives' => $archives,
            'Checktoken' => $Checktoken
        ]);
    }
}
