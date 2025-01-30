<template>
    <div class="dashboard_box">
        <div class="page_name">
            <h3>Dashboard</h3>
        </div>
        <div class="row boxes">
            <div class="col-4" v-if="allData.total_project">
                <div class="number_box">
                    <div class="left">
                        <h4>Total Open Projects</h4>
                        <h5 >{{allData.total_project}}</h5>
                    </div>
                    <div class="right">
                        <img src="@/assets/images/project-gif.gif" alt="">
                    </div>
                </div>
            </div>
            <div class="col-4" v-if="allData.refarrel_data">
                <div class="number_box">
                    <div class="left">
                        <h4>Referral Code</h4>
                        <h5 >{{allData.refarrel_data.refarralcode}}</h5>
                    </div>
                    <div class="right">
                        <img src="@/assets/images/client-gif.gif" alt="">
                    </div>
                </div>
            </div>
            <div class="col-4" v-if="allData.refarrel_data">
                <div class="number_box">
                    <div class="left">
                        <h4>Total Referral Points</h4>
                        <h5>{{allData.refarrel_data.refarralpoints}}</h5>
                    </div>
                    <div class="right">
                        <img src="@/assets/images/employe-gif.gif" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard_border">
            <div class="table_name">
                <div class="name">
                    <h3>Latest Projects</h3>
                </div>
                <div class="btns" >
                    <router-link :to="projectLink">
                        View More
                    </router-link>
                </div>
            </div>
            <div class="tableone">
                <table>
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Project Description</th>
                            <th>Posted Date</th>
                            <th>Status</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in allData.latest_project" :key="index">
                            <td>
                                <h3>
                                    {{ data.projecttitle }}
                                </h3>
                            </td>
                            <td>
                                <h3 v-html="data.projectdescription">
                                   
                                </h3>
                            </td>
                            <td>
                                {{moment(data.created_at).format("MM-DD-YYYY")}} 
                            </td>
                            <td>
                                {{ data.status == 1 ? 'Open' : data.status == 0 ? 'Pending' : 'Closed' }}
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import '@/assets/css/Dashboard/dashboard.css'
import '@/assets/css/table/table.css'
import { mapActions, mapState } from 'vuex';
import moment from "moment";
export default {
    name: 'DashboardIndex',
    data() {
        return {
           allData:'',
           moment:moment,
           projectLink : '',
        };
    },


    computed: {
        ...mapState('userDataModule', ['dashboardData'])
    },

    mounted() {
        
        this.DashboardDataApi();   
        console.log( localStorage.getItem('LOGEDUSERTYPE'))      
        if( localStorage.getItem('LOGEDUSERTYPE') == '2'){
            this.projectLink = '/submit-project-list'
        }
        if(localStorage.getItem('LOGEDUSERTYPE') == '3'){
            this.projectLink= '/employee-project-list'
        }    
    },   

    methods: {
        ...mapActions('userDataModule', ['DashboardDataApi']),      
    },

    watch:{
        dashboardData(){            
            this.allData=this.dashboardData;
           
        },
    }
};


</script>