<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="d-flex w-100">
                            <div class="div_left">
                                    <div class="page_name">
                                <h3>Employee Profile</h3>
                            </div>
                            <div class="client_new_from">
                                <div class="input_box">
                                    <Form @submit="editprofile" :validation-schema="schema" v-slot="{ errors }">  
                                        <div class="input_sub_box">
                                            <label for="">First Name :</label>
                                            <Field name="firstname" type="text" placeholder="Enter your First name" v-model="EmployeeData.firstname" :class="{ 'has-error': errors.firstname }" />
                                        </div>
                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="firstname" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">Last Name :</label>
                                            <Field name="lastname" type="text" placeholder="Enter your Last First name" v-model="EmployeeData.lastname" :class="{ 'has-error': errors.lastname }" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="lastname" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">Email id :</label>
                                            <Field name="email" type="email" placeholder="Enter your email id" readonly v-model="EmployeeData.email" :class="{ 'has-error': errors.email }" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="email" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">Contact No :</label>
                                            <Field name="contactno"  type="text" placeholder="Enter your phone no" v-model="EmployeeData.contactno" :class="{ 'has-error': errors.contactno }" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="contactno" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">Address :</label>
                                            <Field as="textarea" name="address" placeholder="Write your address" v-model="EmployeeData.address" :class="{ 'has-error': errors.address }"/>
                                        </div>

                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="address" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">Country Name:</label>
                                            <Field name="country" type="text" placeholder="Enter your Country name" v-model="EmployeeData.country" :class="{ 'has-error': errors.country }" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for=""></label>
                                            <ErrorMessage name="country" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="">About :</label>
                                            <Field as="textarea" name="about"  placeholder="Write yourself" v-model="EmployeeData.about" />
                                            <ErrorMessage name="about" class="text-danger" />
                                        </div>

                                        <div class="input_sub_box">
                                            <label for="about">Employee CV <span class="symbol_red"></span></label>
                                            <a class="cv_button" :href="documenturl+'uploads/'+EmployeeData.cv" target="_blank">View Cv</a> 
                                        </div>

                                        <div class="input_sub_box input_pdf">
                                            <label for="uploadfile">Upload CV <span class="symbol_red">*</span></label>
                                            <Field type="file" name="uploadfile" v-validate="'required'" @change="handleFileChange" />
                                        </div>

                                        <div class="input_sub_box input_pdf">
                                            <label for="uploadfile"></label>
                                            <ErrorMessage name="uploadfile" class="text-danger"/>
                                        </div>

                                        <div class="input_sub_box" v-if="url != null">
                                            <label for="about">Employee Profile Image <span class="symbol_red"></span></label>                                 
                                            <!-- <img :src="documenturl+'uploads/'+EmployeeData.profile_image"/> -->
                                            <a :href="documenturl+'uploads/'+EmployeeData.profile_image" class="image_button" target="_blank">
                                                <img v-if="url" :src="url"/>
                                            </a>
                                        </div>

                                        <div class="input_sub_box input_pdf">
                                            <label for="uploadimage">Upload Profile Image <span class="symbol_red">*</span></label>
                                            <Field type="file" name="uploadimage" v-validate="'required'" @change="handleImageFileChange" />
                                        </div>

                                        <div class="input_sub_box input_pdf">
                                            <label for="uploadimage"></label>
                                            <ErrorMessage name="uploadimage" class="text-danger"/>
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
                            <div class="div_left">
                                <div v-if="filetypePreview">
                                    <span>{{filetypePreview}}</span>
                                </div>
                                <div class="row table_section" v-if="docurl != null">                           
                                    <embed :src="docurl" width="100%" height="600" />                         
                                </div>
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
const documenturl=import.meta.env.VITE_VUE_STORAGE_FILEPATH
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
            uploadfile: yup
            .mixed()
            .required('Please upload a file')
            .test('fileType', 'Invalid file type. Only PDF & DOC allowed.', (value) => {
            if (!value) return true; // Allow empty values (no file selected)
            const allowedTypes = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            return allowedTypes.includes(value[0].type);
            }),

            uploadimage: yup
            .mixed()
            .required('Please upload a file')
            .test('fileType', 'Invalid file type. Only JPG, JPEG, WEBP & PNG allowed.', (value) => {
            if (!value) return true; // Allow empty values (no file selected)
            const allowedTypes = ['image/jpeg','image/png','image/webp'];
            return allowedTypes.includes(value[0].type);
            }),
        });
        return {          
           EmployeeData:{
                firstname:'',
                lastname:'',
                email:'', 
                contactno:'',
                address :'',
                country:'',
                about:'',  
                cv: '',
                profile_image: '',                                                 
            },
            url: null,
            docurl: null,
            filetypePreview:'',
            documenturl,
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
    mounted() {
        this.EmployeeData.firstname='';
        this.EmployeeData.lastname='';
        this.EmployeeData.email='';
        this.EmployeeData.contactno='';
        this.EmployeeData.address='';
        this.EmployeeData.country='';
        this.EmployeeData.about='';
    },   
    methods: {
        ...mapActions('userDataModule', ['updateuserprofile','updateuserprofileimage']),

        editprofile() {
            // EmployeeData.setFieldError = setFieldError;
            // if (this.EmployeeData.email !== '') {
            //     this.updateuserprofile(this.EmployeeData);
            // }

            const formData = new FormData();
            
            if(this.selectedFile){
                formData.append('cvfile', this.selectedFile);
            }

            if(this.selectedImageFile){
                formData.append('imagefile', this.selectedImageFile);
            }

            formData.append('id', this.EmployeeData.id);
            formData.append('firstname', this.EmployeeData.firstname);
            formData.append('lastname', this.EmployeeData.lastname);
            formData.append('email', this.EmployeeData.email);
            formData.append('contactno', this.EmployeeData.contactno);
            formData.append('country', this.EmployeeData.country);
            formData.append('address', this.EmployeeData.address);
            formData.append('about', this.EmployeeData.about);
            this.updateuserprofile(formData);    

        },

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];           
            const fileExtension = this.selectedFile.name.split('.').pop();
            console.log(fileExtension)
            if(fileExtension == 'pdf'){
                this.docurl = URL.createObjectURL(this.selectedFile);
            }else{
                this.docurl = null;
                this.filetypePreview = 'Only PDF File Are supported to preview'
            }
            // filetypePreview
        },

        // handleImageFileChange(event) {
        //     this.selectedImageFile = event.target.files[0];
        // },

        handleImageFileChange(event) {        
            this.selectedImageFile = event.target.files[0];          
            this.url = URL.createObjectURL(this.selectedImageFile); 
            // const formData = new FormData();
            // formData.append('imagefile', this.selectedImageFile);
            // this.updateuserprofileimage(formData); 
        },
    },
    watch:{
        userData()
        {
           console.log(this.userData)
            this.EmployeeData.firstname=this.userData.firstname;
            this.EmployeeData.lastname=this.userData.lastname;
            this.EmployeeData.email=this.userData.email;
            this.EmployeeData.contactno=this.userData.phone;
            this.EmployeeData.cv = this.userData.employee_profile.cv;
            this.EmployeeData.profile_image = this.userData.employee_profile.profile_image;
            this.url = documenturl+'uploads/'+this.userData.employee_profile.profile_image
            if(this.userData.employee_profile==null){
                this.EmployeeData.address='';
                this.EmployeeData.country='';
                this.EmployeeData.about='';
            }else{
                this.EmployeeData.address=this.userData.employee_profile.address;
                this.EmployeeData.country=this.userData.employee_profile.country;
                this.EmployeeData.about=this.userData.employee_profile.about;
            }
            
        }
    }

};
</script>