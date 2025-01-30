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
                            <div class="input_box">
                                <Form @submit="addEmployee" :validation-schema="schema" v-slot="{ errors }"> 

                                    <div class="input_sub_box">
                                        <label for="first_name">First Name <span class="symbol_red">*</span></label>
                                        <Field name="first_name" type="text" placeholder="Enter Employee First Name" v-model="employeeData.first_name" :class="{ 'has-error': errors.first_name }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="first_name"></label>
                                        <ErrorMessage name="first_name" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="last_name">Last Name <span class="symbol_red">*</span></label>
                                        <Field name="last_name" type="text" placeholder="Enter Employee Last Name" v-model="employeeData.last_name" :class="{ 'has-error': errors.last_name }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="last_name"></label>
                                        <ErrorMessage name="last_name" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="email">Email <span class="symbol_red">*</span></label>
                                        <Field name="email" type="email" placeholder="Enter Employee Email" v-model="employeeData.email" :class="{ 'has-error': errors.email }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="email"></label>
                                        <ErrorMessage name="email" class="text-danger" />
                                    </div>



                                    <div class="input_sub_box">
                                        <label for="phone">Phone No <span class="symbol_red">*</span></label>
                                        <Field name="phone" type="text" placeholder="Enter Employee Phone No" v-model="employeeData.phone" :class="{ 'has-error': errors.phone }" v-on:keyup="restrictPhoneInput($event)" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="phone"></label>
                                        <ErrorMessage name="phone" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="country">Employee Country <span class="symbol_red">*</span></label>
                                        <Field name="country" type="text" placeholder="Enter Employee Country" v-model="employeeData.country" :class="{ 'has-error': errors.country }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="country"></label>
                                        <ErrorMessage name="country" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="address">Employee Address <span class="symbol_red">*</span></label>
                                        <Field name="address" type="textarea" placeholder="Enter Employee Address" v-model="employeeData.address" :class="{ 'has-error': errors.address }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="address"></label>
                                        <ErrorMessage name="address" class="text-danger"/>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee About <span class="symbol_red">*</span></label>
                                        <Field name="about" type="textarea" placeholder="Enter Employee About" v-model="employeeData.about" :class="{ 'has-error': errors.about }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="about"></label>
                                        <ErrorMessage name="about" class="text-danger"/>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="password">Password <span class="symbol_red">*</span></label>
                                        <Field  name="password" type="password" placeholder="Enter Password" v-model="employeeData.password" @blur="passwordValidate()"/>
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="password"></label>
                                        <ErrorMessage name="password" class="text-danger"/>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="password_confirmation">Confirm Password <span class="symbol_red">*</span></label>
                                        <Field  name="password_confirmation" type="password" placeholder="Enter Confirm Password" v-model="employeeData.password_confirmation"  @blur="passwordMatch()"/>
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="password_confirmation"></label>
                                        <ErrorMessage name="password_confirmation" class="text-danger"/>
                                        <p class="text-danger">{{ password_error }}</p>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="category">Category <span class="symbol_red">*</span></label>
                                       <Field name="category" as="select" v-model="employeeData.category" :class="{ 'has-error': errors.category }">
                                            <option value="" disabled>Select Category</option>
                                            <option v-for="category in allCategoryList" :key="category.id" :value="category.id">{{ category.category }}</option>
                                       </Field>
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="category"></label>
                                        <ErrorMessage name="category" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadfile">Upload CV <span class="symbol_red">*</span></label>
                                        <Field type="file" name="uploadfile" v-validate="'required'" @change="handleFileChange" />
                                    </div>
                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadfile"></label>
                                        <ErrorMessage name="uploadfile" class="text-danger"/>
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadimage">Upload Profile Image <span class="symbol_red">*</span></label>
                                        <Field type="file" name="uploadimage" v-validate="'required'" @change="handleImageFileChange" />
                                    </div>
                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadimage"></label>
                                        <ErrorMessage name="uploadimage" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box" v-if="this.options">
                                        <label for="skills">Skills</label> 
                                        <!-- <multiselect v-model="employeeData.skills" :options="allskils" :multiple="true" :track-by="allskils" :label="allskils" placeholder="Select Skills" :class="{ 'has-error': errors.skills }"></multiselect> -->
                                        <multiselect 
                                        v-model="employeeData.skills" 
                                        placeholder="Select Skills"
                                        :options="options" mode="tags" 
                                        :searchable="true" 
                                        :close-on-select="false"
                                        >
                                        </multiselect>
                                        <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->
                                    </div> 
                                    <div class="input_sub_box" v-if="this.options">
                                        <label for="skills"></label> 
                                        <ErrorMessage name="skills" class="text-danger" />  
                                    </div> 

                                    <!-- <div class="input_sub_box">
                                        <label for="skills"></label> 
                                        <p class="text-danger">{{ password_error }}</p>
                                    </div>  -->

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
import {mapActions, mapState} from 'vuex';
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import Multiselect from '@vueform/multiselect'

export default {
    name: 'addEmployeePage',
    components: {
        Header,
        Leftside,
        Field,
        Form,
        ErrorMessage,
        Multiselect,
    },

    data() {
        const schema = yup.object({
            first_name: yup.string().required().trim().label('First name'),
            last_name: yup.string().required().trim().label('Last name'),            
            email: yup.string().required().trim().email().label('Email'),
            phone: yup.string().max(18).required('Phone number is required').trim().label('Phone No'),
            country: yup.string().required().trim().label('Country'),
            address: yup.string().required().trim().label('Address'),
            about: yup.string().required().trim().label('About'),
            password: yup.string().max(16).required().trim().label('Password'),
            password_confirmation: yup.string().required().trim().label('Confirm Password'),
            category: yup.string().required().label('category'),
            // skills: yup.array().required().label('Skills'),
            uploadfile: yup
                .mixed()
                .required('Please upload a file')
                .test('fileType', 'Invalid file type. Only PDF & DOC allowed.', (value) => {
                    if (!value) return true; // Allow empty values (no file selected)
                    const allowedTypes = ['application/pdf','application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    return allowedTypes.includes(value[0].type);
                }),
            uploadimage: yup
            .mixed()
            .required('Please upload a file')
            .test('fileType', 'Invalid file type. Only JPG, PNG, GIF, JPEG & WEBP allowed.', (value) => {
                if (!value) return true; // Allow empty values (no file selected)
                const allowedTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
                return allowedTypes.includes(value[0].type);
            }),
        });

        return {          
            employeeData:{
                first_name: '',
                last_name:'',                
                email:'',
                phone:'',
                country:'',
                address:'',
                about:'',                
                password:'', 
                password_confirmation:'' ,
                category: '',
                skills: [],
            },
            selectedFile:null,
            selectedImageFile:null,
            password_error: '',
            showPass:false,
            showPassone: false,
            schema,            
           // options:[],
        }
    },

    computed: {
        ...mapState('userDataModule', ['allSkillsList','allCategoryList']),
        allskils(){
            return this.allSkillsList;
        },
        options(){
            var skillsoptions = this.allSkillsList?.map(skill => ({
                value: skill.id.toString(), // Convert id to string if needed
                label: skill.skills
            })) || [];
            return skillsoptions;
        }



    },

    methods: {      

        ...mapActions('userDataModule', ['addNewEmployeeData','getSkillsAndCategory']),  

        restrictPhoneInput(event) {
            const allowedCharacters = /^[0-9()+-]*$/;
            const inputValue = event.target.value;
            if (!allowedCharacters.test(inputValue)) {
                // Remove the last character if it's not allowed
                this.employeeData.phone = inputValue.slice(0, -1);
            }
        },

           
        passwordValidate() {
            if (this.employeeData.password.length < 8) {
                this.password_error = 'Password should be minimum 8 characters'
            } else {
                this.password_error = ''
            }
        },

        passwordMatch() {
            // console.log('password match');
            if (this.employeeData.password !== this.employeeData.password_confirmation) {
                this.password_error = 'Password Not Match';
            } else {
                this.password_error = '';
            }
        },

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        handleImageFileChange(event) {
            this.selectedImageFile = event.target.files[0];
        },
           
        async addEmployee(){
            // employeeData.setFieldError = setFieldError;
            console.log(this.employeeData);
            // this.addNewEmployeeData(this.employeeData);       
            
            const formData = new FormData();
            formData.append('cvfile', this.selectedFile);
            formData.append('imagefile', this.selectedImageFile);
            formData.append('first_name', this.employeeData.first_name);
            formData.append('last_name', this.employeeData.last_name);
            formData.append('email', this.employeeData.email);
            formData.append('phone', this.employeeData.phone);
            formData.append('country', this.employeeData.country);
            formData.append('address', this.employeeData.address);
            formData.append('about', this.employeeData.about);
            formData.append('password', this.employeeData.password);
            formData.append('password_confirmation', this.employeeData.password_confirmation);
            formData.append('category', this.employeeData.category);
            formData.append('skills', JSON.stringify(this.employeeData.skills));
            this.addNewEmployeeData(formData);
        }   
        
    },

    created(){ 
        this.getSkillsAndCategory();        
    
        console.log(this.options);
        console.log(this.allCategoryList);
    },

    
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style> 