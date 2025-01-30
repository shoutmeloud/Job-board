<template>
    <div class="heading">
        <div class="left">
            <div class="title">
                <p>Welcome..</p>
                <h2 v-if="this.profilename">{{this.profilename.firstname}} {{this.profilename.lastname}}</h2>
            </div>
        </div>
        <div class="right">          
            <div class="mode d-flex align-items-center">
                <label for="abc" @click="addClass" :class="{ 'toggleActive': isClassAdded }">
                    <div class='toggle-slot'>
                        <div class='sun-icon-wrapper'>
                            <div class="iconify sun-icon" data-icon="feather-sun" data-inline="false">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" fill="#2c65e8" r="5" class="fill-2c65e8">
                                    </circle>
                                    <path
                                        d="M21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2ZM4 13H3a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2ZM17.66 7.34a1 1 0 0 1-.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1-.75.29ZM5.64 19.36a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1-.7.24ZM12 5a1 1 0 0 1-1-1V3a1 1 0 0 1 2 0v1a1 1 0 0 1-1 1ZM12 22a1 1 0 0 1-1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1-1 1ZM6.34 7.34a1 1 0 0 1-.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1-.71.29ZM18.36 19.36a1 1 0 0 1-.7-.29l-.66-.71A1 1 0 0 1 18.36 17l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1-.71.24Z"
                                        fill="#2c65e8" class="fill-2c65e8"></path>
                                </svg>
                            </div>
                        </div>
                        <div class='toggle-button'></div>
                        <div class='moon-icon-wrapper'>
                            <div class="iconify moon-icon" data-icon="feather-moon" data-inline="false">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.21 15.32A8.56 8.56 0 1 1 11.29 3.5a.5.5 0 0 1 .51.28.49.49 0 0 1-.09.57A6.46 6.46 0 0 0 9.8 9a6.57 6.57 0 0 0 9.71 5.72.52.52 0 0 1 .58.07.52.52 0 0 1 .12.53Z"
                                        fill="#adadad" class="fill-464646"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
            <div class="log_out">
                <button @click="logout">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 40" x="0px" y="0px"><g data-name="Layer 2"><path d="M23.483,8.74a1.93,1.93,0,0,0-2.648,2.809l2.379,2.244H11.934a1.93,1.93,0,0,0,0,3.859h11.28L20.835,19.9a1.93,1.93,0,0,0,2.65,2.807L29.4,17.123a1.933,1.933,0,0,0,0-2.805Z"/><path d="M14.557,25.879H5.844V5.566h8.713a1.929,1.929,0,1,0,0-3.858H3.914a1.932,1.932,0,0,0-1.93,1.93v24.17a1.932,1.932,0,0,0,1.93,1.929H14.557a1.929,1.929,0,1,0,0-3.858Z"/></g></svg>
                    </span>
                    Log Out
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters,mapActions } from 'vuex';
export default {
    name: 'App',
    data() {
        return  {
            isClassAdded: false,
            loginData:'',
        }
    },
    computed: {
        ...mapGetters('userDataModule', ['userData']),
        profilename() {
            return this.userData;
        },
       
    },
    methods: {
        ...mapActions('userDataModule', ['getUserdetails','userlogout']),
        // addClass() {
        //     this.isClassAdded = !this.isClassAdded;
        //     var divid = document.querySelector (".dashboard");
        //     if (divid.classList.contains('isActive')) {
        //         divid.classList.remove('isActive')
        //     }else{
        //         divid.classList.add('isActive')
        //     }           
        // },
        addClass() {
            this.isClassAdded = !this.isClassAdded;
            var divid = document.querySelector("body");
            divid.classList.toggle('isActive', this.isClassAdded);
            localStorage.setItem('isClassAdded', this.isClassAdded);
        },
        logout(){
            
            this.userlogout()
        }
    },
    mounted() {
        console.log('header ready for mounted');
        this.isClassAdded = JSON.parse(localStorage.getItem('isClassAdded')) || false;
        var divid = document.querySelector("body");
        divid.classList.toggle('isActive', this.isClassAdded);
    },
    created() {
        this.getUserdetails();
    }
}
</script>