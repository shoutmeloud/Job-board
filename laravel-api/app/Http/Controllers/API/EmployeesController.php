<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employees;
use App\Models\Skills;
use App\Models\EmployeeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    // Get all employee list  
    public function getEmployeeCategoryAndSkils()
    {       
        $skills = Skills::orderBy('id', 'DESC')->get();
        $category = EmployeeCategories::orderBy('id', 'DESC')->get();
        return response()->json([
            'message' => 'Success',
            'skills_data' => $skills,
            'category_data' => $category,
        ],200);            
    }

       // Function for add a new employee  
    public function addNewEmployee(Request $request){

        // Check all the fileds have valid data 
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|min:8|confirmed',
            'cvfile' => 'required|mimes:pdf,docx',
            'imagefile' => 'required|mimes:png,jpg,jpeg,webp,gif',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errors,
            ];
            return response()->json($response, 400);
        }

        try {
            // Create a new employee and insert data into user table
            $employeeData = User::create([
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password_confirmation')), 
                'usertype' => '3',
            ]);
            
            // Insert data into employee table if the user id created 
            if($employeeData->id){

                $file = $request->file('cvfile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads', $fileName, 'public');

                $imagefile = $request->file('imagefile');
                $imagefileName = time() . '_' . $imagefile->getClientOriginalName();
                $imagefile->storeAs('uploads', $imagefileName, 'public');

                Employees::create([
                    'user_id' => $employeeData->id, 
                    'country' => $request->input('country'), 
                    'about' => $request->input('about'),
                    'address' => $request->input('address'),
                    'categoryid' => $request->input('category'),
                    'skills' => $request->input('skills'),
                    'cv' => $fileName,
                    'profile_image' => $imagefileName,
                ]);
            }else{
                return response()->json(['message' => 'Faild To Save Data Something Went Wrong!'],422);
            }

            $subject = 'Employee Account Created Successfully';
            $content = 'Hi'.$request->input('firstname').', Your Employee account created successfully. You can login using credentials - Link : https://jobboard.works-reddensoft.com/, Email : '.$request->input('email').' , Password : '.$request->input('password_confirmation').'';
            $recipientEmail = $request->input('email');
            
            // Send email
            Mail::to($recipientEmail)->send(new SendMail($subject, $content));
    
            return response()->json(['message' => 'Employee Added Successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    // Get all employee list  
    public function getEmployeeList()
    {       
        // $employeeData = User::WHERE('usertype',2)->with('employee_profile','employee_profile.category')->get();
        $employeeData = Employees::with('user')->with('category')->orderBy('id', 'desc')->get();
        $skillData = $this->getSkillsData($employeeData);
        return response()->json([
            'message' => 'Success',
            'employee_data' => $employeeData,
            'skillsData' => $skillData,
        ],200);            
    }       
    // Function for get data of a specific employee  
    public function getIndividualEmployeeData(Request $request)
    {       
        $employeeData = Employees::where('id', $request->id)->with('user')->with('category')->get();
        $skillData = $this->getSkillsData($employeeData);
        return response()->json([
            'message' => 'Success',
            'employee_data' => $employeeData,
            'skillsData' => $skillData,
        ],200);            
    }
    
    // Function for update data of a specific employee
    public function updateEmployeeData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|'.Rule::unique('users')->ignore($request->input('id')),
            'phone' => 'required|string',   
            'cvfile' => 'mimes:pdf,docx',
            'imagefile' => 'mimes:png,jpg,jpeg,webp,gif',        
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errors,
            ];
            return response()->json($response, 400);
        }


        try {
            if($request->input('id')){         
                // Update employee data of user table       
                $employeeData = User::where('id', $request->input('id'))->update([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                ]);

                if($request->file('cvfile')){
                    $file = $request->file('cvfile');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads', $fileName, 'public');
                }
                if($request->file('imagefile')){
                    $imagefile = $request->file('imagefile');
                    $imagefileName = time() . '_' . $imagefile->getClientOriginalName();
                    $imagefile->storeAs('uploads', $imagefileName, 'public');
                }
                // Update data of employee table           
                // Employees::where('user_id', $request->input('id'))->update([
                $employeeUpdateData = [
                    'country' => $request->input('country'),
                    'about' => $request->input('about'),
                    'address' => $request->input('address'),
                    'categoryid' => $request->input('category'),
                    'skills' => $request->input('skills'),
                ];

                // Check if 'cv' has a value before adding it to the update array
                if($request->file('cvfile')) {
                    $employeeUpdateData['cv'] = $fileName;
                }

                // Check if 'profile_image' has a value before adding it to the update array
                if ($request->file('imagefile')) {
                    $employeeUpdateData['profile_image'] = $imagefileName;
                }

                Employees::where('user_id', $request->input('id'))->update($employeeUpdateData);
            }else{
                return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
            }

            // return employee updated data 
            $employeeData = Employees::where('id', $request->id)->with('user')->with('category')->get();
            return response()->json(['message' => 'Employee Updated Successfully', 'employee_data' => $employeeData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }

    // Function for get data of a specific employee  
    public function deleteEmployeeData(Request $request)
    {       
        User::where('id', $request->id)->delete();
        Employees::where('user_id', $request->id)->delete();
        
        return response()->json([
            'message' => 'Employee Deleted Successfully',
        ],200);            
    }
  

    public function downloadCV($filename)
    {
        $path = storage_path('app/public/uploads/' . $filename);
    
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }
    
        return response()->download($path, $filename, ['Content-Type' => 'application/pdf']);
    }

    public function getSkillsData($employeeData){

        $skillsData = [];
        foreach ($employeeData as $employee) {
            // $skillIds = explode(',', $employee['employee_profile']['skills']);
            
            // Use the Skill model to retrieve skills based on IDs
            $skills = Skills::whereIn('id', json_decode($employee['skills'], true))->get();
        
            $skillsData[$employee['id']] = $skills;
                        
            // $employee['employee_profile']['skills_data'] = $skills;
        }
        return $skillsData;
    }
}
