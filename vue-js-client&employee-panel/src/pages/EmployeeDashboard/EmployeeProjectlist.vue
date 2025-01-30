<template>
    <div class="container-fluid">
        <div class="row">
            <ClientLeftside />
            <div class="right_side">
                <Header/>
                <div class="main_div">
                    <div class="client_box">
                        <div class="page_name">
                            <h3>Project List</h3>
                        </div>
                        <div class="client_height tableone">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Project Description</th>
                                        <th>Posted Date</th>
                                        <!-- <th>Selected Employee</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="projectlista">
                                    <tr v-for="(user, index) in projectlista.data" :key="index">
                                        <td> 
                                            <h3>
                                                {{user.projecttitle}}
                                            </h3>
                                        </td>
                                        <td>
                                            <h3 v-html="user.projectdescription"></h3>
                                        </td>
                                        <td>{{ formatDate(user.created_at) }} </td>
                                
                                        <td>
                                            <span class="td_option" :class="user.status==0 ? 'yellow' : user.status==1 ? 'green' : user.status==2 ? 'red' : 'gray'">
                                                {{this.status[user.status]}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="td_flex d-flex align-items-center">
                                                <router-link :to="{name:'ViewEmployeeProject', params: { slug: user.id } }">
                                                    <span>
                                                        <svg enable-background="new 0 0 32 32" height="20px" id="svg2" version="1.1" viewBox="0 0 32 32" fill="#21232c" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><g id="background"><rect fill="none" height="32" width="32"></rect></g><g id="view"><circle cx="16" cy="16" r="6"></circle><path d="M16,6C6,6,0,15.938,0,15.938S6,26,16,26s16-10,16-10S26,6,16,6z M16,24c-8.75,0-13.5-8-13.5-8S7.25,8,16,8s13.5,8,13.5,8   S24.75,24,16,24z"></path></g></svg>
                                                    </span> 
                                                </router-link>                                               
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="all_paginaton" v-if="projectlista && projectlista.data.length > 0">
                            <paginate
                            :page-count=total_no_page
                            :page-range="3"
                            :margin-pages="2"
                            :click-handler="clickCallback"
                            :prev-text="'Prev'"
                            :next-text="'Next'"
                            :container-class="'pagination d-flex justify-content-end'"
                            :page-class="'page-item'">
                            </paginate>                           
                        </div>
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
import ClientLeftside from '@/components/Main/Leftside.vue';
import Paginate from "vuejs-paginate-next";
import {mapActions,mapGetters} from 'vuex';
import moment from 'moment';
    export default {
    name: 'EmployeeProjectList',

    components: {
        Header,
        ClientLeftside,
        paginate: Paginate,
    },

    data() {
        return {   
            page:1,
            total:0,
            show_items:10,
            total_no_page:1,
            params:{
                page: 1, 
                no_of_item:10
            },
            moment,
            status:{
                0: 'Pending',
                1: 'Open',
                2: 'Closed',
                3: 'Draft'
            }
        };
    },
    methods: {
        ...mapActions('projectsDataModule', ['getEmpProjectsList']),
        clickCallback(currentpage){
            this.params.page=currentpage;
            this.getProjectsList(this.params)
        },
        // Format date using dateformat
        formatDate(date) {
           return moment(date).format('MM-DD-YYYY');
        },
    },

    created() {
        this.getEmpProjectsList(this.params)
    },
    mounted(){
        console.log('User List',this.EmpProjectData);
    },

    computed: {
        ...mapGetters('projectsDataModule', ['EmpProjectData']),

        projectlista(){
            return this.EmpProjectData
        },
        total_no_page(){
             return this.EmpProjectData.last_page
        },

    },
};
</script>