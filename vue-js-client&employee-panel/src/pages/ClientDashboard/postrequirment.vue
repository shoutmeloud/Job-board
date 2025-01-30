<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <ClientLeftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Add Project Form</h3>
                        </div>
                        <div class="col-12 client_new_from post_input">
                            <div class="input_box">
                                <div class="project_title_saveing" v-if="draftLoader">
                                    <div class="project_title_saveing_box">
                                        <div class="savingicon">
                                            <span class="loadersaving"></span>
                                        </div>
                                        <p>Saving as draft..</p>
                                    </div>
                                </div>
                                <Form :validation-schema="schema" @submit="onSubmit">
                                    <div class="input_sub_box">
                                        <label for="">Project Title <span class="symbol_red">*</span></label>
                                        <Field name="project_title" v-model="title" type="text" placeholder="Enter Project Title" @keyup="saveAsDraft" @keydown="saveAsDraft" />
                                        <ErrorMessage class="text-danger" name="project_title" />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for="">Project Description :</label>
                                        <div class="post_editor">
                                            <QuillEditor theme="snow" contentType="html" v-model:content="editorContent" @keyup="saveAsDraft" @keydown="saveAsDraft"/>   
                                        </div>
                                    </div>
                                    <div class="input_sub_box input_pdf">
                                        <label for="">Upload Project <span class="symbol_red">*</span></label>
                                        <Field type="file" name="uploadfile" v-validate="'required'" @input="handleFileChange" multiple />
                                    </div>
                                    <div class="input_sub_box">
                                        <label for=""></label>
                                        <ErrorMessage class="text-danger" name="uploadfile" />
                                    </div>

                                    <div class="input_sub_box">
                                        <div class="heading_documents" v-if="draftFiles">
                                            <div v-if="draftFiles.length != 0">
                                                <div class="left">
                                                    <h2>All Attachments</h2>
                                                </div>
                                                <div class="right">
                                                    <button type="button" class="all_download" @click="createZip(draftFiles)">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="document_box">
                                            <div class="documents_subbox" v-for="(files, index) in draftFiles" :key="index" >
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
                                        <button type="button" @click="deleteDraft" class="discard" data-bs-toggle="tooltip" data-bs-placement="top" title="Discard" ref="info" data-bs-custom-class="tooltipnew" >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14px" height="14px"><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                                            Discard
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
import '@/assets/css/clientdashboard/clientdashboard.css'
import '@/assets/css/client/client.css'
import Header from '@/components/Main/Header.vue';
import ClientLeftside from '@/components/Main/Leftside.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {mapActions,mapState,mapMutations} from 'vuex';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import 'quill/dist/quill.snow.css';
import JSZip from 'jszip';
import {useToast} from 'vue-toast-notification';
const documenturl=import.meta.env.VITE_VUE_STORAGE_FILEPATH
export default {
    name: 'SettingPage',
    data() {
        return {
            schema: yup.object({
                project_title: yup.string().required('Project title field is required'),

                uploadfile: yup
                .mixed()
                .required('Please upload a file')
                .test('fileType', 'Invalid file type. Only PDF allowed.', (value) => {
                if (!value) return true; // Allow empty values (no file selected)
                const allowedTypes = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/jpeg','image/png','image/webp','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
                return allowedTypes.includes(value[0].type);
                }),
            }),
            selectedFiles:[],
            title:'',
            content:'',
            editorContent:'' ,
            draftdataId: '',
            draftFiles:[],
            draftLoader: false,
            delteFileData:{
                file:[],
                projectid:'',
            },
            hasAttachment:false,  
        };
    },
    components: {
        Header,
        ClientLeftside,
        Form,
        Field,
        ErrorMessage,
        QuillEditor
    },
    computed: {
        ...mapState('projectsDataModule', ['draftId','draftFile']),
        ...mapMutations('projectsDataModule', ['setDraftFiles']),   
    },
    methods: {
        ...mapActions('projectsDataModule', ['addProjects','addDraftProject','downloadTheCV','deleteDraftFile','deleteProjectFromDraft']),
        
        async onSubmit() {            
            const formData = new FormData();       
            formData.append('tableId', this.draftId);
            formData.append('projecttitle', this.title);
            formData.append('project_description', this.editorContent);
            formData.append('status', '0');
            this.addDraftProject(formData); 
            const $toast = useToast(); 
            const message = "Project Added successfully."         
            $toast.success(message , {
                // optional options Object
                position: 'bottom-right',
                duration: 3000,
            });    
            this.$router.push({ name: 'Projectlist' });

        },

        handleFileChange(event) {
            // Get the files from the event
            const files = event.target.files;

            // Reset the array before adding new files
            this.selectedFiles = [];

            // Loop through the files and add them to the array
            for (let i = 0; i < files.length; i++) {
                this.selectedFiles.push(files[i]);
            }
            this.saveAsDraft();

            setTimeout(() => {
               event.target.value = null;
            }, "2000");
        },
     
        saveAsDraft(){
            this.draftLoader = true;
            const formData = new FormData();
            for (let i = 0; i < this.selectedFiles.length; i++) {
                formData.append('files[]', this.selectedFiles[i]);
            }
            formData.append('tableId', this.draftId);
            formData.append('projecttitle', this.title);
            formData.append('project_description', this.editorContent);
            this.addDraftProject(formData); 

            setTimeout(() => {
               this.draftLoader = false;
            }, "2000");

            this.selectedFiles = [];
        },        

        async createZip(fileNames) {
            const zip = new JSZip();  
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
        
        // change thubnail based on the file type
        getImageSrc(file) {
            console.log(file)
            let fileName = file;
            // If file is an object, assume it has a 'name' property
            if (typeof file === 'object' && file.name) {
                fileName = file.name;
            }

            const extension = fileName.split('.').pop().toLowerCase();
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
        
        deleteFile(fileNameToRemove) {         

            const filesArray = Object.values(this.draftFiles);

            // Filter out the file to remove
            const filesAfterDelete = filesArray.filter(fileName => fileName !== fileNameToRemove);

            // Convert back to an object with numeric keys
            const updatedDraftFiles = {};
            filesAfterDelete.forEach((file, index) => {
                updatedDraftFiles[index] = file;
            });

            // Update this.draftFiles with the updated object
            this.draftFiles = updatedDraftFiles;

            console.log(this.draftFiles)

            this.delteFileData.file = this.draftFiles;
            this.delteFileData.projectid = this.draftdataId;
            // this.setDraftFiles(this.draftFiles);

            // Call the deleteDraftFile method
            this.deleteDraftFile(this.delteFileData);
        },

        downloadFile(fileName) {
            // console.log(fileName);
            this.downloadTheCV(fileName);
        },

        // delete the current draft project 
        deleteDraft(){
            console.log(this.draftdataId);
            this.deleteProjectFromDraft(this.draftdataId);
        },
    },
    watch:{
        draftId(){
            this.draftdataId = this.draftId;
              console.log(this.draftId);
        },

        draftFile(){
            this.hasAttachment = true;
            this.draftFiles = this.draftFile;
            console.log(this.draftFiles)
        }

    }
};
</script>