<template>
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
                            Create an account to get your job done!!
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
                            <h3>Log in to your Account.</h3>
                        </div>
                        <div class="register_input">
                            <Form @submit="login" :validation-schema="schema" v-slot="{ errors }">    
                                <div class="input_div">
                                    <label>Email address</label>
                                    <Field name="email" type="email" placeholder="Enter your Email" v-model="loginData.email" :class="{ 'has-error': errors.email }" />
                                    <ErrorMessage name="email" class="text-danger" />
                                </div>
                                <div class="input_div">
                                    <label>Password</label>
                                    <div class="pass_div">
                                        <Field name="password" :type="showPass ? 'text' : 'password'" placeholder="Password" :class="{ 'has-error': errors.password }" v-model="loginData.password"/>
                                        <button type="button" @click="showPassword" v-if="this.showPass">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#21232c" width="16" height="16" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"></path></svg>
                                        </button>
                                        <button type="button" @click="showPassword" v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#21232c" width="16" height="16" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"/></svg>
                                        </button>
                                    </div>
                                    <ErrorMessage name="password" class="text-danger" />
                                </div>
                                <div class="remember d-flex align-items-center justify-content-between">
                                    <div class="left d-flex align-items-center">
                                        <input id="remember" type="checkbox" v-model="rememberMe" />
                                        <label for="remember">Remember Me</label>
                                    </div>
                                    <div class="right">
                                        <router-link to="/forgot-password">Forgot password?</router-link>
                                    </div>
                                </div>
                                <div class="login_btn">
                                    <button type="submit"  @click="login1">Login</button>
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
import {mapActions, mapState } from 'vuex';
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import VueCookie from 'vue-cookie'; // Import the vue-cookie library

export default {
    name: 'LoginPage',
  
    data() {
        const schema = yup.object({
            email: yup.string().required().email().label('Email'),
            password: yup.string().required().label('Password'),
        });
        return {          
            loginData:{
                email:'',
                password:'',  
                usertype:'1',                              
            },
            showPass:false,
            rememberMe: false,
            schema,
            // setFieldError,
        }
    },

    computed: {
        ...mapState('userDataModule', ['userData'])
    },
    
    components: {
        Field,
        Form,
        ErrorMessage,
    },

    methods: {
        ...mapActions('userDataModule', ['getLoginDetailsFromApi']),

        //  this function is using for show and hide password in login form 
        showPassword(){
            this.showPass = !this.showPass;
        },

        login1() {
            const isClassAdded = false;
            var divid = document.querySelector("body");
            divid.classList.toggle('isActive', isClassAdded);
            localStorage.setItem('isClassAdded', isClassAdded);
        },

        login(loginData, { setFieldError }) {
            loginData.setFieldError = setFieldError;
            // Store credentials in cookies if "Remember Me" is checked
            
            if (this.rememberMe) {
                VueCookie.set('rememberedEmail', this.loginData.email, 15);
                VueCookie.set('rememberedPassword', this.loginData.password, 15);
            } else {
                // Clear stored credentials if "Remember Me" is not checked
                VueCookie.delete('rememberedEmail');
                VueCookie.delete('rememberedPassword');
            }

            if (this.loginData.email !== '' && this.loginData.password !== '') {
                this.getLoginDetailsFromApi(this.loginData);
            }
        },
    },

    mounted() {
        this.login1();
        // Check for stored credentials in cookies and populate the form if available
        const rememberedEmail = VueCookie.get('rememberedEmail');
        const rememberedPassword = VueCookie.get('rememberedPassword');

        if (rememberedEmail && rememberedPassword) {
            this.loginData.email = rememberedEmail;
            this.loginData.password = rememberedPassword;
            this.rememberMe = true;
        }

        if (localStorage.getItem('authToken') && localStorage.getItem('authToken') !== 'undefined') {
           this.$router.push({ name: 'Dashboard' });
            // localStorage.removeItem('authToken') 
        }
    } 
}


</script>