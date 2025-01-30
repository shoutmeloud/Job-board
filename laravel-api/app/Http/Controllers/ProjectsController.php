<?php

namespace App\Http\Controllers;

use App\Models\projects;
use App\Models\User;
use App\Models\Employees;
use App\Models\Skills;
use App\Models\Clients;
use App\Models\EmployeeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{

    public function store(Request $request)
    {
        $currentuserid=$request->currentuserid;         
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
            'projecttitle' => 'required|string',
        ]);   
        
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');


        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        else{
            //return $currentuserid;
            $clientdata = projects::create([
                "client_id" => $currentuserid,
                "projecttitle" => $request->projecttitle,
                "projectdescription" => $request->projectdetails,
                "documentfile" => $fileName
            ]);
            $clientdata->save();
            $result['code'] = '200';
            $result['status'] = 'success';
            $result['message'] = 'Project Updated Successfully';
            return $result;
        }      

        return response()->json($fileName);
       
    }

  

    function clientprojectlist(Request $request){
        $all_projects= null;
        $my_contacts = null;
        $currentuserid=$request->currentuserid;    
        $all_projects = projects::where('client_id',$currentuserid)->orderBy('id', 'DESC')->paginate($request->no_of_item);
        return response()->json([
            "success" => true,
            "message" => "Contact List",
            "currentuserid" => $request->currentuserid,
            "projectlist" => $all_projects,
        ]);
    }

    function getprojecthistory(Request $request){
        $currentuserid=$request->currentuserid; 
        $projectid=$request->id;    
        $projectdetails = projects::where('client_id',$currentuserid)->where('id',$projectid)->first();
              
        return response()->json([
            "success" => true,
            "message" => "Contact List",
            "currentuserid" => $request->currentuserid,
            "projectdata" => $projectdetails,
            "selectedemployee" => $projectdetails->allrelateduser(),
            //"skillsets" => $projectdetails->allrelateduser()->EmployeeSkills(),

        ]);
    }
  
    
    // Get all client list  
    public function getAllClient()
    {       
        $clientData = User::WHERE('usertype',2)->get();
        
        return response()->json([
            'message' => 'Success',
            'client_data' => $clientData,
        ],200);            
    }

    // Get all employee list  
    public function getEmployeeList()
    {       
        // $employeeData = User::WHERE('usertype',3)->with('employee_profile','employee_profile.category')->get();
        $employeeData = Employees::with('user')->with('category')->get();
        $skillsData = $this->getSkillsData($employeeData);
        $formattedEmployeeData =  $this->getFormattedEmployeeData($employeeData, $skillsData);
        return response()->json([
            'message' => 'Success',
            'data' => $formattedEmployeeData,
        ],200);            
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


    public function getFormattedEmployeeData($employeeData, $skillsData)
    {
        $formattedEmployeeData = [];

        foreach ($employeeData as $employee) {
            $employeeId = $employee['user']['id'];
            $employeesId = $employee['id'];
            $firstName = $employee['user']['firstname'];
            $lastName = $employee['user']['lastname'];
            $category = $employee['category']['category'];
            
            // Get skills for the current employee
            $employeeSkills = $skillsData[$employeesId]->toArray(); // Convert to array
            $skillsList = implode(', ', array_column($employeeSkills, 'skills'));  

            // Create the formatted label
            $label = "{$firstName} {$lastName} ({$category})  ({$skillsList})";

            // Add the formatted data to the array
            $formattedEmployeeData[] = [
                'id' => $employeeId,
                'label' => $label,
            ];

        }
        return $formattedEmployeeData;
    }

    public function addNewProject(Request $request){
                
        $validator = Validator::make($request->all(), [
            'clientId' => 'required|string',
            'employeeids' => 'required', 
            'empratingvalues' => 'required',
            'projecttitle' => 'required|string',            
            'file' => 'required|mimes:pdf',
        ]); 
        // exit(0);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        else{
            
            $empratingvalues = json_decode($request->empratingvalues);
            $empIdAndRatings = [];
            foreach ($empratingvalues as $emprating) {
                foreach ($emprating as $key => $value) {
                    if ($key !== 'id') {
                        $empIdAndRatings[] = [$emprating->id => $key];
                    }
                }
            }

            projects::create([
                "client_id" => $request->clientId,
                "projecttitle" => $request->projecttitle,
                "projectdescription" => $request->project_description,
                "documentfile" => $fileName,
                "selectedemployeeid" => $request->employeeids,
                "selectedemployee" => json_encode($empIdAndRatings),
                "status" => '1',
            ]);

            return response()->json([
                'message' => 'Project added successfully',               
            ],200);   
          
        }      

        return response()->json($fileName);
    }


    public function addNewDraftProject(Request $request){
            //   $currentuserid=$request->currentuserid;      
            // return $currentuserid;
            
            if($request->currentuserid != 1){
                $clientId = $request->currentuserid;
            }else{
                $clientId = $request->clientId;
            }
            
            if($request->tableId == "null" || $request->tableId == '' || empty($request->tableId)){
                $projectdata = new projects();              
            }else{            
                $projectdata = projects::find($request->tableId);  
            }
            // return $projectdata;
          
            $fileNames = [];
            if($request->file('files')){
                if ($request->hasFile('files')) {                
                    $files = $request->file('files');
                    // $fileNames = [];
                    // Iterate through files
                    foreach ($files as $file) {
                        // Handle each file (save to storage, database, etc.)
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('uploads', $fileName, 'public');
                        $fileNames[] = $fileName; // Add file name to array
                    }
                      // Retrieve existing documentfile array from the database
                    $existingFiles = [];
                    if (!empty($projectdata->documentfile)) {
                        $existingFiles = json_decode($projectdata->documentfile, true);
                    }
    
                    // Merge existing files with new files
                    $mergedFiles = array_merge($existingFiles, $fileNames);
    
                    // Remove duplicates
                    $uniqueFiles = array_unique($mergedFiles);
                    $fileNames = $uniqueFiles;
                    // Update the documentfile field
                    $projectdata->documentfile = json_encode($uniqueFiles);
                }
            }else{
                $fileNames =  json_decode($projectdata->documentfile);
            }

            // if(isset($request->clientId)){
            //     $projectdata->client_id = $request->clientId;
            // }
            if(isset($clientId)){
                $projectdata->client_id = $clientId;
            }
            if(isset($request->projecttitle)){
                $projectdata->projecttitle = $request->projecttitle;
            }
            if(isset($request->project_description)){
                $projectdata->projectdescription = $request->project_description;
            }
            if(isset($request->employeeids)){
              $projectdata->selectedemployeeid = $request->employeeids;
            }
            if(isset($request->empratingvalues)){
                $empratingvalues = json_decode($request->empratingvalues);        
                $empIdAndRatings = [];
                foreach ($empratingvalues as $emprating) {
                    foreach ($emprating as $key => $value) {
                        if ($key !== 'id') {
                            $empIdAndRatings[] = [$emprating->id => $key];
                        }
                    }
                }        
                $projectdata->selectedemployee = json_encode($empIdAndRatings);
            }
            
            if(isset($request->status)){
               $projectdata->status =  $request->status;  
            }else{
                 $projectdata->status = '3';
            }
         
              
            $projectdata->save();

            if( $projectdata->id ){
                return response()->json([
                    'message' => 'Project saved as draft',   
                    'draft_id' =>    $projectdata->id,    
                    'files' => $fileNames,     
                ],200);   
            }else{
                return response()->json([
                    'message' => 'Failed To save project as draft. Try after sometime', 
                ],400);   
            }        
    }
  
    // Get all employee list  
    public function getProjectList()
    {       
        // $employeeData = User::WHERE('usertype',3)->with('employee_profile','employee_profile.category')->get();
        $projectdata = projects::with('user')->orderBy('id', 'DESC')->get();
        return response()->json([
            'message' => 'Success',
            'project_data' => $projectdata,
        ],200);            
    }       

    // Function for get data of a specific project  
    public function getIndividualClientProjectData(Request $request)
    {       
        $projectData = projects::where('id', $request->id)->with('user')->get();
        $employeeData = $this->getEmployeeData($projectData);
        return response()->json([
            'message' => 'Success',
            'project_data' => $projectData,
            'employeeData' => $employeeData,
        ],200);            
    }

    public function getEmployeeData($employeeData){

        $allemployeeData = [];
        foreach ($employeeData as $employee) {
            // $skillIds = explode(',', $employee['employee_profile']['skills']);            
            // Use the Skill model to retrieve skills based on IDs
            $employeeName = User::whereIn('id', json_decode($employee['selectedemployeeid'], true))->get();        
            $allemployeeData[$employee['id']] = $employeeName;      
            $employee['selectedemployeeid'] = $employeeName;
        }
        return $allemployeeData;
    }
  
    
    // Function for update data of a specific employee
    public function updateProjectData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clientId' => 'required|string',
            'employeeids' => 'required', 
            'empratingvalues' => 'required',
            'projecttitle' => 'required|string',            
            // 'file' => 'required|mimes:pdf',    
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            if($request->input('id')){       
                // return $request->empratingvalues;
               
                // if ($request->file('file')) {
                //     $file = $request->file('file');
                //     $fileName = time() . '_' . $file->getClientOriginalName();
                //     $file->storeAs('uploads', $fileName, 'public');
                // }
                // Update data of employee table  
                $empratingvalues = json_decode($request->empratingvalues);
                $empIdAndRatings = [];
                foreach ($empratingvalues as $emprating) {
                    foreach ($emprating as $key => $value) {
                        if ($key !== 'id') {
                            $empIdAndRatings[] = [$emprating->id => $key];
                        }
                    }
                }

                $projectsUpdatedData = [
                    "client_id" => $request->clientId,
                    "projecttitle" => $request->projecttitle,
                    "projectdescription" => $request->project_description,
                    "selectedemployeeid" => $request->employeeids,
                    "selectedemployee" => json_encode($empIdAndRatings),       
                    'status' => $request->status,             
                ];

                if ($request->file('file')) {
                    $projectsUpdatedData['documentfile'] = $fileName;
                }

                projects::where('id', $request->input('id'))->update($projectsUpdatedData);
            }else{
                return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
            }

            // return employee updated data 
            $projectData = Employees::where('id', $request->id)->with('user')->with('category')->get();
            return response()->json(['message' => 'Project Updated Successfully', 'project_data' => $projectData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }
    
    
    public function updateProjectAssignEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'employeeids' => 'required', 
            'empratingvalues' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            if($request->input('id')){         
               
                // Update data of employee table  
                $empratingvalues = json_decode($request->empratingvalues);
                $empIdAndRatings = [];
                foreach ($empratingvalues as $emprating) {
                    foreach ($emprating as $key => $value) {
                        if ($key !== 'id') {
                            $empIdAndRatings[] = [$emprating->id => $key];
                        }
                    }
                }

                $projectsUpdatedData = [
                    "selectedemployeeid" => $request->employeeids,
                    "selectedemployee" => json_encode($empIdAndRatings),                    
                ];

                projects::where('id', $request->input('id'))->update($projectsUpdatedData);
            }else{
                return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
            }

            // return employee updated data 
            $projectData = Employees::where('id', $request->id)->with('user')->with('category')->get();
            return response()->json(['message' => 'Project Updated Successfully', 'project_data' => $projectData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }
    
    
      // Function for update data of a specific employee
     public function updateProjectDataForClient(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'id' => 'required|string',            
             'projecttitle' => 'required|string',            
             // 'file' => 'required|mimes:pdf',    
         ]);
 
         if ($validator->fails()) {
             $errors = $validator->errors()->all();            
             // Return only the error messages in the desired format
             return response()->json($errors, 400);
         }
 
         try {
             if($request->input('id')){         
                
                //  if ($request->file('file')) {
                //      $file = $request->file('file');
                //      $fileName = time() . '_' . $file->getClientOriginalName();
                //      $file->storeAs('uploads', $fileName, 'public');
                //  }
                 // Update data of employee table  
               
 
                 $projectsUpdatedData = [
                    "projecttitle" => $request->projecttitle,
                    "projectdescription" => $request->project_description,                        
                 ];
 
                //  if ($request->file('file')) {
                //      $projectsUpdatedData['documentfile'] = $fileName;
                //  }
 
                 projects::where('id', $request->input('id'))->update($projectsUpdatedData);
             }else{
                 return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
             }
 
             // return employee updated data 
            $projectdetails = projects::where('client_id',$request->currentuserid)->where('id',$request->input('id'))->first();
            return response()->json([
                "success" => true,
                "message" => "Project Updated Successfully",
                "currentuserid" => $request->currentuserid,
                "projectdata" => $projectdetails,
            ]);
          
 
         } catch (\Exception $e) {          
             return response()->json(['error' => $e->getMessage()], 500);
         }            
     }
     
    public function getEmployeeProjectList(Request $request)
    {
        $employeeId=$request->currentuserid;    
        $projectData = projects::whereJsonContains('selectedemployeeid', (string) $employeeId)->orderBy('id', 'DESC')->paginate($request->no_of_item);
        return response()->json(['message' => 'Data Fetched Successfully', 'emp_project_data' => $projectData]);
    }
    
    
    function getEmpprojectdetails(Request $request){
        $currentuserid=$request->currentuserid; 
        $projectid=$request->id;    
        $projectdetails = projects::where('id',$projectid)->first();
              
        return response()->json([
            "success" => true,
            "message" => "Contact List",
            "currentuserid" => $request->currentuserid,
            "projectdata" => $projectdetails,
            // "selectedemployee" => $projectdetails->allrelateduser(),
            //"skillsets" => $projectdetails->allrelateduser()->EmployeeSkills(),

        ]);
    }
    
    
    // Function for get data of a specific employee  
    public function deleteProjectData(Request $request)
    {       
        projects::where('id', $request->id)->delete();
       
        return response()->json([
            'message' => 'Project Deleted Successfully',
        ],200);            
    }
    
    
    public function deleteProjectfiles(Request $request)
    {       
        $projectsUpdatedData = [
            "documentfile" => $request->file,
        ];

        projects::where('id', $request->projectid)->update($projectsUpdatedData);
       
        return response()->json([
            'message' => 'File Deleted Successfully',
        ],200);            
    }
  
}
