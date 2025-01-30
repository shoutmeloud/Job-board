import axios from 'axios';
import {useToast} from 'vue-toast-notification';
import router from '@/routes';
const apiUrl = import.meta.env.VITE_VUE_APP_APIURL; 
const $toast = useToast(); 
const validAuthToken = localStorage.getItem('authToken');
const actions = {
    // api for get the authtoken and login user details   
    getLoginDetailsFromApi(store, loginData) {
        axios.post(`${apiUrl}/login`, loginData)
        .then((res) => {                       
            console.log(res.data)
            localStorage.setItem('authToken', res.data.authorization.token);
            localStorage.setItem('LOGEDUSERTYPE', res.data.authorization.usertype);
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
            $toast.error(err.response.data.message , {
                position: 'bottom-right',
                duration: 4000,
            })
        });
    },

    // api for get the authtoken and login user details   
    oneClickLogin(store, loginData) {
        axios.get(`${apiUrl}/one_click_login/`+loginData)
        .then((res) => {                       
            console.log(res.data)
            localStorage.setItem('authToken', res.data.authorization.token);
            localStorage.setItem('LOGEDUSERTYPE', res.data.authorization.usertype);
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
            $toast.error(err.response.data.message , {
                position: 'bottom-right',
                duration: 4000,
            })
        });
    },


    // check forgot password email is valid or not? if yes then sent a mail through the backend api 
    forgotPassword(sotre, userData) {
        axios.post(`${apiUrl}/forgot_password`, userData)
        .then((res) => {       
            //console.log(res);        
            router.push({ name: res.data.reset_link, query: { email: res.data.email, token: res.data.token } });  
        })
        .catch(err =>{ console.log(err)});
    },

    // api for reset the possword 
    resetPasswordApi(sotre, userData) {
        axios.post(`${apiUrl}/reset_password`, userData)
        .then((res) => {       
            //console.log(res);        
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

    
    // api for get all of the client list 
    getClientDataFromApi() {
        axios.get(`${apiUrl}/get_client_list`)
        .then((res) => {       
            console.log(res);         
        })
        .catch(err => console.log(err));
    },


    getUserdetails(store, userdetails) {
        axios.get(`${apiUrl}/userdetails`, userdetails)
        .then((res) => {       
            //console.log('response user data',res.data);
            store.commit('userData', res.data.userdetails);
        })
        .catch(err => console.log(err));
    },


    userlogout(store, loginData) {
        axios.get(`${apiUrl}/logout?token=`+validAuthToken)
            .then((res) => {
                console.log('res',res)
                localStorage.removeItem('authToken');
                localStorage.removeItem('LOGEDUSERTYPE');
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

    updateuserprofile(store, userdata) {
        axios.post(`${apiUrl}/updateuserdata`, userdata)
        .then((res) => {
            store.commit('userData', res.data.userdetails);         
            // router.push({ name: 'Dashboard' }); 
            $toast.success(res.data.message , {
                position: 'bottom-right',
                duration: 4000,
            });       
        })
        .catch(err =>{  
            $toast.error(err.response.data.message , {
                position: 'bottom-right',
                duration: 4000,
            })
        });
    },

    updateuserprofileimage(store, userdata) {
        axios.post(`${apiUrl}/updateuserimagedata`, userdata)
        .then((res) => {
            store.commit('userData', res.data.userdetails);         
            // router.push({ name: 'Dashboard' }); 
            $toast.success(res.data.message , {
                position: 'bottom-right',
                duration: 4000,
            });       
        })
        .catch(err =>{  
            $toast.error(err.response.data.message , {
                position: 'bottom-right',
                duration: 4000,
            })
        });
    },


    changepassword(store, userdata){
        axios.post(`${apiUrl}/changepassword`, userdata)
        .then((res) => {
            $toast.success(res.data.message , {
                position: 'bottom-right',
                duration: 4000,
            });       
        })
        .catch(err =>{  
            $toast.error(err.response.data.message , {
                position: 'bottom-right',
                duration: 4000,
            })
        });
    },


    getRefarralPointHistory(store, clientid) {
        axios.get(`${apiUrl}/get_refarral_transaction_data/`+clientid)
        .then((res) => {    
            console.log(res.data)   
            store.commit('refarralTransactionData', res.data.transaction_data);      
        })
        .catch(err => console.log(err));
    },
  

    DashboardDataApi(store) {
        axios.get(`${apiUrl}/get_dashboard_data`)
        .then((res) => {       
            console.log(res.data);    
            store.commit('dashboardData', res.data);    
        })
        .catch(err => console.log(err));
    },
    
    // api for add news client 
    registerNewClient(store, clientdata) {
        axios.post(`${apiUrl}/register_new_client`, clientdata)
        .then((res) => {       
            localStorage.setItem('authToken', res.data.authorization.token);
            localStorage.setItem('LOGEDUSERTYPE', res.data.authorization.usertype);
            store.commit('userData', res.data.user);         
            router.push({ name: 'Dashboard' }); 
            $toast.success(res.data.message , {
                // optional options Object
                position: 'bottom-right',
                duration: 4000,
            });   
        })
        .catch(err => console.log(err));
    },


    getInviteData(store) {
        axios.get(`${apiUrl}/get_invite_data`)
        .then((res) => {    
            console.log(res.data)   
            store.commit('inviteData', res.data.alldata);      
        })
        .catch(err => console.log(err));
    },

    getProjectcomment(store, querystring) {
        axios.get(`${apiUrl}/getcommentslist`, { params: { page: querystring.page, no_of_item: querystring.no_of_item,projectid:querystring.projectid } })
        .then((res) => {       
            console.log('Projects Comments',res.data);
            store.commit('commentsData', res.data.comments);
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

}


export default actions;