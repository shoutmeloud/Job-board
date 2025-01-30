import {createWebHistory,createRouter} from "vue-router";
const routes=[
    {
        name: 'Login',
        component: () => import('./pages/Login/Login.vue'),
        path: '/',
        meta: {
            title: 'Login',
            requiresAuth: false
        },
    },

    {
        name: 'OneClickLogin',
        component: () => import('./pages/Index/OneClickLogin.vue'),
        path: '/:id/:slug',
        meta: {
            title: 'OneClickLogin',
            requiresAuth: false
        },
    },

    {
        name: 'Register',
        component: () => import('./pages/Login/Register.vue'),
        path: '/register',
        meta: {
            title: 'Register',
            requiresAuth: false
        },
    },

    {
        name: 'Dashboard',
        component: () => import('./pages/Index/Index.vue'),
        path: '/dashboard',
        meta: {
            title: 'Dashboard',
            requiresAuth: false
        },
    },

    {
        name: 'ForgotPassword',
        component: () => import('./pages/Login/ForgotPass.vue'),
        path: '/forgot-password',
        meta: {
            title: 'Forgot Password',
            requiresAuth: false
        },
    },

    {
        name: 'ResetPassword',
        component: () => import('./pages/Login/ResetPassword.vue'),
        path: '/reset-password',
        meta: {
            title: 'Reset Password',
            requiresAuth: false
        },
    },

    {
        name: 'editprofile',
        component: () => import('./pages/ClientDashboard/editprofile.vue'),
        path: '/edit-profile',
        meta: {
            title: 'editprofile',
            requiresAuth: false
        },
    },

    {
        name: 'changepassword',
        component: () => import('./pages/ClientDashboard/changepassword.vue'),
        path: '/change-password',
        meta: {
            title: 'changepassword',
            requiresAuth: false
        },
    },


    {
        name: 'Projectlist',
        component: () => import('./pages/ClientDashboard/projectlist.vue'),
        path: '/submit-project-list',
        meta: {
            title: 'Projectlist',
            requiresAuth: false
        },
    },

    {
        name: 'ViewProject',
        component: () => import('./pages/projects/ViewProject.vue'),
            path: '/viewproject/:slug',
                meta: {
                title: 'ViewProject',
                requiresAuth: false
                },
    },

    {
        name: 'EditProject',
        component: () => import('./pages/projects/EditProject.vue'),
            path: '/editproject/:slug',
                meta: {
                title: 'EditProject',
                requiresAuth: false
                },
    },

    {
        name: 'postrequirment',
        component: () => import('./pages/ClientDashboard/postrequirment.vue'),
        path: '/post-requirment',
        meta: {
            title: 'postrequirment',
            requiresAuth: false
        },
    },


    {
        name: 'RefarralHistory',
        component: () => import('./pages/ClientDashboard/RefarralHistory.vue'),
        path: '/referral-history',
        meta: {
            title: 'Refarral History',
            requiresAuth: false
        },
    },

    // Employee Route Branch

    {
        name: 'EditEmployeeProfile',
        component: () => import('./pages/EmployeeDashboard/EditEmployeeProfile.vue'),
        path: '/edit-employee-profile',
        meta: {
            title: 'EditEmployeeProfile',
            requiresAuth: false
        },
    },
   
    {
        name: 'EmployeeProjectlist',
        component: () => import('./pages/EmployeeDashboard/EmployeeProjectlist.vue'),
        path: '/employee-project-list',
        meta: {
            title: 'EmployeeProjectlist',
            requiresAuth: false
        },
    },

    {
        name: 'ViewEmployeeProject',
        component: () => import('./pages/EmployeeDashboard/EmployeeProjectView.vue'),
        path: '/view-employee-project/:slug',
        meta: {
            title: 'ViewEmployeeProject',
            requiresAuth: false
        },
    },
    
]

const router = createRouter({
    history: createWebHistory(),
	routes,
    scrollBehavior() {
        document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
    },
});

router.beforeEach((to, from, next) => {  

    if (to.params.slug=='OneClickLogin') {
        next();  
    }
    // else if(localStorage.getItem('authToken')==null && to.name == 'OneClickLogin'){
    //     next();  
    // }
    else if(localStorage.getItem('authToken')==null && to.name != 'Login' && to.name != 'Register'){
        next({path: 'Login' });   
    }
    else{
        next();             
    }
        
});



export default router;


