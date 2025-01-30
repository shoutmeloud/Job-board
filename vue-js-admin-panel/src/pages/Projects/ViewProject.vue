<template>
    <div class="dashboard_box dashboard_scroll">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <!-- <div class="page_name">
                            <h3>Project View 
                                <span :class="projectData.status == 1 ? 'green' : projectData.status == 0 ? 'yellow' : 'red'"> {{projectData.status == 1 ? "open" : projectData.status == 0 ? 'pending' : 'colsed' }}</span>
                            </h3>
                        </div> -->
                        <div class="row">
                            <div class="col-8 client_new_from post_input view_project">
                                <div class="div_sticky" style="padding-right: 15px;">
                                    <div class="page_name">
                                        <h3>Project View 
                                            <span :class="projectData.status == 1 ? 'Green' : projectData.status == 0 ? 'Yellow' : projectData.status == 2 ? 'red' : 'gray'"> {{projectData.status == 1 ? "Open" : projectData.status == 0 ? 'Pending' : projectData.status == 2 ? 'Colsed' : 'Draft'}}</span>
                                        </h3>
                                    </div>
                                    <div class="input_box" v-if="templatedisplay">
                                        <Form  @submit="addProjectData"> 
                                            <div class="input_sub_box">
                                                <label for="first_name">Client Name :</label>
                                                <span class="labelspan" v-if="projectData.user">
                                                    <!-- {{projectData.user.firstname}} -->
                                                    {{projectData.user.firstname+' '+projectData.user.lastname}}
                                                </span>
                                            </div>

                                            <div class="input_sub_box">
                                                <label for="email">Client Email :</label>
                                                <span class="labelspan" v-if="projectData.user">
                                                    {{projectData.user.email}}
                                                </span>
                                            </div>

                                            <div class="input_sub_box">
                                                <label for="first_name">Project Title :</label>
                                                <span class="labelspan" v-if="projectData.projecttitle">
                                                    {{projectData.projecttitle}}
                                                </span>
                                            </div>

                                            <div class="input_sub_box">
                                                <label for="email">Project Description :</label>
                                                <div v-html="projectData.projectdescription" readonly></div>
                                            </div>
                                         
                                            <div class="input_sub_box border_bottom">
                                                <label for="">Uploaded Document :</label>
                                            </div>
                                            <div class="input_sub_box">
                                                <div class="heading_documents">
                                                    <div class="left">
                                                        <h2>All Attachments</h2>
                                                    </div>
                                                    <div class="right">
                                                        <button type="button" class="all_download" @click="createZip">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="document_box four_boxes">
                                                    <!-- {{projectData.documentfile}} -->
                                                    <div class="documents_subbox" v-for="(file, index) in files" :key="index">
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

                                            <div class="row table_section table_select">
                                                <div class="col-12">
                                                    <div class="input_sub_box" v-if="this.options">
                                                        <label for="skills">Select Employee :</label>  
                                                        <div class="row">                                                
                                                            <div class="col-12 mb-4">
                                                                <multiselect
                                                                    v-model="employeeData.empWithCatAndSkills"
                                                                    :options="options"
                                                                    mode="tags"
                                                                    placeholder="Select Employee"
                                                                    :searchable="true"
                                                                    :close-on-select="false"
                                                                    @change="handleMultiselectChange"
                                                                    @remove="handleMultiselectRemove"
                                                                >
                                                                </multiselect>
                                                                <ErrorMessage name="skills" class="text-danger" />
                                                            </div>                                      
                                                            <div class="col-12">
                                                                <div class="table_div tableone">
                                                                    <table>
                                                                        <thead>
                                                                            <tr>
                                                                                <th rowspan="2">Name</th>
                                                                                <th colspan="2">Preference</th>
                                                                                <th rowspan="2">Action</th>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <th>Best</th>
                                                                                <th>Average</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr v-for="(item, index) in tableData" :key="index">
                                                                                <td>{{ item.name }}</td>
                                                                                <td>
                                                                                    <input v-if="item.best" checked type="radio" :name="'grade'+item.id" value="best"  @change="updateCheckboxState(item, 'best')" />
                                                                                    <input v-else type="radio" :name="'grade'+item.id" value="best"  @change="updateCheckboxState(item, 'best')" />
                                                                                
                                                                                </td>
                                                                                <td>
                                                                                    <input v-if="item.average" checked type="radio" :name="'grade'+item.id" value="average" @change="updateCheckboxState(item,'average')" />
                                                                                    <input v-else type="radio" :name="'grade'+item.id" value="average" @change="updateCheckboxState(item,'average')" />
                                                                                
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" @click="removeRow(index,item.id)">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16px" height="16px" fill="#21232c"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path></svg>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
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
    </div>
</template>

<script>
import '@/assets/css/client/client.css'
import '@/assets/css/clientdashboard/clientdashboard.css'
import '@/assets/css/table/table.css'
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';
import {mapActions, mapState} from 'vuex';
import {useRoute} from 'vue-router'
import Comments from "@/pages/projects/Comments/Comments.vue";
import {Form} from 'vee-validate';
import Multiselect from '@vueform/multiselect';
import JSZip from 'jszip';
const documenturl=import.meta.env.VITE_VUE_APP_ASSETSURL;
export default {
    name: 'viewProjectDetailsPage',
    components: {
        Header,
        Leftside,  
        Comments,
        Multiselect,
        Form
    },

    data() {     
        return {  
            projectData: {},        
            files: '',
            query:{
                slug:'',
            },    
            documenturl,
            employeeData:{         
                id:'',              
                empWithCatAndSkills: [],
                checkboxStates: [],
            },          
            tableData: [],
            templatedisplay:false,
        }
    },

    computed: {
        ...mapState('userDataModule', ['empDataWithCatAndSkill','individualprojectData']),
        allskils(){
            return this.empDataWithCatAndSkill;
        },
        options(){
            var empOptions = this.empDataWithCatAndSkill?.map(data => ({
                value: data.id.toString(), // Convert id to string if needed
                label: data.label
            })) || [];
            return empOptions;
        },
    },

    methods: { 
        ...mapActions('userDataModule', ['getIndividualProjectData','getEmployeeWithCatAndSkillsFromApi','updateProjectAssignEmployee','downloadTheCV']),   

        getSkillsString(skillsData) {
            if (!skillsData) {
                return ''; // Handle the case when skillsData is undefined or empty
            }
            return skillsData.map(skill => skill.skills).join(', ');
        },      
        
        getEmployeeRating(employeeId) {
            const selectedEmployeeRatings = JSON.parse(this.projectData.selectedemployee);
            // Find the rating for the given employeeId
            const ratingObject = selectedEmployeeRatings.find(obj => obj[employeeId]);

            // If found, return the corresponding rating value
            if (ratingObject) {
                return ratingObject[employeeId];
            }
            // Default value if not found
            return 'N/A';
        },

        // Function for multiple select heandling 
        handleMultiselectChange(selectedValues) {
            this.updateTableData(selectedValues);
        },
       
        handleMultiselectRemove(removedValue) {
            console.log(removedValue)
            const updatedValues = this.employeeData.empWithCatAndSkills.filter(
                (value) => value !== removedValue
            );           
            this.updateTableData(updatedValues);
        },

        // // this function is creating the table data
        // updateTableData(selectedValues) {
        //     console.log(this.tableData);
        //     // Clear existing data
        //        this.tableData = [];
        //     // Add new data
        //     selectedValues.forEach((selectedId) => {
        //           const selectedOption = this.options.find(
        //            (option) => option.value === selectedId
        //         );
        //         console.log(selectedOption);
        //         if (selectedOption) {
        //             const { value, label } = selectedOption;              
        //             const labelString = label; //`${label} (${category}) (${skills})`             
        //             // const tt=this.employeeData.checkboxStates.find(entry => entry.id === value)

        //             const checkboxStatesObjects = Object.values(this.employeeData.checkboxStates).map(entry => JSON.parse(entry));

        //             // Now use find on the parsed objects
        //             const tt = checkboxStatesObjects.find(entry => entry.id === parseInt(value));

        //             console.log(this.employeeData.checkboxStates)
        //             console.log(value);
        //             console.log(tt)
        //             if(tt){
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best: checkboxStatesObjects.find(entry => entry.id === parseInt(value))?.best || false,
        //                     average: checkboxStatesObjects.find(entry => entry.id === parseInt(value))?.average || false,
        //                 });
        //             }else{
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best: false,
        //                     average: false,
        //                 });
        //             }                
        //         }
        //     });

        //     // console.log(this.tableData);
        // },


        // this function is creating the table data
        // updateTableData(selectedValues) {
        //     console.log(this.tableData);
        //     // Clear existing data
        //        this.tableData = [];
        //     // Add new data
        //     selectedValues.forEach((selectedId) => {
        //         const selectedOption = this.options.find(
        //            (option) => option.value === selectedId
        //         );
        //         // console.log(selectedOption);
        //         if (selectedOption) {
        //             const { value, label } = selectedOption;              
        //             const labelString = label; //`${label} (${category}) (${skills})`             
        //             // const checkboxStatesObjects = Object.values(this.employeeData.checkboxStates).map(entry => JSON.parse(entry));

        //             // Now use find on the parsed objects
        //             const tt = this.employeeData.checkboxStates.find(entry => entry.id === value);
           
        //             if(tt){
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best: this.employeeData.checkboxStates.find(entry => entry.id === value)?.best || false,
        //                     average: this.employeeData.checkboxStates.find(entry => entry.id === value)?.average || false,
        //                 });
        //             }else{
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best: false,
        //                     average: false,
        //                 });
        //             }                
        //         }
        //     });

        //     console.log(this.tableData);
        // },



        // this function is store the table checkbox values
        // updateCheckboxState(item, checkboxType) {
        //     const itemId = item.id;

        //     // Create the checkboxStates array if it doesn't exist
        //     if (!this.employeeData.checkboxStates) {
        //         this.employeeData.checkboxStates = [];
        //     }

        //     // check the id is exist into the checkboxState sarray
        //     const objIndex = this.employeeData.checkboxStates.findIndex((obj => obj.id == itemId));
           
        //     if(objIndex!== -1){
        //         // creating dynamic object 
        //         var obj = [];
        //         obj['id'] = itemId;
        //         obj[checkboxType] = true;
        //         this.employeeData.checkboxStates[objIndex]=obj;
        //     }else{
        //         this.employeeData.checkboxStates.push({
        //             id: itemId,
        //             [checkboxType]: true,
        //         }); 
        //     }
        //     // console.log(this.employeeData.checkboxStates)
        // },

        // this function is for remove row from the table 
        // removeRow(index,itemId) {
        //     var removetableData =  this.tableData.filter(item => item.id !== itemId);
        //     this.tableData = removetableData;
        //     var removecheckboxStates =  this.employeeData.checkboxStates.filter(item => item.id !== itemId);
        //     this.employeeData.checkboxStates = removecheckboxStates;
        //     var removeEmployee = this.employeeData.empWithCatAndSkills.filter(item => item !== itemId);
        //     this.employeeData.empWithCatAndSkills = removeEmployee;            
        // },

        // this function is creating the table data
        updateTableData(selectedValues) {
            console.log(this.tableData);
            // Clear existing data
               this.tableData = [];
            // Add new data
            selectedValues.forEach((selectedId) => {
                  const selectedOption = this.options.find(
                   (option) => option.value === selectedId
                );
                // console.log(selectedOption);
                if (selectedOption) {
                    const { value, label } = selectedOption;              
                    const labelString = label; //`${label} (${category}) (${skills})`             
                    // const checkboxStatesObjects = Object.values(this.employeeData.checkboxStates).map(entry => JSON.parse(entry));

                    // Now use find on the parsed objects
                    const tt = this.employeeData.checkboxStates.find(entry => entry.id === value);
           
                    if(tt){
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best: this.employeeData.checkboxStates.find(entry => entry.id === value)?.best || false,
                            average: this.employeeData.checkboxStates.find(entry => entry.id === value)?.average || false,
                        });
                    }else{
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best: false,
                            average: false,
                        });
                    }                
                }
            });

            console.log(this.tableData);
        },

        // this function is store the table checkbox values
        updateCheckboxState(item, checkboxType) {
            const itemId = item.id;
            console.log(item)
            console.log(checkboxType);
            // Create the checkboxStates array if it doesn't exist
            if (!this.employeeData.checkboxStates) {
                this.employeeData.checkboxStates = [];
            }

            // check the id is exist into the checkboxState sarray
            const objIndex = this.employeeData.checkboxStates.findIndex((obj => obj.id == itemId));

            if(objIndex!== -1){
                console.log(1)
                // creating dynamic object 
                var obj = [];
                obj['id'] = itemId;
                obj[checkboxType] = true;
                this.employeeData.checkboxStates[objIndex]=obj;
            }else{
                console.log(2)
                this.employeeData.checkboxStates.push({
                    id: itemId,
                    [checkboxType]: true,
                }); 
            }
            console.log(this.employeeData.checkboxStates)
            console.log(this.tableData)
        },


        // this function is for remove row from the table 
        removeRow(index,itemId) {
            var removetableData =  this.tableData.filter(item => item.id !== itemId);
            this.tableData = removetableData;
            var removecheckboxStates =  this.employeeData.checkboxStates.filter(item => item.id !== itemId);
            this.employeeData.checkboxStates = removecheckboxStates;
            var removeEmployee = this.employeeData.empWithCatAndSkills.filter(item => item !== itemId);
            this.employeeData.empWithCatAndSkills = removeEmployee;        
        },



        async addProjectData(){
            // console.log(this.tableData);
            console.log(this.employeeData);

            const formData = new FormData();
            formData.append('id', this.employeeData.id);         
            formData.append('employeeids', JSON.stringify(this.employeeData.empWithCatAndSkills));
            formData.append('empratingvalues', JSON.stringify(this.employeeData.checkboxStates));
            this.updateProjectAssignEmployee(formData);
        },

        downloadFile(fileName) {
            // console.log(fileName);
            this.downloadTheCV(fileName);
        },

        async createZip() {
            const zip = new JSZip();
            const fileNames = this.files;
         
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
        
        empDataWithCatAndSkillNew(){
            this.tableData = [];
            let selectedValues=this.employeeData.empWithCatAndSkills;

            let empOptions = this.$store.state.userDataModule.empDataWithCatAndSkill?.map(data => ({
                value: data.id.toString(), // Convert id to string if needed
                label: data.label
            })) || [];

            // console.log(empOptions)
            // console.log(selectedValues)
            selectedValues.forEach((selectedId) => {                    
                const selectedOption = empOptions.find(
                   (option) => option.value == selectedId
                );
                // console.log(selectedOption)

                if (selectedOption) {
                    const { value, label } = selectedOption;              
                    const labelString = label; //`${label} (${category}) (${skills})`             
                   // const tt=this.employeeData.checkboxStates.find(entry => entry.id === value)
                    // const checkboxStatesArray = Object.values(this.employeeData.checkboxStates).map(JSON.parse);
                    // const tt = this.employeeData.checkboxStates;
                    const tt = this.employeeData.checkboxStates.find(entry => entry.id === value);
                  
                    if(tt){
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best:  this.employeeData.checkboxStates.find(entry => entry.id == value)?.best || false,
                            average:  this.employeeData.checkboxStates.find(entry => entry.id == value)?.average || false,
                        });
                    }else{
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best: false,
                            average: false,
                        });
                    }                     
                } 
            }); 

            // console.log(this.empDataWithCatAndSkill)
            // console.log(this.tableData)
        }

    },

    created(){
        const route=useRoute();
        let paramdata=route.params.slug;   
        this.getIndividualProjectData(paramdata);
        this.getEmployeeWithCatAndSkillsFromApi();       
        console.log(this.individualprojectData);
      
    },  
    watch: {
        individualprojectData: async function() { 
            this.projectData = this.individualprojectData[0];
            this.files = JSON.parse(this.individualprojectData[0].documentfile);
            console.log(this.projectData)
            this.employeeData.id = this.projectData.id;          
            console.log(this.projectData.selectedemployee);
            if( this.projectData.selectedemployee.length > 0){
                var datalist=this.projectData.selectedemployee;
                    datalist = JSON.parse(datalist);
                datalist.forEach(item => {
                    let emp_id=Object.keys(item)[0];
                    let emp_val=item[emp_id];           
                    let data = {"id": emp_id, [emp_val]: true};
                    console.log(data)        
                    this.employeeData.empWithCatAndSkills.push(emp_id);
                    this.employeeData.checkboxStates.push({"id": emp_id, [emp_val]: true});
                });
            }
            if(this.employeeData.empWithCatAndSkills.length > 0){
                this.empDataWithCatAndSkillNew();
            }
            console.log(this.$store.state.userDataModule.empDataWithCatAndSkill);
            console.log(this.employeeData);
            this.templatedisplay=true;
        },
        empDataWithCatAndSkill(){
            this.tableData = [];
            let selectedValues=this.employeeData.empWithCatAndSkills

            let empOptions = this.empDataWithCatAndSkill?.map(data => ({
                value: data.id.toString(), // Convert id to string if needed
                label: data.label
            })) || [];

            // console.log(empOptions)
            // console.log(selectedValues)
            selectedValues.forEach((selectedId) => {                    
                const selectedOption = empOptions.find(
                   (option) => option.value == selectedId
                );
                // console.log(selectedOption)

                if (selectedOption) {
                    const { value, label } = selectedOption;              
                    const labelString = label; //`${label} (${category}) (${skills})`             
                    // const tt=this.employeeData.checkboxStates.find(entry => entry.id === value)
                    // const checkboxStatesArray = Object.values(this.employeeData.checkboxStates).map(JSON.parse);
                    // const tt = this.employeeData.checkboxStates;
                    const tt = this.employeeData.checkboxStates.find(entry => entry.id === value);

                    if(tt){
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best:  this.employeeData.checkboxStates.find(entry => entry.id == value)?.best || false,
                            average:  this.employeeData.checkboxStates.find(entry => entry.id == value)?.average || false,
                        });
                    }else{
                        this.tableData.push({
                            name: labelString,
                            id: value,
                            best: false,
                            average: false,
                        });
                    }                     
                } 
            }); 

            // console.log(this.empDataWithCatAndSkill)
            console.log(this.tableData)
            // console.log(this.employeeData.checkboxStates)
        },
      
        // allskils(){
        //     var selectedValues=this.employeeData.empWithCatAndSkills

        //     var empOptions = this.allskils?.map(data => ({
        //         value: data.id.toString(), // Convert id to string if needed
        //         label: data.label
        //     })) || [];

        //     console.log(empOptions)
        //     selectedValues.forEach((selectedId) => {                    
        //         const selectedOption = empOptions.find(
        //            (option) => option.value == selectedId
        //         );

        //         if (selectedOption) {
        //             const { value, label } = selectedOption;              
        //             const labelString = label; //`${label} (${category}) (${skills})`             
        //            // const tt=this.employeeData.checkboxStates.find(entry => entry.id === value)

        //             const checkboxStatesArray = this.employeeData.checkboxStates.map(JSON.parse);
        //             const tt = checkboxStatesArray.find(entry => entry.id == value);
        //             if(tt){
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best:  checkboxStatesArray.find(entry => entry.id == value)?.best || false,
        //                     average:  checkboxStatesArray.find(entry => entry.id == value)?.average || false,
        //                 });
        //             }else{
        //                 this.tableData.push({
        //                     name: labelString,
        //                     id: value,
        //                     best: false,
        //                     average: false,
        //                 });
        //             }                     
        //         } 
        //     }); 

        //     console.log(this.tableData)
        // }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style> 