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
import DashboardIndex from '@/pages/Index/DashboardIndex.vue';
import {mapActions, mapState } from 'vuex';
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
    
    mounted() {
        console.log(localStorage.getItem('authToken'));
        if (localStorage.getItem('authToken') && localStorage.getItem('authToken') !== 'undefined') {
            this.getClientDataFromApi();         
        }
    },   

    methods: {
        ...mapActions('userDataModule', ['getClientDataFromApi']),      
    },
  
};
</script>