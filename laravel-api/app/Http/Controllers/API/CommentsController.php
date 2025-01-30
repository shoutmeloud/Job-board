<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentuserid=$request->currentuserid; 
        $projectid=$request->projectid;
        $all_coments = comments::where('project_id',$projectid)->with('users','users.Client','users.employee_profile')->orderBy('id', 'ASC')->get();
        return response()->json([
            "success" => true,
            "message" => "Comments List",
            "currentuserid" => $request->currentuserid,
            "comments" => $all_coments,
        ]);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $currentuserid=$request->currentuserid;   
        $validator = Validator::make($request->all(), [
            'newComment' => 'required|string',           
        ]); 
        
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); 
            return response()->json($errors, 400);
        }

        try {
            // Create a new skills and insert data into skills table
            $insertdata=comments::create([
                'user_id' => $currentuserid, 
                'project_id' => $request->input('id'), 
                'comments' => $request->input('newComment'),
            ]);
            
             return response()->json(['message' => 'Comments Added Successfully']);
        //  $commentid=$insertdata->id;
        //  $single_coments = comments::where('id',$commentid)->with('users','users.Client','users.employee_profile')->first();
        //  return response()->json(['message' => 'Comment Added Successfully','comments'=>$single_coments]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
    
}
