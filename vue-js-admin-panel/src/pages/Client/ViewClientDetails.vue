<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Client Form</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <form > 

                                    <div class="input_sub_box">
                                        <label for="first_name">First Name :</label>
                                        <input name="first_name" type="text" placeholder="Enter Client First Name" :value="individualclientData[0].user.firstname"  readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="last_name">Last Name :</label>
                                        <input name="last_name" type="text" placeholder="Enter Client Last Name" :value="individualclientData[0].user.lastname" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="email">Email :</label>
                                        <input name="email" type="email" placeholder="Enter Client Email" :value="individualclientData[0].user.email" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="phone">Phone No :</label>
                                        <input name="phone" type="number" placeholder="Enter Client Phone No" :value="individualclientData[0].user.phone" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="country">Client Country :</label>
                                        <input name="country" type="text" placeholder="Enter Client Country" :value="individualclientData[0].country" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="address">Client Address :</label>
                                        <input name="address" type="textarea" placeholder="Enter Client Address" :value="individualclientData[0].address" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Client About :</label>
                                        <input name="about" type="textarea" placeholder="Enter Client About" :value="individualclientData[0].about" readonly />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import '@/assets/css/client/client.css'
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState} from 'vuex';
import {useRoute} from 'vue-router'

export default {
    name: 'viewClientDetailsPage',
    components: {
        Header,
        Leftside,  
    },

    data() {     
        return {          
            query:{
                slug:'',
            },    
        }
    },

    computed: {
        ...mapState('userDataModule', ['individualclientData'])
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualClientData']),            
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getIndividualClientData(paramdata);
        console.log(this.individualclientData);
    }
}
</script>