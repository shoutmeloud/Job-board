<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EmployeeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Get all category list  
    public function getCategoryList()
    {       
        $category = EmployeeCategories::orderBy('id', 'DESC')->get();
        
        return response()->json([
            'message' => 'Success',
            'category' => $category,
        ],200);            
    }

    // Function for add a new category  
    public function addNewCategory(Request $request){

        // Check all the fileds have valid data 
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',           
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            // Create a new category and insert data into category table
            EmployeeCategories::create([
                'category' => $request->input('category'), 
                'status' => $request->input('status'),
            ]);
        
            return response()->json(['message' => 'Category Added Successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
   
    // Function for get data of a specific category  
    public function getIndividualCategory(Request $request)
    {       
        $category = EmployeeCategories::where('id', $request->id)->where('status', '1')->get();
        
        return response()->json([
            'message' => 'Success',
            'category' => $category,
        ],200);            
    }

    // Function for update data of a specific category
    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            if($request->input('id')){         
                // Update category data       
                $category = EmployeeCategories::where('id', $request->input('id'))->update([
                    'category' => $request->input('category'),
                    // 'status' => $request->input('status'),                    
                ]);           
               
            }else{
                return response()->json(['message' => 'Faild To Update Data Something Went Wrong!'],422);
            }

            // return updated category data 
            $categoryData = EmployeeCategories::where('id', $request->input('id'))->get();
            return response()->json(['message' => 'Category Updated Successfully', 'categoryData' => $categoryData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }

    
     // Function for delete a specific category  
    public function deleteCategory(Request $request)
    {       
        EmployeeCategories::where('id', $request->id)->delete();
        
        return response()->json([
            'message' => 'Category Deleted Successfully',
        ],200);            
    }
}
