<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\API\SeetingsController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SkillsController;
use App\Http\Controllers\API\EmployeesController;
use App\Http\Controllers\API\CommentsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('forgot_password', 'sendResetLinkEmail');
    Route::post('reset_password', 'resetPasswordApi');
    
});

Route::middleware([EnsureTokenIsValid::class])->group(function(){
    Route::get('get_client_list', [ClientController::class,'getClientList']);    
   
});

Route::get('one_click_login/{id}', [UserController::class,'oneClickLogin']); 
Route::post('register_new_client', [UserController::class,'addNewClient']); 

Route::middleware([EnsureTokenIsValid::class])->group(function(){
    
    // User Management
    Route::get('getlist', [ClientController::class,'getlist']);
    Route::get('/userdetails', [UserController::class, 'GetuserDetails'])->name('userdetails');    
    Route::get('/logout', [UserController::class, 'userlogout']);
    Route::post('/updateuserdata', [UserController::class, 'update']);
    Route::post('/changepassword', [UserController::class, 'changePassword']);
    


    Route::post('/addproject', [ProjectsController::class, 'store']);
    Route::get('/clientproject', [ProjectsController::class, 'clientprojectlist']);
    Route::get('/getprojecthistory', [ProjectsController::class, 'getprojecthistory']);


    // Seeting Management  
    Route::get('get_settings_data', [SeetingsController::class,'getSettingsData']);    
    Route::post('update_settings_data', [SeetingsController::class,'updateSettingsData']);    
    
    // Client Management  
    Route::post('add_new_client', [ClientController::class,'addNewClient']);     
    Route::get('get_client_list', [ClientController::class,'getClientList']);
    Route::get('get_individual_client_data/{id}', [ClientController::class,'getIndividualClientData']);      
    Route::get('delete_client_data/{id}', [ClientController::class,'deleteClientData']);   
    Route::post('update_client_data', [ClientController::class,'updateClientData']);
    Route::post('add_client_refarral_point', [ClientController::class,'addRefarralTransactionData']);
    Route::get('get_refarral_transaction_data/{id}', [ClientController::class,'getRefarralTransactionData']);  
    Route::get('get_invite_data', [ClientController::class,'getInviteList']);  
    
    // Category Management  
    Route::post('add_new_category', [CategoryController::class,'addNewCategory']);     
    Route::get('get_category_list', [CategoryController::class,'getCategoryList']);
    Route::get('get_individual_category_data/{id}', [CategoryController::class,'getIndividualCategory']);      
    Route::get('delete_category_data/{id}', [CategoryController::class,'deleteCategory']);   
    Route::post('update_category_data', [CategoryController::class,'updateCategory']);
    
    // Skills Management  
    Route::post('add_new_skills', [SkillsController::class,'addNewSkills']);     
    Route::get('get_skills_list', [SkillsController::class,'getSkillsList']);
    Route::get('get_individual_skills_data/{id}', [SkillsController::class,'getIndividualSkills']);      
    Route::get('delete_skills_data/{id}', [SkillsController::class,'deleteSkills']);   
    Route::post('update_skills_data', [SkillsController::class,'updateSkills']);


    // Employee Management  
    Route::get('get_emp_cat_and_skills', [EmployeesController::class,'getEmployeeCategoryAndSkils']);    
    Route::post('add_new_employee', [EmployeesController::class,'addNewEmployee']);     
    Route::get('get_employee_list', [EmployeesController::class,'getEmployeeList']);
    Route::get('get_individual_employee_data/{id}', [EmployeesController::class,'getIndividualEmployeeData']); 
    Route::get('delete_employee_data/{id}', [EmployeesController::class,'deleteEmployeeData']);   
    Route::post('update_employee_data', [EmployeesController::class,'updateEmployeeData']);
    Route::get('download-cv/{filename}', [EmployeesController::class,'downloadCV']);   
    
    
   // Project Management  
    Route::get('get_all_client_list', [ProjectsController::class,'getAllClient']);
    Route::get('get_emp_with_cat_and_skill', [ProjectsController::class,'getEmployeeList']);
    Route::post('add_new_project', [ProjectsController::class,'addNewProject']);   
    Route::post('add_new_draft_project', [ProjectsController::class,'addNewDraftProject']);   
    Route::get('get_all_project_list', [ProjectsController::class,'getProjectList']);
    Route::get('get_individual_client_project/{id}', [ProjectsController::class,'getIndividualClientProjectData']); 
    Route::post('update_project_data', [ProjectsController::class,'updateProjectData']); 
    Route::post('update_project_assign_emp', [ProjectsController::class,'updateProjectAssignEmployee']);
    Route::post('update_project_data_for_client', [ProjectsController::class,'updateProjectDataForClient']); 
    Route::get('get_employee_project_list', [ProjectsController::class,'getEmployeeProjectList']);
    Route::get('get_employee_project_details', [ProjectsController::class,'getEmpprojectdetails']);
    Route::get('delete_project_data/{id}', [ProjectsController::class,'deleteProjectData']);   
    Route::post('delete_project_files', [ProjectsController::class,'deleteProjectfiles']); 
    // Projects Comment  
    Route::post('postcomment', [CommentsController::class,'store']);   
    Route::get('getcommentslist', [CommentsController::class,'index']); 
    
    
    
    //user Dashboard 
    Route::get('get_dashboard_data', [UserController::class,'getDashboardData']); 
    Route::post('updateuserimagedata', [UserController::class,'updateUserImageData']);   
    
});


