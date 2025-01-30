<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{
    // Get all skills list  
    public function getSkillsList()
    {       
        $skills = Skills::orderBy('id', 'DESC')->get();
        
        return response()->json([
            'message' => 'Success',
            'skills' => $skills,
        ],200);            
    }

    // Function for add a new skills  
    public function addNewSkills(Request $request){

        // Check all the fileds have valid data 
        $validator = Validator::make($request->all(), [
            'skills' => 'required|string',           
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            // Create a new skills and insert data into skills table
            Skills::create([
                'skills' => $request->input('skills'), 
                'status' => $request->input('status'),
            ]);
        
            return response()->json(['message' => 'Skill Added Successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    // Function for get data of a specific skills  
    public function getIndividualSkills(Request $request)
    {       
        $skills = Skills::where('id', $request->id)->where('status', '1')->get();
        
        return response()->json([
            'message' => 'Success',
            'skills' => $skills,
        ],200);            
    }

    // Function for update data of a specific skills
    public function updateSkills(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skills' => 'required|string', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            if($request->input('id')){         
                // Update skills data       
                $skills = Skills::where('id', $request->input('id'))->update([
                    'skills' => $request->input('skills'),
                    // 'status' => $request->input('status'),                    
                ]);           
                
            }else{
                return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
            }

            // return updated skills data 
            $skillsData = Skills::where('id', $request->input('id'))->get();
            return response()->json(['message' => 'Skill Updated Successfully', 'skillsData' => $skillsData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }


    // Function for delete a specific skills  
    public function deleteSkills(Request $request)
    {       
        Skills::where('id', $request->id)->delete();
        
        return response()->json([
            'message' => 'Skill Deleted Successfully',
        ],200);            
    }
}
