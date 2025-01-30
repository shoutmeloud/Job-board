<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Update Skill</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <Form @submit="updateSkill" :validation-schema="schema" v-slot="{ errors }"> 
                                    <input type="hidden" v-model="skillData.id"/>
                                    <div class="input_sub_box">
                                        <label for="skills">Skill <span class="symbol_red">*</span></label>
                                        <Field name="skills" type="text" placeholder="Enter Skill" v-model="skillData.skills" :class="{ 'has-error': errors.skills }"  />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="skills"></label>
                                        <ErrorMessage name="skills" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <button type="submit" >
                                            Submit
                                        </button>
                                    </div>
                                </Form>
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
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: 'EditSkillDetailsPage',

    components: {
        Header,
        Leftside,  
        Field,
        Form,
        ErrorMessage,
    },
    
    data() {
        const schema = yup.object({
            skills: yup.string().required().trim().label('Skill'),
        });

        return {          
            skillData:{
                id: '',
                skills: '',              
                                           
            },
            // password_error: '',
            // showPass:false,
            // showPassone: false,
            schema,
            query:{
                slug:'',
            },    
        }
    },

    computed: {
        ...mapState('userDataModule', ['individualskillsData'])
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualSkillsData', 'updateSkillsData']),  

        getSkilldata(paramdata){
            this.getIndividualSkillsData(paramdata); 
        },          

        updateSkill(){
            // CategoryData.setFieldError = setFieldError;
            this.updateSkillsData(this.skillData);           
        }   
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getIndividualSkillsData(paramdata);    
        console.log(this.individualskillsData);   
    },

    watch: {
        individualskillsData() {
            const individualdata = this.individualskillsData[0];
            console.log(individualdata);
            this.skillData.id = individualdata.id;
            this.skillData.skills = individualdata.skills;
        }
    }
}
</script>