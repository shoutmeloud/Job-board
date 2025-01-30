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
                    <div class="rigster_input_box">
                        <div class="register_image">
                            <img src="@/assets/images/logo.png" alt="logo" />
                        </div>
                        
                        <Form @submit="registerClient" :validation-schema="schema" v-slot="{ errors }">  
                            <div class="register_input">  
                                <div class="input_div">                                    
                                    <label for="first_name">First Name <span class="symbol_red">*</span></label>
                                    <Field name="first_name" type="text" placeholder="Enter your first name" v-model="clientData.first_name" :class="{ 'has-error': errors.first_name }" />
                                    <ErrorMessage name="first_name" class="text-danger" />
                                </div>

                                <div class="input_div">                                  
                                    <label for="last_name">Last Name <span class="symbol_red">*</span></label>
                                    <Field name="last_name" type="text" placeholder="Enter your last name" v-model="clientData.last_name" :class="{ 'has-error': errors.last_name }" />
                                    <ErrorMessage name="last_name" class="text-danger" />
                                </div>

                                <div class="input_div">
                                    <label for="email">Email <span class="symbol_red">*</span></label>
                                    <Field name="email" type="email" placeholder="Enter your email" v-model="clientData.email" :class="{ 'has-error': errors.email }" />
                                    <ErrorMessage name="email" class="text-danger" />
                                </div>

                                <div class="input_div">
                                    <label for="phone">Contact No <span class="symbol_red">*</span></label>
                                    <Field name="phone" type="text" placeholder="Enter your contact no" v-model="clientData.phone" :class="{ 'has-error': errors.phoone }" v-on:keyup="restrictPhoneInput($event)" v-on:keypress="restrictPhoneInput($event)"/>
                                    <ErrorMessage name="phone" class="text-danger" />
                                </div>

                                <div class="input_div">
                                    <label for="country"> Country <span class="symbol_red">*</span></label>
                                    <Field name="country" type="text" placeholder="Enter your country" v-model="clientData.country" :class="{ 'has-error': errors.country }" />
                                    <ErrorMessage name="country" class="text-danger" />
                                </div>

                                <div class="input_div">
                                    <label for="address"> Address <span class="symbol_red">*</span></label>
                                    <Field name="address" type="textarea" placeholder="Enter your address" v-model="clientData.address" :class="{ 'has-error': errors.address }" />
                                     <ErrorMessage name="address" class="text-danger"/>
                                </div>

                                <div class="input_div">
                                    <label for="about"> About <span class="symbol_red">*</span></label>
                                    <Field name="about" type="textarea" placeholder="Your about" v-model="clientData.about" :class="{ 'has-error': errors.about }" />
                                    <ErrorMessage name="about" class="text-danger"/>
                                </div>    

                                <div class="input_div">
                                    <label for="password">Password <span class="symbol_red">*</span></label>
                                    <div class="input_password">
                                        <Field  name="password" :type="showPass ? 'text' : 'password'" type="password" placeholder="Enter Password" v-model="clientData.password" @blur="passwordValidate()" />
                                        <button class="eye_password" type="button" @click="showPassword" v-if="this.showPass">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#21232c" width="16" height="16" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"></path></svg>
                                        </button>
                                        <button class="eye_password" type="button" @click="showPassword" v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#21232c" width="16" height="16" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"/></svg>
                                        </button>
                                    </div>
                                    <ErrorMessage name="password" class="text-danger"/>
                                    <p class="text-danger">{{ password_error }}</p>
                                </div>

                                <div class="input_div">
                                    <label>Refferral Code </label>
                                    <input name="referral_code" type="text" placeholder="Enter your Refferral Code" v-model="clientData.referral_code"/>
                                </div>       

                                <div class="input_div">
                                    <button type="submit" class="submit_btn">Register</button>
                                </div>
                            </div>
                        </Form>

                        <div class="login_div">
                            <p>Already have an account?
                                <router-link to="/">Login</router-link>
                            </p>
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
import {Form, Field, ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
export default {
    name: 'RegisterPage',
    data() {
        const schema = yup.object({
            first_name: yup.string().required().trim().label('First name'),
            last_name: yup.string().required().trim().label('Last name'),            
            email: yup.string().required().email().trim().label('Email'),
            phone: yup.string().max(18).required('Contact number field is required').trim().label('Contact No'),
            country: yup.string().required().trim().label('Country'),
            address: yup.string().required().trim().label('Address'),
            about: yup.string().required().trim().label('About'),
            password: yup.string().max(16).required().trim().label('Password'),
        });
        return {
            // selectedFile:null,
            clientData:{
                first_name: '',
                last_name:'',                
                email:'',
                phone:'',
                country:'',
                address:'',
                about:'',                
                password:'',
                referral_code:null,
            },
            password_error: '',
            schema,
            showPass:false,
        };

    },
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    
    methods: {      
        
        showPassword(){
            this.showPass = !this.showPass;
        },

        ...mapActions('userDataModule', ['registerNewClient']),  
        
        restrictPhoneInput(event) {
            const allowedCharacters = /^[0-9()+-]*$/;
            const inputValue = event.target.value;
            if (!allowedCharacters.test(inputValue)) {
                // Remove the last character if it's not allowed
                this.clientData.phone = inputValue.slice(0, -1);
            }
        },

        passwordValidate() {
            if (this.clientData.password.length < 8) {
                this.password_error = 'Password should be minimum 8 characters'
            } else {
                this.password_error = ''
            }
        },

        registerClient(clientData, { setFieldError }) {
            clientData.setFieldError = setFieldError;
            //  console.log('jrrfh',this.clientData.referral_code);
            
            if(this.clientData.referral_code != null && this.clientData.referral_code != '' && this.clientData.referral_code != undefined){
                this.registerNewClient(this.clientData);  
                // console.log('not null',this.clientData.referral_code);
            }else{
                let text = "Are You Sure You Don't Want To Use Any Referral Code ?";
                if (confirm(text) == true) {
                    this.registerNewClient(this.clientData);  
                    // console.log('null',this.clientData.referral_code);         
                }
            }
            // this.registerNewClient(this.clientData);           
        }           
    },

    mounted() {
        this.clientData.referral_code = this.$route.query.referralcode;      
    }
}
</script>