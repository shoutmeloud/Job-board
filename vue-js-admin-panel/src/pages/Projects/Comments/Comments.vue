<template>
    <div class="coments_section">
        <div class="coments_box">
            <Form :validation-schema="schema" @submit="onSubmit" v-slot="{ errors }" id="commentBox">
                <h3>Comment</h3>
                <Field as="textarea" name="newComment"  v-model="FormData.newComment" placeholder="Write a comment..." :class="{ 'has-error': errors.newComment }"/>
                <ErrorMessage name="newComment" class="text-danger" />
                <button @click="submitComment" :disabled="!FormData.newComment.trim()" class="submit_btn">Submit</button>
            </Form>   
        </div>
        <div class="previous_box" v-if="comments">
            <h3>Previous Comments</h3>
            <div v-for="(comment, index) in comments" :key="index" class="posted_div">
                <h4>Posted by 
                    <span class="name" v-if="comment.users">
                        <!-- {{comment}} -->
                        {{postedByName(comment.users.id, comment.users.firstname, comment.users.lastname)}}
                    </span>
                </h4>
                <div class="posted_box">
                    <p>{{comment.comments }}</p>
                    <ul class="d-flex align-items-center justify-content-end">
                        <li>Date: {{ formatDate( comment.created_at ) }}</li>
                        <li>Time: {{ formatTime( comment.created_at ) }}</li>
                    </ul>
                </div>
            </div>
            <div v-if="comments == ''">
                <p class="pre_comment">No Comments Yet.....</p>
            </div>
        </div>
    </div>
</template>
<script> 
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {mapActions,mapGetters} from 'vuex';
import moment from 'moment';

export default {
    name: 'Comments',
    data() {
        const schema = yup.object({
            newComment: yup.string().required('Write a comment...'),
        });
        return {
            comments:[],
            FormData:{
                newComment: '',
                id:this.$route.params.slug
            },            
            schema,
            params:{
                page: 1, 
                no_of_item:10,
                projectid:this.$route.params.slug
            },            
        }
    },

    components: {
        Form,
        Field,
        ErrorMessage
    }, 
    
    methods: {
        ...mapActions('userDataModule', ['addProjectcomments','getProjectcomment']),

        onSubmit(FormData, { setFieldError }) {
            FormData.setFieldError = setFieldError;
            if (this.FormData.newComment !== '') {
                this.addProjectcomments(this.FormData);   
                setTimeout(() => {
                    this.getProjectcomment(this.params); 
                },"500");             
                // this.getProjectcomment(this.params); 
                document.getElementById('commentBox').reset();
            }
        },

        // Format date using dateformat
        formatDate(date) {
           return moment(date).format('MM-DD-YYYY');
        },

        // Format Time using timeformat
        formatTime(time) {
           return moment(time).format('H:m');
        },

        postedByName(id, firstname,lastname){
            var postedBy = '';
            if(this.userData.id ==id){
                postedBy = 'Me';
                return postedBy;
            }else{
                postedBy = firstname+' '+lastname;
                return postedBy;
            }
        }

    }, 
    
    created() {
        this.getProjectcomment(this.params)
    },
    mounted() {          
        console.log('comment',this.FormData)
    },

    computed: {
        ...mapGetters('userDataModule', ['commentsData', 'userData']),
       
        allcomments(){
          return this.commentsData;
        },     
    },
    
    watch:{
        allcomments(){
            let result=this.allcomments;
            let index=0;
            Object.entries(result).reverse().forEach(([key, value]) => {
                this.comments[index] = value;
                index++;
            });
            console.log('comment',this.comments)
        },
        commentsData(){
            console.log(this.commentsData);
        }
    } 
}   
</script>
