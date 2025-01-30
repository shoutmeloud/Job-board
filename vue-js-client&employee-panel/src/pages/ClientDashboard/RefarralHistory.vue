<template>
    <div class="container-fluid">
        <div class="row">
            <Leftside />
            <div class="right_side">
                <Header />
                <div class="main_div">
                    <div class="client_box">
                        <div class="page_name">
                            <h3>Referral Transaction History</h3>
                        </div>
                        <div class="client_height tableone">
                           
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
                                            <span class="td_option" :class="allTransactionData.status == 'cr' ? 'green' : 'red' " > {{allTransactionData.status}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
      
    </div>
</template>

<script>
import '@/assets/css/table/table.css'
import '@/assets/css/client/client.css'
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState} from 'vuex';
import moment from 'moment';
    export default {
    name: 'ClientList',

    components: {
        Header,
        Leftside
    },

    data() {
        return {
            // clientData: '',
            selectedUserId:  '',
            deleteValue: '',
            isClassAdded: false,            
            currentUserId:'',
        };
    },

    computed: {
        // ...mapGetters('userDataModule', ['userData']),
        ...mapState('userDataModule', ['userData','refarralTransactionData'])
    },

    methods: {
        ...mapActions('userDataModule', ['getRefarralPointHistory']),      

        toggleClass() {
            this.isClassAdded = !this.isClassAdded;
        },

        // set a specific client id
        // setUserId() {
        //    this.currentUserId = this.userData.id;
        // },

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
     
        // Format date using dateformat
        formatDate(date) {
           return moment(date).format('MM/DD/YY');
        },
    },

    // created() {
    //     // this.setUserId();
    //     // this.currentUserId = this.userData.id;
    //     // this.getRefarralPointHistory(this.userData.id);
    //     // console.log('mount', this.userData.client.id);
    // },

    // created() {
    //     this.setUserId();
    // },

    watch:{
        userData(){
            // this.currentUserId = this.userData.id;
            // this.getRefarralPointHistory(this.userData.client.id);
            
            console.log('watch', this.userData.client.user_id);
            this.getRefarralPointHistory(this.userData.client.user_id);
        }
    },

};
</script>
