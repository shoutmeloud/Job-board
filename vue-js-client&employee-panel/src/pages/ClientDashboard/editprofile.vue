<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Client From</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <Form @submit="editprofile" :validation-schema="schema" v-slot="{ errors }">  
                                    <div class="input_sub_box">
                                        <label for="">First Name <Span class="symbol_red">*</Span></label>
                                        <Field name="firstname" type="text" placeholder="Enter your First name" v-model="ClientData.firstname" :class="{ 'has-error': errors.firstname }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="firstname" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">Last Name <Span class="symbol_red">*</Span></label>
                                        <Field name="lastname" type="text" placeholder="Enter your Last First name" v-model="ClientData.lastname" :class="{ 'has-error': errors.lastname }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="lastname" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">Email id :</label>
                                        <Field name="email" type="email" placeholder="Enter your email id" readonly v-model="ClientData.email" :class="{ 'has-error': errors.email }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="email" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">Contact No <Span class="symbol_red">*</Span></label>
                                        <Field name="contactno"  type="text" placeholder="Enter your phone no" v-model="ClientData.contactno" :class="{ 'has-error': errors.contactno }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="contactno" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">Address <Span class="symbol_red">*</Span></label>
                                        <Field as="textarea" name="address" placeholder="Write your address" v-model="ClientData.address" :class="{ 'has-error': errors.address }"/>
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="address" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">Country Name <Span class="symbol_red">*</Span></label>
                                        <Field name="country" type="text" placeholder="Enter your Country name" v-model="ClientData.country" :class="{ 'has-error': errors.country }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="country" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="">About <Span class="symbol_red">*</Span></label>
                                        <Field as="textarea" name="about"  placeholder="Write yourself" v-model="ClientData.about" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage name="about" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <button type="submit">
                                            Submit
                                        </button>
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
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {mapActions, mapGetters } from 'vuex';
export default {
    name: 'EditProfile',    
    data() {
        const schema = yup.object({
            firstname: yup.string().required().trim().label('First Name'),
            lastname: yup.string().required().trim().label('Last Name'),
            email: yup.string().required().trim().email().label('Email'),
            contactno: yup.string().required().trim().label('Contact no'),
            address: yup.string().required().trim().label('Address'),
            country: yup.string().required().trim().label('Client Country'),
            about: yup.string().required().trim().label('Client About'),
        });
        return {      

            ClientData:{
                firstname:'',
                lastname:'',
                email:'', 
                contactno:'',
                address :'',
                country:'',
                about:'',                                            
            },

            schema,
        }
    },

    components: {
        Header,
        Leftside,
        Field,
        Form,
        ErrorMessage,
    },

    computed: {
        ...mapGetters('userDataModule', ['userData']),
        userdetails(){
            return this.userData;
        }
    }, 

    // mounted() {
    //     this.ClientData.firstname='';
    //     this.ClientData.lastname='';
    //     this.ClientData.email='';
    //     this.ClientData.contactno='';
    //     this.ClientData.address='';
    //     this.ClientData.country='';
    //     this.ClientData.about='';
    // },   

    methods: {
        ...mapActions('userDataModule', ['updateuserprofile']),

        editprofile(ClientData, { setFieldError }) {
            ClientData.setFieldError = setFieldError;
            if (this.ClientData.email !== '') {
                this.updateuserprofile(this.ClientData);
            }
        },
    },

    watch:{
        userData()
        {
           console.log(this.userData)
            this.ClientData.firstname=this.userData.firstname;
            this.ClientData.lastname=this.userData.lastname;
            this.ClientData.email=this.userData.email;
            this.ClientData.contactno=this.userData.phone;
            if(this.userData.client==null){
                this.ClientData.address='';
                this.ClientData.country='';
                this.ClientData.about='';
            }else{
                this.ClientData.address=this.userData.client.address;
                this.ClientData.country=this.userData.client.country;
                this.ClientData.about=this.userData.client.about;
            }
            
        }
    }

};
</script>