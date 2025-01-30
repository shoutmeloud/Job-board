<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Add Category</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <Form @submit="addCategory" :validation-schema="schema" v-slot="{ errors }"> 

                                    <div class="input_sub_box">
                                        <label for="category">Category Name <span class="symbol_red">*</span></label>
                                        <Field name="category" type="text" placeholder="Enter Category Name" v-model="categoryData.category" :class="{ 'has-error': errors.category }" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="category"></label>
                                        <ErrorMessage name="category" class="text-danger" />
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
    name: 'addCategoryPage',
    components: {
        Header,
        Leftside,
        Field,
        Form,
        ErrorMessage,
    },

    data() {
        const schema = yup.object({
            category: yup.string().required().trim().label('Category'),   
        });

        return {          
            categoryData:{
                category: '',   
                status: '1',             
            },
            schema
        }
    },

    methods: {      

        ...mapActions('userDataModule', ['addNewCategoryData']),  

        addCategory(categoryData, { setFieldError }){
            categoryData.setFieldError = setFieldError;
            this.addNewCategoryData(this.categoryData);           
        }   
        
    },
}
</script>