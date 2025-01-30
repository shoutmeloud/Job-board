<template>
    <!-- <div>
        <div class="login_section">
            <div class="container">
                <div class="row">
                    <div class="login_header d-flex align-items-center justify-content-center">
                        <div class="logo">
                            <router-link to="/">
                                <img src="@/assets/images/Reddensoft_logo.png" />
                            </router-link>
                        </div>
                    </div>
                    <div class="login_body">
                        <div class="login_box">
                            <h2>Forgot Password ?</h2>
                            <Form @submit="forgotPass" :validation-schema="schema" v-slot="{ errors }">    
                                <div class="input_div">
                                    <label>Email address</label>
                                    <Field name="email" type="email" placeholder="Enter your Email" v-model="userData.email" :class="{ 'has-error': errors.email }" />
                                    <ErrorMessage name="email" class="text-danger" />
                                </div>
                            
                                <div class="login_btn">
                                    <button type="submit">Sent Mail</button>
                                </div>
                            </Form> 
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> -->

    <div class="register_section">
        <div class="container-fluid">
            <div class="row h-100">
                <div class="register_left">
                    <img class="top_image" src="@/assets/images/register-top.png" alt="animation-iamge" />
                    <div class="register_text">
                        <h2>
                            Jobboard & Referral
                        </h2>
                        <p>
                            Forgot Password!!
                        </p>
                    </div>
                    <img class="bottom_image" src="@/assets/images/regisetr-bottom.png" alt="animation-iamge" />
                </div>
                <div class="register_right">
                    <div class="rigster_input_box login_div">
                        <div class="register_image">
                            <img src="@/assets/images/logo.png" alt="logo" />
                        </div>
                        <div class="register_name">
                            <h3>Forgot Password.</h3>
                        </div>
                        <div class="register_input">
                            <Form @submit="forgotPass" :validation-schema="schema" v-slot="{ errors }">    
                                <div class="input_div">
                                    <label>Email address</label>
                                    <Field name="email" type="email" placeholder="Enter your Email" v-model="userData.email" :class="{ 'has-error': errors.email }" />
                                    <ErrorMessage name="email" class="text-danger" />
                                </div>
                                <div class="login_btn">
                                    <button type="submit">Sent Mail</button>
                                </div>
                            </Form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import '@/assets/css/login/login.css'
import {mapActions} from 'vuex';
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: 'ForgotPasswordPage',
    data() {
        const schema = yup.object({
            email: yup.string().required().email().label('Email'),
        });

        return {         
            userData:{
                email:'',
            },            
            schema,
        }
    },

    components: {
        Field,
        Form,
        ErrorMessage,
    },

    methods: {
        ...mapActions('userDataModule', ['forgotPassword']),

        forgotPass(){
            // console.log(this.userData);
           this.forgotPassword(this.userData);
        }
    },


}

</script>