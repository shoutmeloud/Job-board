<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Update Category</h3>
                        </div>
                        <div class="client_new_from">
                            <div class="input_box">
                                <Form @submit="updateCategory" :validation-schema="schema" v-slot="{ errors }"> 
                                    <input type="hidden" v-model="categoryData.id"/>
                                    <div class="input_sub_box">
                                        <label for="category">Category <span class="symbol_red">*</span></label>
                                        <Field name="category" type="text" placeholder="Enter Category" v-model="categoryData.category" :class="{ 'has-error': errors.category }"  />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="category"></label>
                                        <ErrorMessage name="category" class="text-danger" />
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
    name: 'editCategoryDetailsPage',

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
                id: '',
                category: '',              
                                           
            },         
            schema,
            query:{
                slug:'',
            },    
        }
    },

    computed: {
        ...mapState('userDataModule', ['individualcategoryData'])
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualCategoryData', 'updateCategoryData']),  

        getCategorydata(paramdata){
            this.getIndividualCategoryData(paramdata); 
        },          

        updateCategory(){
            // CategoryData.setFieldError = setFieldError;
            this.updateCategoryData(this.categoryData);           
        }   
    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getCategorydata(paramdata);    
        console.log(this.individualcategoryData);   
    },

    watch: {
        individualcategoryData() {
            const individualdata = this.individualcategoryData[0];
            console.log(individualdata);
            this.categoryData.id = individualdata.id;
            this.categoryData.category = individualdata.category;
        }
    }
}
</script>