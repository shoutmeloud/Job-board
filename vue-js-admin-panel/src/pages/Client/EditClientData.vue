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
                                <Form @submit="updateClient" :validation-schema="schema" v-slot="{ errors }"> 
                                    <!-- <input type="hidden" v-model="clientData.id"/> -->
                                    <div class="input_sub_box">
                                        <label for="firstname">First Name <span class="symbol_red">*</span></label>
                                        <Field name="firstname" type="text" placeholder="Enter Client First Name" v-model="clientData.firstname" :class="{ 'has-error': errors.firstname }"  />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="firstname"></label>
                                        <ErrorMessage name="firstname" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="lastname">Last Name <span class="symbol_red">*</span></label>
                                        <Field name="lastname" type="text" placeholder="Enter Client Last Name" v-model="clientData.lastname" :class="{ 'has-error': errors.lastname }"  />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="lastname"></label>
                                        <ErrorMessage name="lastname" class="text-danger"  />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="email">Email <span class="symbol_red">*</span></label>
                                        <Field name="email" type="email" placeholder="Enter Client Email" v-model="clientData.email" :class="{ 'has-error': errors.email }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="email"></label>
                                        <ErrorMessage name="email" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="phone">Phone No <span class="symbol_red">*</span></label>
                                        <Field name="phone" type="text" placeholder="Enter Client Phone No" v-model="clientData.phone" :class="{ 'has-error': errors.phoone }" v-on:keyup="restrictPhoneInput($event)" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="phone"></label>
                                        <ErrorMessage name="phone" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="country">Client Country <span class="symbol_red">*</span></label>
                                        <Field name="country" type="text" placeholder="Enter Client Country" v-model="clientData.country" :class="{ 'has-error': errors.country }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="country"></label>
                                        <ErrorMessage name="country" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="address">Client Address <span class="symbol_red">*</span></label>
                                        <Field name="address" type="textarea" placeholder="Enter Client Address" v-model="clientData.address" :class="{ 'has-error': errors.address }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="address"></label>
                                        <ErrorMessage name="address" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Client About <span class="symbol_red">*</span></label>
                                        <Field name="about" type="textarea" placeholder="Enter Client About" v-model="clientData.about" :class="{ 'has-error': errors.about }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="about"></label>
                                        <ErrorMessage name="about" class="text-danger" />
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
    name: 'viewClientDetailsPage',

    components: {
        Header,
        Leftside,  
        Field,
        Form,
        ErrorMessage,
    },
    
    data() {
        const schema = yup.object({
            firstname: yup.string().required().trim().label('First name'),
            lastname: yup.string().required().trim().label('Last name'),            
            email: yup.string().required().trim().email().label('Email'),
            phone: yup.string().max(18).required('Phone number is required').trim().label('Phone No'),
            country: yup.string().required().trim().label('Country'),
            address: yup.string().required().trim().label('Address'),
            about: yup.string().required().trim().label('About'),
          
        });

        return {          
            clientData:{
                id: '',
                firstname: '',
                lastname:'',                
                email:'',
                phone:'',               
                country:'',
                address:'',
                about:'', 
                                           
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
        ...mapState('userDataModule', ['individualclientData'])
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualClientData', 'updateClientData']),  

        restrictPhoneInput(event) {
            const allowedCharacters = /^[0-9()+-]*$/;
            const inputValue = event.target.value;
            if (!allowedCharacters.test(inputValue)) {
                // Remove the last character if it's not allowed
                this.clientData.phone = inputValue.slice(0, -1);
            }
        },

        getClientdata(paramdata){
            this.getIndividualClientData(paramdata); 
        },          

        updateClient(){
            // clientData.setFieldError = setFieldError;
            this.updateClientData(this.clientData);           
        }   
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getClientdata(paramdata);    
        console.log(this.individualclientData);   
    },

    watch: {
        // set previous data into the input field for edit
        individualclientData() {
            const individualdata = this.individualclientData[0];
            console.log(individualdata);
            this.clientData.id = individualdata.user_id;
            this.clientData.firstname = individualdata.user.firstname;
            this.clientData.lastname = individualdata.user.lastname;
            this.clientData.email = individualdata.user.email;
            this.clientData.phone = individualdata.user.phone;
            this.clientData.country = individualdata.country;
            this.clientData.address = individualdata.address;        
            this.clientData.about = individualdata.about;
        }
    }
}
</script>