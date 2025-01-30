<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeetingsController extends Controller
{
    
    public function getSettingsData()
    {
        $settingsData = Settings::all();
        return response()->json([
            'message' => 'Success',
            'settings_data' => $settingsData,
        ],200);        
    }

    public function updateSettingsData(Request $request)
    {
        $settingsData = $request->data;
        foreach ($settingsData as $key => $value) {
            // Your logic to save $value with $key in the database            
            Settings::updateOrCreate(['id' => $key], ['option_value' => $value]);
        }
        $settingsData = Settings::all();
        return response()->json(['message' => 'Settings Updated successfully', 'settings_data' => $settingsData],200);     
    }
}
