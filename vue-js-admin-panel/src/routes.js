import {createWebHistory,createRouter} from "vue-router";

const routes = [    
 
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
        name: 'Dashboard',
        component: () => import('./pages/Index/Index.vue'),
        path: '/dashboard',
        meta: {
            title: 'Dashboard',
            requiresAuth: false
        },
    },


    // Start Reset Password Brunch

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

    // End Reset Password Route Brunch


    // Start Setting Route 

        {
            name: 'Settings',
            component: () => import('./pages/Settings/AllSettings.vue'),
            path: '/settings',
            meta: {
                title: 'Settings',
                requiresAuth: false
            },
        },

    // End Setting Route


    // Start Client Route Brunch

        {
            name: 'ClientList',
            component: () => import('./pages/Client/ClientList.vue'),
            path: '/client-list',
            meta: {
                title: 'Client List',
                requiresAuth: false
            },
        },    
        {
            name: 'AddClient',
            component: () => import('./pages/Client/AddClient.vue'),
            path: '/add-client',
            meta: {
                title: 'Add Client',
                requiresAuth: false
            },
        },
        {
            name: 'ClientView',
            component: () => import('./pages/Client/ViewClientDetails.vue'),
            path: '/view-client/:slug',
            meta: {
                title: 'View Client',
                requiresAuth: false
            },
        },
        {
            name: 'ClientEdit',
            component: () => import('./pages/Client/EditClientData.vue'),
            path: '/edit-client/:slug',
            meta: {
                title: 'Edit Client',
                requiresAuth: false
            },
        },

    // End Client Route Brunch


    // Start Category Route Brunch

        {
            name: 'AddCategory',
            component: () => import('./pages/Category/AddCategory.vue'),
            path: '/add-category',
            meta: {
                title: 'Add Category',
                requiresAuth: false
            },
        },

        {
            name: 'CategoryList',
            component: () => import('./pages/Category/CategoryList.vue'),
            path: '/category-list',
            meta: {
                title: 'Category List',
                requiresAuth: false
            },
        },

        {
            name: 'CategoryEdit',
            component: () => import('./pages/Category/EditCategory.vue'),
            path: '/edit-category/:slug',
            meta: {
                title: 'Edit Category',
                requiresAuth: false
            },
        },

    // End Category Route Brunch


    // Start Skills Route Brunch

        {
            name: 'AddSkill',
            component: () => import('./pages/Skills/AddSkills.vue'),
            path: '/add-skill',
            meta: {
                title: 'Add Skill',
                requiresAuth: false
            },
        },
        {
            name: 'SkillsList',
            component: () => import('./pages/Skills/SkillsList.vue'),
            path: '/skills-list',
            meta: {
                title: 'Skills List',
                requiresAuth: false
            },
        },
        {
            name: 'SkillsEdit',
            component: () => import('./pages/Skills/EditSkills.vue'),
            path: '/edit-skills/:slug',
            meta: {
                title: 'Edit Skills',
                requiresAuth: false
            },
        },

    // End Skills Route Brunch ujjha global


    // Start Employee Route Brunch

        {
            name: 'AddEmployee',
            component: () => import('./pages/Employee/AddEmployee.vue'),
            path: '/add-employee',
            meta: {
                title: 'Add Employee',
                requiresAuth: false
            },
        },        
        {
            name: 'EmployeeList',
            component: () => import('./pages/Employee/EmployeeList.vue'),
            path: '/employee-list',
            meta: {
                title: 'Employee List',
                requiresAuth: false
            },
        },        
        {
            name: 'EmployeeView',
            component: () => import('./pages/Employee/ViewEmployeeDetails.vue'),
            path: '/view-employee/:slug',
            meta: {
                title: 'View Employee',
                requiresAuth: false
            },
        },
        {
            name: 'EmployeeEdit',
            component: () => import('./pages/Employee/EditEmployee.vue'),
            path: '/edit-employee/:slug',
            meta: {
                title: 'Edit Employee',
                requiresAuth: false
            },
        },

    // End Employee Route Brunch


    // Start Project Route Brunch

        {
            name: 'AddProject',
            component: () => import('./pages/Projects/AddProject.vue'),
            path: '/add-project',
            meta: {
                title: 'Add Project',
                requiresAuth: false
            },
        },        
        {
            name: 'ProjectList',
            component: () => import('./pages/Projects/ProjectList.vue'),
            path: '/project-list',
            meta: {
                title: 'Project List',
                requiresAuth: false
            },
        },
        {
            name: 'ProjectView',
            component: () => import('./pages/Projects/ViewProject.vue'),
            path: '/view-project/:slug',
            meta: {
                title: 'View Project',
                requiresAuth: false
            },
        },
        {
            name: 'ProjectEdit',
            component: () => import('./pages/Projects/EditProject.vue'),
            path: '/edit-project/:slug',
            meta: {
                title: 'Edit Project',
                requiresAuth: false
            },
        },

    // End Project Route Brunch    
]

const router = createRouter({
    history: createWebHistory(),
    // history:createWebHistory('/admin-backend/'),
	routes,
    scrollBehavior() {
        document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
    },
});

export default router;
