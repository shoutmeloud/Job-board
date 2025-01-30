<template>
    <div class="container-fluid">
        <div class="row">
            <Leftside />
            <div class="right_side">
                <Header />
                <div class="main_div">
                    <div class="client_box">
                        <div class="page_name">
                            <h3>Client Worksheet</h3>
                        </div>
                        <div class="client_height tableone">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>                                       
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Country</th>
                                        <th>Referral Points</th>
                                        <th>Transaction Details</th>
                                        <th>Action</th>
                                        <th>One Click</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr :key="allclientData.id" v-for="allclientData in clientData">
                                        <td>
                                            {{ allclientData.user.firstname+' '+allclientData.user.lastname  }}
                                        </td>
                                      
                                        <td>
                                            {{ allclientData.user.email }}
                                        </td>
                                        <td>
                                            {{ allclientData.user.phone }}
                                        </td>

                                        <td>
                                            {{ allclientData.country }}
                                        </td>
                                        <td>
                                            {{ allclientData.refarralpoints }}
                                        </td>
                                        <td>
                                           <button class="modal_button" @click="setUserRefarralData(allclientData.refarralpoints, allclientData.refarralcode, allclientData.user_id); toggleClass(); getRefarralHistory(allclientData.user_id);">View Transaction</button>
                                        </td> 
                                        <td>
                                            <div class="td_flex d-flex align-items-center">
                                                <!-- view icon -->
                                                <router-link :to="'/view-client/'+allclientData.id">
                                                    <svg enable-background="new 0 0 32 32" height="20px" id="svg2" version="1.1" viewBox="0 0 32 32" fill="#21232c" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><g id="background"><rect fill="none" height="32" width="32"></rect></g><g id="view"><circle cx="16" cy="16" r="6"></circle><path d="M16,6C6,6,0,15.938,0,15.938S6,26,16,26s16-10,16-10S26,6,16,6z M16,24c-8.75,0-13.5-8-13.5-8S7.25,8,16,8s13.5,8,13.5,8   S24.75,24,16,24z"></path></g></svg>
                                                </router-link>
                                                <!-- edit icon -->
                                                <router-link :to="'/edit-client/'+allclientData.id">
                                                    <svg enable-background="new 0 0 48 48" height="20px" fill="#21232c" id="Layer_1" version="1.1" viewBox="0 0 48 48" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="M44.929,14.391c-0.046,0.099-0.102,0.194-0.183,0.276L16.84,42.572  c-0.109,0.188-0.26,0.352-0.475,0.434l-13.852,3.88c-0.029,0.014-0.062,0.016-0.094,0.026l-0.047,0.014  c-0.008,0.003-0.017,0.001-0.024,0.004c-0.094,0.025-0.187,0.046-0.286,0.045c-0.098,0.003-0.189-0.015-0.282-0.041  c-0.021-0.006-0.04-0.002-0.061-0.009c-0.008-0.003-0.013-0.01-0.021-0.013c-0.088-0.033-0.164-0.083-0.24-0.141  c-0.039-0.028-0.08-0.053-0.113-0.086s-0.058-0.074-0.086-0.113c-0.058-0.075-0.107-0.152-0.141-0.24  c-0.004-0.008-0.01-0.013-0.013-0.021c-0.007-0.02-0.003-0.04-0.009-0.061c-0.025-0.092-0.043-0.184-0.041-0.281  c0-0.1,0.02-0.193,0.045-0.287c0.004-0.008,0.001-0.016,0.004-0.023l0.014-0.049c0.011-0.03,0.013-0.063,0.026-0.093l3.88-13.852  c0.082-0.216,0.246-0.364,0.434-0.475l27.479-27.48c0.04-0.045,0.087-0.083,0.128-0.127l0.299-0.299  c0.015-0.015,0.034-0.02,0.05-0.034C34.858,1.87,36.796,1,38.953,1C43.397,1,47,4.603,47,9.047  C47,11.108,46.205,12.969,44.929,14.391z M41.15,15.5l-3.619-3.619L13.891,35.522c0.004,0.008,0.014,0.011,0.018,0.019l2.373,4.827  L41.15,15.5z M3.559,44.473l2.785-0.779l-2.006-2.005L3.559,44.473z M4.943,39.53l3.558,3.559l6.12-1.715  c0,0-2.586-5.372-2.59-5.374l-5.374-2.59L4.943,39.53z M12.49,34.124c0.008,0.004,0.011,0.013,0.019,0.018L36.15,10.5l-3.619-3.619  L7.663,31.749L12.49,34.124z M38.922,3c-1.782,0-3.372,0.776-4.489,1.994l-0.007-0.007L33.912,5.5l8.619,8.619l0.527-0.528  l-0.006-0.006c1.209-1.116,1.979-2.701,1.979-4.476C45.031,5.735,42.296,3,38.922,3z" fill-rule="evenodd"></path></svg>
                                                </router-link>
                                                <!-- delete icon -->
                                                <button to="" data-bs-toggle="modal" data-bs-target="#exampleModal"  @click="setSelectedUserId(allclientData.user.id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16px" height="16px" fill="#21232c"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path></svg>
                                                </button>
                                            </div>    
                                        </td>
                                        <td>
                                            <div class="td_flex d-flex align-items-center">
                                                <a :href="'https://jobboard.works-reddensoft.com/'+allclientData.user.id+'/OneClickLogin'" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20px" fill="#21232c"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg>
                                                </a> 
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div :class="{ 'active_class': isClassAdded }" class="modal_div">
                                <div class="modal_width">
                                    <div class="close">
                                        <button @click="toggleClass">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg>
                                        </button>
                                    </div>
                                    <div class="modal_top">
                                        <div class="modal_profile d-flex">
                                            <!-- <div class="image">
                                               <span>BP</span>
                                                <span>
                                                    <img src="../../assets/images/demo-profile.png" alt="">
                                                </span>
                                            </div> -->
                                            <div class="text" v-if="refarralClientData">
                                                <h4>{{refarralClientData[0].user.firstname+' '+refarralClientData[0].user.lastname }}</h4>
                                                <p>{{refarralClientData[0].user.email}}</p>
                                                <p>{{refarralClientData[0].country}} , {{refarralClientData[0].user.phone}}</p>
                                                <p>Total Points : {{refarralClientData[0].refarralpoints}}</p>
                                            </div>
                                        </div>
                                        <div class="modal_add_btn">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                Add / Redeem Point
                                            </button>
                                        </div> 
                                    </div>
                                    <div class="modal_bottom tableone">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Date</th>                                       
                                                    <th>Purpose</th>
                                                    <th>Point</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr :key="allTransactionData.id" v-for="allTransactionData in refarralTransactionData">
                                                    <td>
                                                        {{ formatDate(allTransactionData.created_at) }}
                                                    </td>
                                                    <td>
                                                        {{allTransactionData.note}}
                                                    </td>
                                                    <td>
                                                        {{allTransactionData.refarralpoints}}
                                                    </td>
                                                    <td>
                                                        <div class="td_flex d-flex align-items-center">
                                                            <!-- <router-link to="/">
                                                                Dr
                                                            </router-link> -->
                                                            <li>{{allTransactionData.status}}</li>
                                                            <!-- <router-link to="/">
                                                                Cr
                                                            </router-link> -->
                                                        </div>    
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div :class="{ 'modal_background': isClassAdded }" @click="toggleClass"></div>
                        </div>
                        <!-- <div class="all_paginaton">
                            <ul class="d-flex justify-content-end">
                                <li>
                                    <a>Prev</a>
                                </li>
                                <li class="active">
                                    <a>1</a>
                                </li>
                                <li>
                                    <a>2</a>
                                </li>
                                <li>
                                    <a>3</a>
                                </li>
                                <li>
                                    <a>Next</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade add_redeem_div add_client_delete" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Box</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="deleteClient">
                    <div class="modal-body">
                        <div class="input_box">
                            <div class="label_div">
                                <label>Confirmation <span class="symbol_red">*</span></label>
                            </div>
                            <div class="input_div">
                                <input type="text" placeholder="Please Enter 'delete' as keyword" v-model="deleteValue" required/>  
                            </div>
                        </div>            
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closebutton" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    
        <div class="modal fade add_redeem_div" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Redeem Point</h5>
                        <button type="button" id="rpointclosebutton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="refarral_frm" @submit.prevent="addOrRedeemPoint">
                        <div class="modal-body">
                            <div class="input_box">
                                <div class="label_div">
                                    <label>Referral Status <span class="symbol_red">*</span></label>
                                </div>
                                <div class="input_div">
                                    <select name="status" id="status" v-model="refarralDataArr.status" required>
                                        <option value="">Select Referral Type</option>
                                        <option value="cr">Add</option>
                                        <option value="dr">Redeem</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input_box">
                                <div class="label_div">
                                    <label>Point <span class="symbol_red">*</span></label>
                                </div>
                                <div class="input_div">
                                    <input type="number" placeholder="Enter Referral Point" id="refarralpoints" v-model="refarralDataArr.refarralpoints" required />
                                </div>
                            </div>
                            <div class="input_box">
                                <div class="label_div">
                                    <label>Note <span class="symbol_red">*</span></label>
                                </div>
                                <div class="input_div">
                                    <textarea placeholder="Enter Referral Note" id="note" v-model="refarralDataArr.note" required></textarea>
                                </div>
                            </div>
                            <div class="input_box">
                                <div class="label_div">
                                </div>
                                <div class="input_div">
                                    <div class="sumit_btns">
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import '@/assets/css/table/table.css'
import '@/assets/css/client/client.css'
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState } from 'vuex';
import {useToast} from 'vue-toast-notification';
import moment from 'moment';
    export default {
    name: 'ClientList',

    components: {
        Header,
        Leftside
    },

    data() {
        return {
            //    clientData: '',
            selectedUserId:  '',
            deleteValue: '',
            isClassAdded: false,
            
            refarralDataArr: {
                status: '',
                refarralpoints: '',
                note: '',
                selectedUserRefarralPoint: '',
                selectedUserRefarralcode: '',
                clientId: '',
            },
        };
    },

    computed: {
        ...mapState('userDataModule', ['clientData', 'refarralTransactionData', 'refarralClientData'])
    },

    methods: {
        ...mapActions('userDataModule', ['getClientDataFromApi', 'deleteClientData', 'addClientRefarralPoint', 'getRefarralPointHistory']),      

        toggleClass() {
            this.isClassAdded = !this.isClassAdded;
        },

        // set a specific client id
        setSelectedUserId(userId) {
            this.selectedUserId = userId;
            console.log(this.selectedUserId)
        },

        // set a specific client refarral data
        setUserRefarralData(userRefarralPoint, refarralcode, clientId){
            this.refarralDataArr.selectedUserRefarralPoint = userRefarralPoint;
            this.refarralDataArr.selectedUserRefarralcode = refarralcode;
            this.refarralDataArr.clientId = clientId;
            // console.log(this.selectedUserRefarralPoint)
        },

        // get a specific client refarral transaction history
        getRefarralHistory(clientId){
            this.getRefarralPointHistory(clientId);
        },

        // function for delete client data
        deleteClient(){
            // this.selectedUserId = userId;
            const delValue = this.deleteValue.toLowerCase();
            if(delValue === 'delete' && delValue != ''){
                this.deleteClientData(this.selectedUserId);
                document.getElementById("closebutton").click();
                this.getClientDataFromApi();
            }else{
                const $toast = useToast(); 
                const message = "Please Enter 'delete' Keyword to procced."
                document.getElementById("closebutton").click();
                $toast.success(message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });    
                
            }
            console.log(delValue);
        },

        // add and Redeem points
        addOrRedeemPoint(){       
            // console.log('1', this.refarralDataArr.refarralpoints)   
            // console.log('2', this.refarralDataArr.selectedUserRefarralPoint)    
            if(this.refarralDataArr.refarralpoints > this.refarralDataArr.selectedUserRefarralPoint && this.refarralDataArr.status === 'dr'){
                 console.log('1', this.refarralDataArr.refarralpoints)   
            console.log('2', this.refarralDataArr.selectedUserRefarralPoint)    
                const $toast = useToast(); 
                const message = "Insufficient Refarral Balance, Please Enter A Valid Number";
                // document.getElementById("closebutton").click();
                $toast.success(message , {
                    // optional options Object
                    position: 'bottom-right',
                    duration: 4000,
                });     
            }else{
                console.log('ok')
                this.addClientRefarralPoint(this.refarralDataArr);    
                // document.getElementById('refarral_frm').reset();               
                document.getElementById("rpointclosebutton").click();
                this.getClientDataFromApi(); 
                this.getRefarralPointHistory(this.refarralDataArr.clientId);

                this.refarralDataArr.status = '';
                this.refarralDataArr.refarralpoints = '';
                this.refarralDataArr.note = '';
                this.refarralDataArr.selectedUserRefarralPoint = '';
                this.refarralDataArr.selectedUserRefarralcode = '';
                this.refarralDataArr.clientId = '';
            }
        },

        // Format date using dateformat
        formatDate(date) {
           return moment(date).format('MM/DD/YY');
        },
    },

    created() {
       this.getClientDataFromApi();
       console.log(this.clientData);
    },

};
</script>