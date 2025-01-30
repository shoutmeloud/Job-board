<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Add Skill</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <Form @submit="addSkill" :validation-schema="schema" v-slot="{ errors }"> 

                                    <div class="input_sub_box">
                                        <label for="skills">Skill Name <span class="symbol_red">*</span></label>
                                        <Field name="skills" type="text" placeholder="Enter Skill Name" v-model="skillData.skills" :class="{ 'has-error': errors.skills }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="skills"></label>
                                        <ErrorMessage name="skills" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <button type="submit">
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
import {mapActions } from 'vuex';
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: 'addSkillPage',
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
                skills: '',   
                status: '1',             
            },
            schema
        }
    },

    methods: {      

        ...mapActions('userDataModule', ['addNewSkillData']),  

        addSkill(skillData, { setFieldError }){
            skillData.setFieldError = setFieldError;
            this.addNewSkillData(this.skillData);           
        }   
        
    },
}
</script>