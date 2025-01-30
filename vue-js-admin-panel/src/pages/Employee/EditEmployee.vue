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
                                <Form @submit="updateEmployee" :validation-schema="schema" v-slot="{ errors }"> 
                                    <!-- <input type="hidden" v-model="employeeData.id"/> -->
                                    
                                    <div class="input_sub_box">
                                        <label for="firstname">First Name <span class="symbol_red">*</span></label>
                                        <Field name="firstname" type="text" placeholder="Enter Employee First Name" v-model="employeeData.firstname" :class="{ 'has-error': errors.firstname }"  />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="firstname"></label>
                                        <ErrorMessage name="firstname" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="lastname">Last Name <span class="symbol_red">*</span></label>
                                        <Field name="lastname" type="text" placeholder="Enter Employee Last Name" v-model="employeeData.lastname" :class="{ 'has-error': errors.lastname }"  />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="lastname"></label>
                                        <ErrorMessage name="lastname" class="text-danger"  />
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
                                        <Field name="phone" type="text" placeholder="Enter Employee Phone No" v-model="employeeData.phone" :class="{ 'has-error': errors.phoone }" v-on:keyup="restrictPhoneInput($event)" />
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
                                        <ErrorMessage name="address" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee About <span class="symbol_red">*</span></label>
                                        <Field name="about" type="textarea" placeholder="Enter Employee About" v-model="employeeData.about" :class="{ 'has-error': errors.about }" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about"></label>
                                        <ErrorMessage name="about" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="category">Category <span class="symbol_red">*</span></label>
                                       <Field name="category" as="select" v-model="employeeData.category" :class="{ 'has-error': errors.category }">
                                            <option value="" disabled>Select Category</option>
                                            <option v-for="category in allCategoryList" :key="category.id" :value="category.id" >{{ category.category }}</option>
                                       </Field>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="category"></label>
                                        <ErrorMessage name="category" class="text-danger" />
                                    </div>

                                    <div class="input_sub_box" v-if="this.options">
                                        <label for="skills">Skills</label> 
                                        <multiselect v-model="employeeData.skills" placeholder="Select Skills" :options="options" mode="tags" :searchable="true" :create-option="true"  :close-on-select="false"></multiselect>
                                    </div> 

                                    <div class="input_sub_box" v-if="this.options">
                                        <label for="skills"></label> 
                                        <ErrorMessage name="skills" class="text-danger" />  
                                    </div> 

                                    <div class="input_sub_box">
                                        <label for="about">Employee CV <span class="symbol_red">*</span></label>
                                        <a :href="documenturl+'uploads/'+employeeData.cv" target="_blank">View Cv</a> 
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadfile">Upload CV <span class="symbol_red">*</span></label>
                                        <Field type="file" name="uploadfile" v-validate="'required'" @change="handleFileChange" />
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadfile"></label>
                                        <ErrorMessage name="uploadfile" class="text-danger"/>
                                    </div>

                                    <div class="input_sub_box">
                                        <label for="about">Employee Profile Image <span class="symbol_red">*</span></label>   
                                        <div class="cv_image_box" target="_blank">
                                            <a :href="documenturl+'uploads/'+employeeData.profile_image" target="_blank">                              
                                              <img :src="documenturl+'uploads/'+employeeData.profile_image"/>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadimage">Upload Profile Image <span class="symbol_red">*</span></label>
                                        <Field type="file" name="uploadimage" v-validate="'required'" @change="handleImageFileChange" />
                                    </div>

                                    <div class="input_sub_box input_pdf">
                                        <label for="uploadimage"></label>
                                        <ErrorMessage name="uploadimage" class="text-danger" />
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
import Multiselect from '@vueform/multiselect'
const documenturl=import.meta.env.VITE_VUE_APP_ASSETSURL

export default {
    name: 'viewEmployeeDetailsPage',

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
            firstname: yup.string().required().trim().label('First name'),
            lastname: yup.string().required().trim().label('Last name'),            
            email: yup.string().required().trim().email().label('Email'),
            phone: yup.string().max(18).required('Phone number is required').trim().label('Phone No'),
            country: yup.string().required().trim().label('Country'),
            address: yup.string().required().trim().label('Address'),
            about: yup.string().required().trim().label('About'),
            category: yup.string().required().label('Category'),
            uploadfile: yup
                .mixed()
                .test('fileType', 'Invalid file type. Only PDF & DOC allowed.', (value) => {
                    if (!value) return true; // Allow empty values (no file selected)
                    const allowedTypes = ['application/pdf','application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    return allowedTypes.includes(value[0].type);
                }),
            uploadimage: yup
            .mixed()
            .test('fileType', 'Invalid file type. Only JPG, PNG, GIF, JPEG & WEBP allowed.', (value) => {
                if (!value) return true; // Allow empty values (no file selected)
                const allowedTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
                return allowedTypes.includes(value[0].type);
            }),
          
        });

        return {          
            employeeData:{
                id: '',
                firstname: '',
                lastname:'',                
                email:'',
                phone:'',               
                country:'',
                address:'',
                about:'', 
                category: '',    
                skills: [],      
                cv: '',
                profile_image: '',       
            },
            selectedFile:null,
            selectedImageFile:null,
            schema,
            documenturl,
            query:{
                slug:'',
            },    
        }
    },

    computed: {
        ...mapState('userDataModule', ['individualemployeeData','allCategoryList','allSkillsList','individualempSkillsData']),

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
        ...mapActions('userDataModule', ['getIndividualEmployeeData', 'updateEmployeeData', 'getSkillsAndCategory']),  

        restrictPhoneInput(event) {
            const allowedCharacters = /^[0-9()+-]*$/;
            const inputValue = event.target.value;
            if (!allowedCharacters.test(inputValue)) {
                // Remove the last character if it's not allowed
                this.employeeData.phone = inputValue.slice(0, -1);
            }
        },

        getEmployeedata(paramdata){
            this.getIndividualEmployeeData(paramdata); 
        },          
        
        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },

        handleImageFileChange(event) {
            this.selectedImageFile = event.target.files[0];
        },
        
        updateEmployee(){
            // EmployeeData.setFieldError = setFieldError;

            const formData = new FormData();
            
            if(this.selectedFile){
                formData.append('cvfile', this.selectedFile);
            }

            if(this.selectedImageFile){
                formData.append('imagefile', this.selectedImageFile);
            }

            formData.append('id', this.employeeData.id);
            formData.append('firstname', this.employeeData.firstname);
            formData.append('lastname', this.employeeData.lastname);
            formData.append('email', this.employeeData.email);
            formData.append('phone', this.employeeData.phone);
            formData.append('country', this.employeeData.country);
            formData.append('address', this.employeeData.address);
            formData.append('about', this.employeeData.about);
            formData.append('category', this.employeeData.category);
            formData.append('skills', JSON.stringify(this.employeeData.skills));
            this.updateEmployeeData(formData);    
        }   
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;  
        this.query.slug = paramdata; 
        this.getEmployeedata(paramdata); 
        this.getSkillsAndCategory();           
        console.log(paramdata);   
    },

    watch: {
        individualemployeeData() {
            const individualdata = this.individualemployeeData[0];
            // console.log(individualdata.profile_image);
            this.employeeData.id = individualdata.user_id;
            this.employeeData.firstname = individualdata.user.firstname;
            this.employeeData.lastname = individualdata.user.lastname;
            this.employeeData.email = individualdata.user.email;
            this.employeeData.phone = individualdata.user.phone;
            this.employeeData.country = individualdata.country;
            this.employeeData.address = individualdata.address;        
            this.employeeData.about = individualdata.about;
            this.employeeData.category = individualdata.categoryid;
            this.employeeData.cv = individualdata.cv;
            this.employeeData.profile_image = individualdata.profile_image;
           
            if(this.individualempSkillsData){
                const datalist= this.individualempSkillsData[this.query.slug];
                console.log(this.individualempSkillsData[this.query.slug])
                datalist.forEach(item => {
                    this.employeeData.skills.push(item.id);
                });
                //this.employeeData.empWithCatAndSkills.push(50)
            }
        }
    }

}
</script>
<style src="@vueform/multiselect/themes/default.css"></style> 