<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Employee Form</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box" :v-if="allEmpData.user">
                                <form> 

                                    <div class="input_sub_box">
                                        <label for="first_name">First Name :</label>
                                        <input name="first_name" type="text" placeholder="Enter Employee First Name" :value="allEmpData.user.firstname"  readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="last_name">Last Name :</label>
                                        <input name="last_name" type="text" placeholder="Enter Employee Last Name" :value="allEmpData.user.lastname" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="email">Email :</label>
                                        <input name="email" type="email" placeholder="Enter Employee Email" :value="allEmpData.user.email" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="phone">Phone No :</label>
                                        <input name="phone" type="number" placeholder="Enter Employee Phone No" :value="allEmpData.user.phone" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="country">Employee Country :</label>
                                        <input name="country" type="text" placeholder="Enter Employee Country" :value="allEmpData.country" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="address">Employee Address :</label>
                                        <input name="address" type="textarea" placeholder="Enter Employee Address" :value="allEmpData.address" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee About :</label>
                                        <input name="about" type="textarea" placeholder="Enter Employee About" :value="allEmpData.about" readonly />
                                    </div>

                                    <!-- <div class="input_sub_box">
                                        <label for="about">Employee About1 :</label>
                                        <input name="about" type="textarea" placeholder="Enter Employee About" :value="allEmpData.about" readonly />
                                    </div> -->

                                    <div class="input_sub_box">
                                        <label for="about">Employee Category :</label>
                                        <input name="about" type="textarea" placeholder="Enter Employee About" :value="allEmpData.category.category" readonly />
                                    </div>


                                    <!-- <div class="input_sub_box">
                                        <label for="about">Category :</label>
                                        <select name="" id="">
                                            <option value="" disabled>Select Category</option>
                                            <option value="">Saab</option>
                                            <option value="">Mercedes</option>
                                            <option value="">Audi</option>
                                        </select>
                                    </div> -->

                                    <div class="input_sub_box">
                                        <label for="about">Employee Skills :</label>
                                        <input name="about" type="textarea" placeholder="Enter Employee About" :value="getSkillsString(individualempSkillsData[allEmpData.id])" readonly />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee CV :</label>
                                        <a :href="documenturl+'uploads/'+allEmpData.cv" target="_blank">View Cv</a> 
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee Profile Image :</label>
                                        <div class="cv_image_box" target="_blank">
                                            <a :href="documenturl+'uploads/'+allEmpData.profile_image" target="_blank">
                                                <img :src="documenturl+'uploads/'+allEmpData.profile_image"/>
                                            </a>
                                        </div>
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
const documenturl=import.meta.env.VITE_VUE_APP_ASSETSURL


export default {
    name: 'viewEmployeeDetailsPage',
    components: {
        Header,
        Leftside,  
    },

    data() {     
        return {  
            allEmpData: [],        
            query:{
                slug:'',
            },    
            documenturl,
        }
    },

    computed: {
        ...mapState('userDataModule', ['individualemployeeData', 'individualempSkillsData','getEmpCaetegoryData'])
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualEmployeeData']),   
        getSkillsString(skillsData) {
            if (!skillsData) {
                return ''; // Handle the case when skillsData is undefined or empty
            }
            return skillsData.map(skill => skill.skills).join(', ');
        },         
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getIndividualEmployeeData(paramdata);
        console.log(this.individualemployeeData);
        //  this.allEmpData = this.individualemployeeData[0];
    },

    watch: {
        individualemployeeData() {           
            console.log(this.individualemployeeData[0]);
            this.allEmpData = this.individualemployeeData[0];

        }
    }
}
</script>