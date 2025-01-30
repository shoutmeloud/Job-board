import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import router from '@/routes'
const apiUrl = import.meta.env.VITE_VUE_APP_APIURL; 
const $toast = useToast(); 
   
const actions = {
    // api for get the authtoken and login user details   
    addProjects(store, projectdata) {
        axios.post(`${apiUrl}/addproject`, projectdata)
        .then((res) => {   
            router.push({ name: 'Projectlist' });                    
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

    getProjectsList(store, querystring) {
        axios.get(`${apiUrl}/clientproject`, { params: { page: querystring.page, no_of_item: querystring.no_of_item } })
        .then((res) => {       
            //console.log('response Client Projects',res.data);
            store.commit('ProjectData', res.data.projectlist);
        })
        .catch(err => console.log(err));
    },

    getProjecthistory(store, querystring){
        axios.get(`${apiUrl}/getprojecthistory`, { params: {id:querystring.id} })
        .then((res) => {       
            //console.log('response Projects Details',res.data);
            store.commit('ProjectDetails', res.data.projectdata);
            store.commit('ProjectemployeDetails', res.data.selectedemployee);
        })
        .catch(err => console.log(err));
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

    updateProjectData(store, ProjectData) {
        axios.post(`${apiUrl}/update_project_data_for_client`, ProjectData)
        .then((res) => {       
            console.log(res);
            // store.commit('ProjectDetails', res.data.projectdata);
            router.push({ name: 'Projectlist' });
            $toast.success(res.data.message , {
                // optional options Object
                position: 'bottom-right',
                duration: 4000,
            });      
                        
        })
        .catch(err =>{ console.log(err)});
    },

    getEmpProjectsList(store, querystring) {
        axios.get(`${apiUrl}/get_employee_project_list`, { params: { page: querystring.page, no_of_item: querystring.no_of_item } })
        .then((res) => {       
            // console.log('response Client Projects',res.data);
            store.commit('EmpProjectData', res.data.emp_project_data);
        })
        .catch(err => console.log(err));
    },

    getEmployeeProjectDetails(store, querystring){
        axios.get(`${apiUrl}/get_employee_project_details`, { params: {id:querystring.id} })
        .then((res) => {       
            console.log('response Projects Details',res.data);
            store.commit('EmpProjectDetails', res.data.projectdata);
        })
        .catch(err => console.log(err));
    },
 
    // api for get individual employee data 
    deleteProjectData(store, projectId) {
        axios.get(`${apiUrl}/delete_project_data/`+projectId)
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

    // deleteProjectFromDraft(store, id) {
    //     axios.get(`${apiUrl}/delete_project_data/`+id)
    //     .then((res) => { 
    //         router.push({ name: 'ProjectList' });     
    //         $toast.success(res.data.message , {
    //             // optional options Object
    //             position: 'bottom-right',
    //             duration: 4000,
    //         });      
    //         // router.push({ name: 'AddProject' });     
    //     })
    //     .catch(err => console.log(err));
    // },

    // api for add project to draft
    addDraftProject(store, projectdata) {
        axios.post(`${apiUrl}/add_new_draft_project`, projectdata)
        .then((res) => {      
            console.log(res.data) 
            store.commit('draftId', res.data.draft_id);
            store.commit('draftFile', res.data.files);
            // router.push({ name: 'projectlist' });
            // $toast.success(res.data.message , {
            //     // optional options Object
            //     position: 'bottom-right',
            //     duration: 4000,
            // });        
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

    // api for delete draft project data 
    deleteProjectFromDraft(store, id) {
        axios.get(`${apiUrl}/delete_project_data/`+id)
        .then((res) => { 
            router.push({ name: 'Projectlist' });     
            $toast.success(res.data.message , {
                // optional options Object
                position: 'bottom-right',
                duration: 4000,
            });      
            // router.push({ name: 'AddProject' });     
        })
        .catch(err => console.log(err));
    },

    
}

export default actions;