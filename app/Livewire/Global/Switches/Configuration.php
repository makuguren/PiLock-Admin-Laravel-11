<?php

namespace App\Livewire\Global\Switches;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\View;

class Configuration extends Component
{
    public $isDevInteg, $isMaintenance, $isRegStud, $isRegLoginStud, $isRegInst = false;

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

    public function render(){
        return view('livewire.global.switches.configuration');
    }
}
