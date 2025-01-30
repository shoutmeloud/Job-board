<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <ClientLeftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="d-flex">
                            <div class="col-8 client_new_from post_input view_project">
                                <div class="div_sticky">
                                    <div class="page_name">
                                        <h3>Project Details
                                            <span v-if="details.status">
                                                <span :class="details.status == 1 ? 'green' : details.status == 0 ? 'yellow' : details.status==2 ?  'red' : 'gray'">
                                                    {{prosectstatus[details.status]}}
                                                </span>
                                            </span>
                                        </h3>
                                    </div>
                                    <div class="input_box">
                                        <form v-if="details">                                            
                                            <div class="input_sub_box">
                                                <label for="">Project Title :</label>
                                                <span class="project_span">
                                                    {{details.projecttitle}}
                                                </span>
                                            </div>
                                            
                                            <div class="input_sub_box">
                                                <label for="">Project Details :</label>
                                                <div class="project_span">
                                                    <div class="project_scroll" v-html="details.projectdescription"></div>
                                                </div>
                                            </div>

                                            <div class="input_sub_box">
                                                <label for="">Date & Time :</label>
                                                <span class="project_span">
                                                    {{moment(details.created_at).format("MM-DD-YYYY hh:mm:ss")}}
                                                </span>
                                            </div>

                                            <div class="input_sub_box border_document" v-if="details.documentfile">
                                                <label for="">Project Document :</label>
                                                <!-- <button type="button" class="pdf_vieweer" data-bs-toggle="modal" data-bs-target="#exampleModal">View Document</button> -->
                                            </div>

                                            <div class="input_sub_box border_document border_bottom_div">
                                                <div class="heading_documents">
                                                    <div class="left">
                                                        <h2>All Attachments</h2>
                                                    </div>
                                                    <div class="right">
                                                        <button type="button" class="all_download"  @click="createZip">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="document_box four_boxes">
                                                    <!-- {{projectData.documentfile}} -->
                                                    <div class="documents_subbox" v-for="(file, index) in details.documentfile" :key="index">
                                                        <!-- {{files}} -->
                                                        <div class="box_position" >
                                                            <a class="doc_main_box" :href="documenturl+'uploads/'+file" target="_blank">
                                                                <div class="documents_border">
                                                                    <div class="image_box">
                                                                        <img :src="getImageSrc(file)" alt="documents" />
                                                                    </div>
                                                                    <div class="image_textes">
                                                                    <h2>{{file}}</h2>    
                                                                    </div>    
                                                                </div>
                                                                <div class="image_text">
                                                                    <h4>{{file}}</h4>
                                                                </div>
                                                            </a>   
                                                            <div class="text_icon">
                                                                <button class="download-button" type="button" @click="downloadFile(file)">
                                                                    <svg fill="#000000" width="16px" height="16px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 14.75h11V16h-11zm.39-5.45 4.27 3.88a1.26 1.26 0 0 0 1.68 0l4.27-3.88a1.25 1.25 0 0 0-.84-2.18H9.8V1.25A1.25 1.25 0 0 0 8.55 0h-1.1A1.25 1.25 0 0 0 6.2 1.25v5.87H3.73a1.25 1.25 0 0 0-.84 2.18zm.84-.93h3.72V1.25h1.1v7.12h3.72L8 12.25 3.73 8.37z"/></svg>
                                                                </button>
                                                            </div>
                                                        </div>     
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="row table_section" v-if="details.documentfile">
                                                <label for="">Download Document:</label>
                                                <embed :src="documenturl+'uploads/'+details.documentfile" width="100%" height="600" />
                                                <a :href="documenturl+'uploads/'+details[0].documentfile">Download</a>
                                            </div> -->

                                            <div class="input_sub_box border_document">
                                                <label for="">Employees Assigned :</label>
                                            </div>

                                            <div class=" input_profilebox">
                                                <div class="col-md-12">
                                                  
                                                    <div v-if="employees" class="employe_flex">
                                                        <div v-for="(userdata, index) in employees.userdetails" :key="index" class="toggle-button1 d-flex employe_profiles" @click="toggleModel(userdata.employee_profile.user_id)">
                                                            <div class="employ_boxdiv">
                                                                <div class="image">                                                           
                                                                    <img v-if="userdata.employee_profile.profile_image" :src="documenturl+'uploads/'+userdata.employee_profile.profile_image" alt="profile-image"/>
                                                                    <img v-else src="@/assets/images/client2.png" alt=""/>    
                                                                </div>
                                                                <div class="text" v-if="userdata">
                                                                    <h3>{{userdata.firstname}} {{userdata.lastname}}</h3> 
                                                                    <p v-if="userdata.employee_profile">{{userdata.employee_profile.category.category}}</p>
                                                                    <h4 v-if="0 < skillarraydara.length">{{ skillarraydara.find(entry => Object.keys(entry)[0] == userdata.id.toString())[userdata.id] }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                            
                                        </form>
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

    </div>

 
    <div class="input_profilebox">
        <div class="profile-model-container" :class="{ open: isOpen }">
            <div class="profile-content">
                <div v-if="modalshow" >
                    <div class="modal_name">
                        <h3>Employees Assigned</h3>
                        <button @click="closeModel">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16px" height="16px" fill="#212121"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                        </button>
                    </div>
                    <div class="image_box" v-if="this.modaldata[0].employee_profile">
                        <div class="img-crcle">
                            <img v-if="this.modaldata[0].employee_profile.profile_image" :src="documenturl+'uploads/'+this.modaldata[0].employee_profile.profile_image" alt=""/>
                            <img v-else src="@/assets/images/client2.png" alt=""/>
                        </div>
                        <div class="prfl-des">
                            <h3>{{this.modaldata[0].firstname}} {{this.modaldata[0].lastname}}</h3>
                            <p>{{this.modaldata[0].employee_profile.category.category}}</p>
                        </div>
                    </div>
                    <div class="skills-sec" v-if="mmodalkillsset">
                        
                        <h4>Preference</h4>
                        <p>{{ employeepreference}}</p>
                    </div>
                    <div class="skills-sec" v-if="mmodalkillsset">
                        <h4>Skills</h4>
                        <ul>
                            <li  v-for="(skilldata, index) in mmodalkillsset" :key="index">{{skilldata.skills}}</li>
                        </ul>
                    </div>
                    <div class="skills-sec">
                        <h4>About</h4>
                        <p>{{this.modaldata[0].employee_profile.about}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="input_profilebox_background" :class="{ open: isOpen }">
        <div class="input_profilebox_background_close" @click="closeModel"></div>
    </div>
</template>

<script>
import '@/assets/css/clientdashboard/clientdashboard.css'
import '@/assets/css/client/client.css';
import '@/assets/css/table/table.css'
import Header from '@/components/Main/Header.vue';
import ClientLeftside from '@/components/Main/Leftside.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import Multiselect from '@vueform/multiselect'
import moment from "moment";
import Comments from "@/pages/projects/Comments/Comments.vue";
import {mapActions,mapGetters,mapState} from 'vuex';
import JSZip from 'jszip';
const documenturl=import.meta.env.VITE_VUE_STORAGE_FILEPATH

export default {
    name: 'SettingPage',
    components: {
        Header,
        ClientLeftside,
        QuillEditor,
        Multiselect,
        Comments 
    },

    data() {
        return {
            isOpen: false,
            selectedValue: "",
            options: ["Option 1", "Option 2", "Option 3"],
            tableData: [],
            newComment: '',
            comments: [],
            documenturl,
            modaldata:{},
            modalshow:false,
            details:{},
            mmodalkillsset:{},
            employeepreference:{},
            skillarraydara:{},
            prosectstatus:['Pending','Open','Closed','Draft'],
            moment:moment,
        };
    },
   
    methods: {
        ...mapActions('projectsDataModule', ['getProjecthistory','downloadTheCV']),
        toggleModel(id) {
            
            this.isOpen = !this.isOpen;
            this.modaldata=this.employees.userdetails.filter(employeedata => employeedata.id==id);  
            let empskilllist=this.employees.userskillsset;
            this.mmodalkillsset = Object.fromEntries(Object.entries(empskilllist).filter(([key]) => key.includes(id)));
            this.mmodalkillsset=this.mmodalkillsset[id];        
                       
            let entryWithId = this.skillarraydara.find(entry => Object.keys(entry)[0] == id.toString());
            let valueForId = entryWithId ? entryWithId[id] : undefined;
            this.employeepreference=valueForId;

            
        },
        closeModel(){
            this.isOpen = false;
        },

        handleMultiselectChange(newVal, oldVal) {
        if (newVal !== null && newVal !== "") {
                const existingIndex = this.tableData.findIndex(item => item.name === newVal);
                if (existingIndex !== -1) {
                    this.tableData[existingIndex].best = false;
                    this.tableData[existingIndex].average = false;
                } else {
                  this.tableData.push({ name: newVal, best: false, average: false });
                }
                this.selectedValue = "";
            }
        },
   

        downloadFile(fileName) {
            // console.log(fileName);
            this.downloadTheCV(fileName);
        },

        async createZip() {
            const zip = new JSZip();
            const fileNames = this.details.documentfile 
         
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

      
        submitComment() {
            const now = new Date();
            const date = now.toLocaleDateString();
            const time = now.toLocaleTimeString();
            this.comments.unshift({
                text: this.newComment,
                date: date,
                time: time
            });

            this.newComment = '';
        }
    },


    computed: {
        ...mapGetters('projectsDataModule', ['ProjectDetails','ProjectemployeDetails']),
        // details(){
        //     console.log('ProjectDetails',this.ProjectDetails);
        //     return this.ProjectDetails
        // },
       
        employees(){
            return this.ProjectemployeDetails
        },
       
    },

    created() {
        var querydata={'id':this.$route.params.slug}
        this.getProjecthistory(querydata)
    } ,
    mounted(){
        //console.log('ProjectDetails');
    } ,

    watch:{
        ProjectDetails(){            
            this.details=this.ProjectDetails;
            this.details.documentfile = JSON.parse(this.ProjectDetails.documentfile);
            let arraydata = this.details.selectedemployee;
            if(arraydata!=null)
            this.skillarraydara = JSON.parse(arraydata.replace(/'/g, '"')); 
        },
        selectedValue: "handleMultiselectChange",
        modaldata(){
            console.log( this.employeepreference);
            this.modalshow=true
        }
    }
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>
 /* .img-crl{
    width: 100px;
    height: 100px;
    border-radius: 100%;
    margin: 10px auto;
    display: block;
 }
 .img-crl img{
    width: 100%;
    height: 100%;
    object-fit: cover;
 }

 .profile-model-container {
  position: fixed;
 
  right: 0; 
  width: 400px;
  bottom: -600px;
  height: 600px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  transition: bottom 0.3s ease-out;
  z-index: 99;
}

.profile-content {
  padding: 20px;
}

.prfl-des{
    margin-left: 10px;
}

.profile-model-container.open {
  bottom: 0;
}

.skills-sec{
    padding: 40px 0;
}
.skills-sec li{
    float: left;
    list-style: inside disc;
    padding: 0 10px 0 0;

}

.skills-sec ul{
    padding-left: 0;
}

.profile-content h4{
    font-size: 22px;
    line-height: 26px;
} */

</style>

