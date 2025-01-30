import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import router from '@/routes'
const apiUrl = import.meta.env.VITE_VUE_APP_APIURL; 
const $toast = useToast(); 
const validAuthToken = localStorage.getItem('authToken');


const actions = {

    // ------------Login Module-------------

        // api for get the authtoken and login user details   
        getLoginDetailsFromApi(store, loginData) {
            axios.post(`${apiUrl}/login`, loginData)
            .then((res) => {                       
                localStorage.setItem('authToken', res.data.authorization.token);
                store.commit('userData', res.data.user);         
                router.push({ name: 'Dashboard' }); 
                // tost popup after a successfull login  
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });       
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },

        // check forgot password email is valid or not? if yes then sent a mail through the backend api 
        forgotPassword(store, userData) {
            axios.post(`${apiUrl}/forgot_password`, userData)
            .then((res) => {       
                console.log(res);      
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });          
                // router.push({ name: res.data.reset_link, query: { email: res.data.email, token: res.data.token } });  
            })
            .catch(err =>{ console.log(err)});
        },

        // api for reset the possword 
        resetPasswordApi(store, userData) {
            axios.post(`${apiUrl}/reset_password`, userData)
            .then((res) => {       
                console.log(res);        
                router.push({ name: 'Login' });  
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });       
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },

        getUserdetails(store, userdetails) {
            axios.get(`${apiUrl}/userdetails`, userdetails)
            .then((res) => {       
                console.log('response user data',res.data);
                store.commit('userData', res.data.userdetails);
            })
            .catch(err => console.log(err));
        },

        userlogout(store, data) {
            axios.get(`${apiUrl}/logout?token=`+validAuthToken)
            .then((res) => {
                console.log('res',res)
                localStorage.removeItem('authToken');
                store.commit('userData', ''); 
                router.push('/');
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },
    // ------------Login Module--------------


    // ------------Settings-------------

        getSettingsData(store,data) {
            axios.get(`${apiUrl}/get_settings_data`)
            .then((res) => {       
                // console.log(res.data.settings_data);
                store.commit('settingsData', res.data.settings_data);      
                
            })
            .catch(err =>{ console.log(err)});
        },

        updateSettingsData(store, settingsData) {
            axios.post(`${apiUrl}/update_settings_data`, settingsData)
            .then((res) => {       
                console.log(res);
                store.commit('settingsData', res.data.settings_data);    
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{ console.log(err)});
        },

    // ------------Settings-------------
    
    
    // ------------Client-------------

        // api for get all of the client list 
        getClientDataFromApi(store) {
            axios.get(`${apiUrl}/get_client_list`)
            .then((res) => {
                store.commit('clientData', res.data.client_data);      
            })
            .catch(err => console.log(err));
        },

        // api for get individual client data 
        getIndividualClientData(store, clientData) {
            axios.get(`${apiUrl}/get_individual_client_data/`+clientData)
            .then((res) => {    
                // console.log(res.data.client_data)   
                store.commit('individualclientData', res.data.client_data);      
            })
            .catch(err => console.log(err));
        },

        // api for add news client 
        addNewClientData(store, clientdata) {
            axios.post(`${apiUrl}/add_new_client`, clientdata)
            .then((res) => {       
                router.push({ name: 'ClientList' });    
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });   
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },

        updateClientData(store, clientData) {
            axios.post(`${apiUrl}/update_client_data`, clientData)
            .then((res) => {       
                console.log(res);
                store.commit('individualclientData',  res.data.client_data);    
                router.push({ name: 'ClientList' }); 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });           
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },

        // api for get individual client data 
        deleteClientData(store, clientId) {
            axios.get(`${apiUrl}/delete_client_data/`+clientId)
            .then((res) => { 

                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                // router.push({ name: 'ClientList' });     
            })
            .catch(err => console.log(err));
        },

        addClientRefarralPoint(store, refarraldata) {
            axios.post(`${apiUrl}/add_client_refarral_point`, refarraldata)
            .then((res) => {      
                store.commit('refarralTransactionData', res.data.refarralTransactionData);       
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });        
            })
            .catch(err => console.log(err));
        },

        getRefarralPointHistory(store, clientid) {
            axios.get(`${apiUrl}/get_refarral_transaction_data/`+clientid)
            .then((res) => {    
                // console.log(res.data)   
                store.commit('refarralClientData', res.data.clientData);
                store.commit('refarralTransactionData', res.data.transaction_data);      
            })
            .catch(err => console.log(err));
        },

    // ------------Client-------------


    // ------------Categoty-------------

        // api for add new category 
        addNewCategoryData(store, categorydata) {
            axios.post(`${apiUrl}/add_new_category`, categorydata)
            .then((res) => {    
                router.push({ name: 'CategoryList' });    
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });        
            })
            .catch(err => console.log(err));
        },

        getCategoryDataFromApi(store) {
            axios.get(`${apiUrl}/get_category_list`)
            .then((res) => {
                store.commit('categoryData', res.data.category);      
            })
            .catch(err => console.log(err));
        },

        // api for get individual category data 
        getIndividualCategoryData(store, categoryData) {
            axios.get(`${apiUrl}/get_individual_category_data/`+categoryData)
            .then((res) => {    
                // console.log(res.data.category_data)   
                store.commit('individualcategoryData', res.data.category);      
            })
            .catch(err => console.log(err));
        },

        updateCategoryData(store, categoryData) {
            axios.post(`${apiUrl}/update_category_data`, categoryData)
            .then((res) => {       
                console.log(res);
                store.commit('individualcategoryData',  res.data.category);    
                router.push({ name: 'CategoryList' }); 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{ console.log(err)});
        },

        // api for get individual category data 
        deleteCategoryData(store, categoryId) {
            axios.get(`${apiUrl}/delete_category_data/`+categoryId)
            .then((res) => { 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                // router.push({ name: 'ClientList' });     
            })
            .catch(err => console.log(err));
        },
    
    // ------------Categoty-------------



    // ------------Skills-------------

    
        // api for add new skills 
        addNewSkillData(store, skillsdata) {
            axios.post(`${apiUrl}/add_new_skills`, skillsdata)
            .then((res) => {       
                router.push({ name: 'SkillsList' }); 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });        
            })
            .catch(err => console.log(err));
        },

        getSkillDataFromApi(store) {
            axios.get(`${apiUrl}/get_skills_list`)
            .then((res) => {
                store.commit('skillsData', res.data.skills);      
            })
            .catch(err => console.log(err));
        },

        // api for get individual skills data 
        getIndividualSkillsData(store, skillsData) {
            axios.get(`${apiUrl}/get_individual_skills_data/`+skillsData)
            .then((res) => {    
                // console.log(res.data.skills_data)   
                store.commit('individualskillsData', res.data.skills);      
            })
            .catch(err => console.log(err));
        },

        updateSkillsData(store, skillsData) {
            axios.post(`${apiUrl}/update_skills_data`, skillsData)
            .then((res) => {       
                console.log(res);
                store.commit('individualskillsData',  res.data.skills);    
                router.push({ name: 'SkillsList' }); 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{ console.log(err)});
        },

        // api for get individual skills data 
        deleteSkillsData(store, skillsId) {
            axios.get(`${apiUrl}/delete_skills_data/`+skillsId)
            .then((res) => { 
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                // router.push({ name: 'ClientList' });     
            })
            .catch(err => console.log(err));
        },


    // ------------Skills-------------



    // ------------Employee-------------

    
        // get skills and category for employee    
        getSkillsAndCategory(store) {
            axios.get(`${apiUrl}/get_emp_cat_and_skills`)
            .then((res) => {       
                console.log(res);
                store.commit('allSkillsList',  res.data.skills_data);
                store.commit('allCategoryList',  res.data.category_data);    
            })
            .catch(err => console.log(err));
        },    

        // api for add new employee 
        addNewEmployeeData(store, employeedata) {
            axios.post(`${apiUrl}/add_new_employee`, employeedata)
            .then((res) => {       
                router.push({ name: 'EmployeeList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });        
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },

        // api for get all of the employee list 
        getEmployeeDataFromApi(store) {
            axios.get(`${apiUrl}/get_employee_list`)
            .then((res) => {
                console.log(res.data.skillsData)
                store.commit('employeeData', res.data.employee_data); 
                store.commit('employeesSkillsData', res.data.skillsData);      
            })
            .catch(err => console.log(err));
        },

        // api for get individual employee data 
        getIndividualEmployeeData(store, employeeData) {
            axios.get(`${apiUrl}/get_individual_employee_data/`+employeeData)
            .then((res) => {    
                // console.log(res.data)   
                store.commit('individualemployeeData', res.data.employee_data);  
                store.commit('individualempSkillsData', res.data.skillsData);         
            })
            .catch(err => console.log(err));
        },

        updateEmployeeData(store, employeeData) {
            axios.post(`${apiUrl}/update_employee_data`, employeeData)
            .then((res) => {       
                console.log(res);
                store.commit('individualemployeeData',  res.data.employee_data);    
                router.push({ name: 'EmployeeList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })
            });
        },
        
        // api for get individual employee data 
        deleteEmployeeData(store, employeeId) {
            axios.get(`${apiUrl}/delete_employee_data/`+employeeId)
            .then((res) => { 

                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                // router.push({ name: 'ClientList' });     
            })
            .catch(err => console.log(err));
        },

        downloadTheCV({ commit }, cvFileName) {
            // console.log('Entering downloadCV');
            axios.get(`${apiUrl}/download-cv/` + cvFileName, { responseType: 'blob' })
                .then((res) => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(res.data);
                    link.download = cvFileName;

                    // console.log(cvFileName)
        
                   // Append the link to the document
                    document.body.appendChild(link);
        
                    // Trigger the click
                    link.click();
        
                    // Remove the link from the document
                    document.body.removeChild(link);
                })
                .catch(err => {
                    console.error('Error downloading CV:', err);
                });
        }, 

    // ------------Employee-------------   



    // ------------Project-------------   

        // api for get all clients list for create project
        getClientListForcreateProject(store) {
            axios.get(`${apiUrl}/get_all_client_list`)
            .then((res) => {
                console.log(res.data)
                store.commit('clientListForProject', res.data.client_data);      
            })
            .catch(err => console.log(err));
        },

        // api for get all of the employee list with their skills and category 
        getEmployeeWithCatAndSkillsFromApi(store) {
            axios.get(`${apiUrl}/get_emp_with_cat_and_skill`)
            .then((res) => {
                console.log(res.data)
                store.commit('empDataWithCatAndSkill', res.data.data);      
            })
            .catch(err => console.log(err));
        },
        
        // api for add a new project
        addProject(store, projectdata) {
            axios.post(`${apiUrl}/add_new_project`, projectdata)
            .then((res) => {      
                console.log(res.data) 
                router.push({ name: 'ProjectList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });        
            })
            .catch(err => console.log(err));
        },

        // api for add project to draft
        addDraftProject(store, projectdata) {
            axios.post(`${apiUrl}/add_new_draft_project`, projectdata)
            .then((res) => {      
                console.log(res.data) 
                store.commit('draftId', res.data.draft_id);
                store.commit('draftFile', res.data.files);
                // router.push({ name: 'ProjectList' });
                // $toast.success(res.data.message , {
                //     // optional options Object
                //     position: 'bottom-right',
                //     duration: 4000,
                // });        
            })
            .catch(err => console.log(err));
        },

        // api for get all Project list 
        getProjectList(store) {
            axios.get(`${apiUrl}/get_all_project_list`)
            .then((res) => {
                console.log(res.data)
                store.commit('projectData', res.data.project_data);      
            })
            .catch(err => console.log(err));
        },

        // api for get individual Project data 
        getIndividualProjectData(store, clientid) {
            axios.get(`${apiUrl}/get_individual_client_project/`+clientid)
            .then((res) => {    
                console.log(res.data.project_data)   
                store.commit('individualprojectData', res.data.project_data);  
                // store.commit('individualempSkillsData', res.data.skillsData);         
            })
            .catch(err => console.log(err));
        },

        updateProjectData(store, ProjectData) {
            axios.post(`${apiUrl}/update_project_data`, ProjectData)
            .then((res) => {       
                console.log(res);
                store.commit('individualProjectData',  res.data.project_data);    
                router.push({ name: 'ProjectList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{ console.log(err)});
        },

        updateProjectAssignEmployee(store, ProjectData) {
            axios.post(`${apiUrl}/update_project_assign_emp`, ProjectData)
            .then((res) => {       
                console.log(res);
                // store.commit('individualProjectData',  res.data.project_data);    
                router.push({ name: 'ProjectList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });                                  
            })
            .catch(err =>{ console.log(err)});
        },

        addProjectcomments(store, comments) {
            axios.post(`${apiUrl}/postcomment`, comments)
            .then((res) => {                
                $toast.success(res.data.message , {
                    position: 'bottom-right',
                    duration: 4000,
                });                        
            })
            .catch(err =>{          
                // tost popup for error message  
                $toast.error(err.response.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                })    
                console.log('res')  
            });
        },
    
    
        getProjectcomment(store, querystring) {
            axios.get(`${apiUrl}/getcommentslist`, { params: { page: querystring.page, no_of_item: querystring.no_of_item,projectid:querystring.projectid } })
            .then((res) => {       
                console.log('Projects Comments',res.data);
                store.commit('commentsData', res.data.comments);
            })
            .catch(err => console.log(err));
        },

        // api for get individual employee data 
        deleteProjectFromDraft(store, id) {
            axios.get(`${apiUrl}/delete_project_data/`+id)
            .then((res) => { 
                router.push({ name: 'ProjectList' });     
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                // router.push({ name: 'AddProject' });     
            })
            .catch(err => console.log(err));
        },

        deleteDraftFile(store, ProjectData) {
            axios.post(`${apiUrl}/delete_project_files`, ProjectData)
            .then((res) => {       
                console.log(res);
                // store.commit('individualProjectData',  res.data.project_data);    
                // router.push({ name: 'ProjectList' });
                $toast.success(res.data.message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });      
                            
            })
            .catch(err =>{ console.log(err)});
        },
   
    // ------------Project-------------   


    DashboardDataApi(store) {
        axios.get(`${apiUrl}/get_dashboard_data`)
        .then((res) => {       
            console.log(res.data);    
            store.commit('dashboardData', res.data);    
        })
        .catch(err => console.log(err));
    },
}

export default actions;