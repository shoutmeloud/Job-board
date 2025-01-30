   <template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <ClientLeftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="d-flex">
                            <div class="col-8 client_new_from post_input">
                                <div class="edit_sticky">
                                    <div class="page_name">
                                        <h3>
                                            Edit Project
                                            <span v-if="projectData.status">
                                               <span :class="projectData.status == 1 ? 'green' : projectData.status == 0 ? 'yellow' : projectData.status == 2 ? 'red' : 'gray'">{{ projectData.status == 1 ? 'Open' : projectData.status == 0 ? 'Pending' : projectData.status == 2 ? 'Closed' : 'Draft'}}</span>
                                            </span>
                                        </h3>
                                    </div>
                                    <div class="input_box">
                                        <div class="project_title_saveing"  v-if="draftLoader">
                                            <div class="project_title_saveing_box">
                                                <div class="savingicon">
                                                    <span class="loadersaving"></span>
                                                </div>
                                                <p>Saving..</p>
                                            </div>
                                        </div>
                                        <Form :validation-schema="schema" @submit="EditProjectData">
                                            <div class="input_sub_box">
                                                <label for="">Project Title :</label>
                                                <Field name="project_title" type="text" placeholder="Enter Project Title" v-model="projectData.projecttitle"  />
                                                <ErrorMessage name="project_title" class="text-danger" />
                                            </div>

                                            <div class="input_sub_box">
                                                <label for="">Project Details :</label>
                                                <div class="post_editor">                                                  
                                                    <QuillEditor ref="quillEditorRefTemplate" v-model:content="projectData.project_description" toolbar="essential" contentType="html" />
                                                </div>
                                                <ErrorMessage name="project_description" class="text-danger" />
                                            </div>
                                                                                        
                                            <div class="input_sub_box input_pdf">
                                                <label for="uploadfile">Upload Document :</label>
                                                <Field type="file" name="uploadfile" @input="handleFileChange" multiple/>
                                                <ErrorMessage name="uploadfile" class="text-danger"/>
                                            </div>

                                            <div class="input_sub_box">
                                                <div class="heading_documents">
                                                    <div class="left">
                                                        <h2>All Attachments</h2>
                                                    </div>
                                                    <div class="right">
                                                        <button type="button" class="all_download">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div class="document_box four_boxes">                                               
                                                    <div class="documents_subbox" v-for="(files, index) in projectData.documentfile" :key="index">
                                                        <div class="box_position">
                                                            <a class="doc_main_box" :href="documenturl+'uploads/'+files" target="_blank">
                                                                <div class="documents_border">
                                                                    <div class="image_box">
                                                                        <img :src="getImageSrc(files)" alt="documents" />
                                                                    </div>
                                                                    <div class="image_textes">
                                                                    <h2>{{files}}</h2>    
                                                                    </div>    
                                                                </div>
                                                                <div class="image_text">
                                                                    <h4>{{files}}</h4>
                                                                </div>
                                                            </a>   
                                                            <div class="text_icon">
                                                                <button class="download-button" type="button" @click="downloadFile(files)">
                                                                    <svg fill="#000000" width="16px" height="16px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 14.75h11V16h-11zm.39-5.45 4.27 3.88a1.26 1.26 0 0 0 1.68 0l4.27-3.88a1.25 1.25 0 0 0-.84-2.18H9.8V1.25A1.25 1.25 0 0 0 8.55 0h-1.1A1.25 1.25 0 0 0 6.2 1.25v5.87H3.73a1.25 1.25 0 0 0-.84 2.18zm.84-.93h3.72V1.25h1.1v7.12h3.72L8 12.25 3.73 8.37z"/></svg>
                                                                </button>
                                                                <button @click="deleteFile(files)" class="download-button" type="button">
                                                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>     
                                                    </div>                                                
                                                </div>
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
                            <div class="col-4">
                                <Comments/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal_pdf fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="closes_btn">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal_body">
                        <!-- {{employeeData.documentfile}} -->
                        <embed :src="documenturl+'uploads/'+projectData.documentfile" width="100%" height="600" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
import '@/assets/css/clientdashboard/clientdashboard.css'
import '@/assets/css/client/client.css';
import '@/assets/css/table/table.css'
import Header from '@/components/Main/Header.vue';
import ClientLeftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState} from 'vuex';
import { Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import 'quill/dist/quill.snow.css';
import {useRoute} from 'vue-router';
import Comments from "@/pages/projects/Comments/Comments.vue";
const documenturl=import.meta.env.VITE_VUE_STORAGE_FILEPATH

export default {
    name: 'addProjectPage',
    components: {
        Header,
        Field,
        Form,
        ErrorMessage,
        QuillEditor,
        Comments,
        ClientLeftside
    },

    data() {
        const schema = yup.object({        
            project_title: yup.string().required('Project title field is required').trim(),
        });

        return {       
            projectData: [],      
            documenturl,
            uploadfile:[],
            schema,      
            tableData: [],
            draftLoader: false,
            delteFileData:{
                file:'',
                projectid:'',
            }
        }
    },

    computed: {
        ...mapState('projectsDataModule', ['ProjectDetails','draftFile']),       
    },

    methods: {     
        ...mapActions('projectsDataModule', ['updateProjectData','getProjecthistory','addDraftProject','downloadTheCV','deleteDraftFile']),  
       
        // Function for upload file heandling 
        handleFileChange(event) {
            // Get the files from the event
            const files = event.target.files;
            // Reset the array before adding new files
            this.uploadfile = [];
            // Loop through the files and add them to the array
            for (let i = 0; i < files.length; i++) {
                this.uploadfile.push(files[i]);
            }
            this.saveAsDraft();
            setTimeout(() => {
               event.target.value = null;
            }, "2000");
        },
      
        downloadFile(fileName) {
            this.downloadTheCV(fileName);
        },

        deleteFile(fileNameToRemove){
            console.log(fileNameToRemove);    
            var filesafterDelete = this.projectData.documentfile.filter(fileName => fileName !== fileNameToRemove);
            this.projectData.documentfile = filesafterDelete;
            this.delteFileData.file = this.projectData.documentfile
            this.delteFileData.projectid = this.projectData.id
            this.deleteDraftFile(this.delteFileData);
        },

        async createZip() {
            const zip = new JSZip();
            const fileNames = this.employeeData.document;
          
            // Loop through the file names
            for (const fileName of fileNames) {
                try {
                    // Fetch each file (assuming they are accessible via URL)
                    const response = await fetch(`https://jobboard.works-reddensoft.com/webapi/storage/app/public/uploads/${fileName}`);
                    if (!response.ok) {
                        console.error(`Failed to fetch file: ${fileName}`);
                        continue;
                    }
                    
                    const blob = await response.blob();

                    // Add each file to the zip
                    // Ensure the file extension is added
                    const fileExtension = fileName.split('.').pop();
                    zip.file(`${fileName}.${fileExtension}`, blob);
                } catch (error) {
                    console.error(`Error fetching file: ${fileName}`, error);
                }
            }

            // Generate the zip
            zip.generateAsync({ type: "blob" }).then((content) => {
                // Save the zip file
                const zipBlob = new Blob([content], { type: "application/zip" });
                const zipUrl = URL.createObjectURL(zipBlob);

                // Create a link and trigger download
                const link = document.createElement('a');
                link.href = zipUrl;
                link.download = 'files.zip';
                link.click();

                // Clean up
                URL.revokeObjectURL(zipUrl);
            });
        },

        getImageSrc(file) {
            const extension = file.split('.').pop().toLowerCase();
            if (extension === 'pdf') {
                return `../../src/assets/images/documents.png`; // Change to the path of your PDF icon
            } else if (extension === 'doc' || extension === 'docx') {
                return `../../src/assets/images/documents2.png`; // Change to the path of your Word icon
            } else if (extension === 'xls' || extension === 'xlsx') {
                return `../../src/assets/images/documents1.png`; // Change to the path of your Excel icon
            } else {
                return `${documenturl}uploads/${file}`; // Default icon for other file types
            }
        },

        saveAsDraft(){
            this.draftLoader = true;
            const formData = new FormData();
            for (let i = 0; i < this.uploadfile.length; i++) {
                formData.append('files[]', this.uploadfile[i]);
            }
            formData.append('tableId',  this.projectData.id);          
            this.addDraftProject(formData); 

            setTimeout(() => {
               this.draftLoader = false;
            }, "2000");

            this.projectData.documentfile = this.draftFile
        },        

        async EditProjectData(){
            const formData = new FormData();
            formData.append('id', this.projectData.id);
            formData.append('currentuserid', this.projectData.client_id);
            formData.append('projecttitle', this.projectData.projecttitle);
            formData.append('project_description', this.projectData.project_description);          
            this.updateProjectData(formData);
        },
    },

    created(){ 
        const route=useRoute();   
        var querydata={'id':this.$route.params.slug}
        this.getProjecthistory(querydata)
    },

    watch: {
        ProjectDetails: async function() { 
            this.projectData = this.ProjectDetails;       
            this.projectData.documentfile = JSON.parse(this.ProjectDetails.documentfile)  
        },
        draftFile(){
            this.projectData.documentfile = this.draftFile
        }
    }
    
}
</script>


