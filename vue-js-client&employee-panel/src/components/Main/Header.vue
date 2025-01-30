<template>
    <div class="heading">
        <div class="left">
            <div class="title">
                <div v-if="this.profilename">              
                    <router-link to="/edit-profile" class="iamge_box" v-if="this.profilename.usertype==3">
                        <img src="@/assets/images/client1.jpg" alt="" >
                    </router-link>
                </div>  
                <div class="image_name">
                    <p>Welcome..</p>
                    <h2 v-if="this.profilename">{{this.profilename.firstname}} {{this.profilename.lastname}}</h2>
                </div>
            </div>
        </div>

        <div class="right" v-if="this.profilename">
            <!-- {{this.profilename.usertype}} -->
            <div v-if="this.profilename.usertype == 2">
                <div class="image" v-if="inviteData">
                    <ul>
                        <li data-bs-toggle="modal" data-bs-target="#exampleModal12" v-for="(data, index) in inviteData.transaction_data" :key="index" :v-if="index < 4" >
                            <span data-bs-toggle="tooltip" data-bs-placement="top" :title="data.user.firstname+' '+data.user.lastname" ref="info" data-bs-custom-class="tooltipnew">{{data.user.firstname[0]}}{{data.user.lastname[0]}}</span>
                        </li>
                    
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal12" v-if="inviteData && inviteData.count > 4">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="More" ref="info" data-bs-custom-class="tooltipnew" >{{inviteData.count-4}}+</span>
                        </button>
                    </ul>
                </div>
                <div class="invite">
                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        +
                        Invite
                    </button>
                </div>            
            </div>

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


        <div class="modal referral_modal number_modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if="this.profilename.usertype == 2"> 
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Referral List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="model_height tableone">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email Id</th>
                                        <th>Date of Registration</th>
                                        <th>Referral Points</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <!-- {{inviteData.transaction_data}} -->
                                <tbody v-if="inviteData">
                                    <tr v-for="(data, index) in inviteData.transaction_data" :key="index">
                                        <td>
                                            <span class="name"> {{data.user.firstname[0]}}{{data.user.lastname[0]}}</span>
                                        </td>
                                        <td>
                                        {{data.user.firstname+' '+data.user.lastname}}
                                        </td>
                                        <td>
                                            {{data.user.email}}
                                        </td>
                                        <td>
                                            {{ formatDate(data.created_at)}}
                                        </td>
                                        <td>
                                            {{data.refarralpoints}}
                                        </td>
                                        <td>
                                            <span class="td_option green">
                                            {{data.status}}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal referral_modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" v-if="this.profilename.usertype == 2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Referral Share</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" v-if="allData">
                <div class="input_box" v-if="allData.client">
                    <label>Referral Link :</label>
                    <input type="text" placeholder="" id="refarrallink" :value="baseurl+'register/?referralcode='+allData.client.refarralcode" readonly/>
                    <button class="copy_btn" @click="copyUrl" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Copy" ref="info" data-bs-custom-class="tooltipnew">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21,8H9A1,1,0,0,0,8,9V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V9A1,1,0,0,0,21,8ZM20,20H10V10H20ZM6,15a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V3A1,1,0,0,1,3,2H15a1,1,0,0,1,1,1V5a1,1,0,0,1-2,0V4H4V14H5A1,1,0,0,1,6,15Z"/></svg>
                    </button>
                </div>
                <div class="input_box" v-if="allData.client">
                    <label>Referral Code :</label>
                    <input type="text" placeholder="" id="refarralcode" :value="allData.client.refarralcode" readonly/>
                    <button class="copy_btn" @click="copyCode" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Copy" ref="info" data-bs-custom-class="tooltipnew">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21,8H9A1,1,0,0,0,8,9V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V9A1,1,0,0,0,21,8ZM20,20H10V10H20ZM6,15a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V3A1,1,0,0,1,3,2H15a1,1,0,0,1,1,1V5a1,1,0,0,1-2,0V4H4V14H5A1,1,0,0,1,6,15Z"/></svg>
                    </button>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Copy Link</button>
            </div> -->
            </div>
        </div>
    </div>


 </div>

</template>

<script>
import '@/assets/css/table/table.css'
import { mapGetters,mapActions } from 'vuex';
import {useToast} from 'vue-toast-notification';
import { Tooltip } from 'bootstrap';
const baseurl=import.meta.env.VITE_VUE_BASE_URL
import moment from 'moment';
export default {
    name: 'App',
    data() {
        return  {
            isClassAdded: false,
            loginData:'',
            baseurl,
            allData:'',
        }

    },
    computed: {
        ...mapGetters('userDataModule', ['userData','inviteData']),
        profilename() {
            return this.userData;
        },       
    },
    methods: {
        ...mapActions('userDataModule', ['getUserdetails','userlogout','getInviteData']),
      
        addClass() {
            this.isClassAdded = !this.isClassAdded;
            var divid = document.querySelector("body");
            divid.classList.toggle('isActive', this.isClassAdded);
            localStorage.setItem('isClassAdded', this.isClassAdded);
        },
        logout(){
            this.userlogout()
        },
        copyUrl(){
            var copyText = document.getElementById("refarrallink");
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            const $toast = useToast(); 
            $toast.success('Referral link copied to clipboard' , {
                position: 'bottom-right',
                duration: 4000,
            }); 
        },
        copyCode(){
            var copyText = document.getElementById("refarralcode");
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            const $toast = useToast(); 
            $toast.success('Referral code copied to clipboard' , {
                position: 'bottom-right',
                duration: 4000,
            }); 
        },
        formatDate(date) {
           return moment(date).format('MM-DD-YYYY');
        },
    },
    mounted() {
        //console.log('header ready for mounted');

        this.isClassAdded = JSON.parse(localStorage.getItem('isClassAdded')) || false;
        var divid = document.querySelector("body");
        divid.classList.toggle('isActive', this.isClassAdded);

        new Tooltip(document.body, {
            selector: "[data-bs-toggle='tooltip']",
        })
    },
    created() {
        this.getUserdetails();        
        this.getInviteData();
        // console.log(this.inviteData)
    },
    watch:{
        userData(){
            this.userData;
            this.allData = this.userData

        },
        inviteData(){
            this.inviteData;
        },

           
       
    }

}
</script>