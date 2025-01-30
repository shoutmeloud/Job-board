<template>
    <div class="container-fluid">
        <div class="row">
            <Leftside />
            <div class="right_side">
                <Header />
                <div class="main_div">
                    <DashboardIndex />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState } from 'vuex';
import DashboardIndex from '@/pages/Index/DashboardIndex.vue';
export default {
    name: 'Dashboard',
    components: {
        Header,
        Leftside,
        DashboardIndex
    },

    computed: {
        ...mapState('userDataModule', ['clientData'])
    },
    // created() {
    //     const route=useRoute();   
    //     var querydata=this.$route.params.slug;

    //     if(querydata){
    //         this.oneClickLogin(querydata);
    //     }
    // },
    mounted() {
      
        if (localStorage.getItem('authToken') && localStorage.getItem('authToken') !== 'undefined') {
            this.getClientDataFromApi();         
        }

    },   

    methods: {
        ...mapActions('userDataModule', ['getClientDataFromApi','oneClickLogin']),      
    },

    
};
</script>