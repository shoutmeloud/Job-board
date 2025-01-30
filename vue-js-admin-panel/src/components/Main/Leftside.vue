<template>
    <div class="left_side">
        <div class="one_box">
            <div class="name d-flex justify-content-between align-items-center">
                <div class="img d-flex align-items-center">
                    <router-link to="/dashboard">
                        <img src="@/assets/images/logo.png" alt="">
                    </router-link>
                    <div class="text">
                        <h3>{{sitename}}</h3>
                        <p>{{userplane}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="scrool_box">
            <div class="two_box">
                <div class="setting_div">
                    <router-link to="/dashboard">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"></path></svg>
                        </span>
                        Dashboard
                    </router-link>
                </div>
                <div class="accordion" id="accordionain">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>
                                    <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 477.297 477.297" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M42.85,358.075c0-24.138,0-306.758,0-330.917c23.9,0,278.867,0,302.767,0c0,8.542,0,49.44,0,99.722
                                                    c5.846-1.079,11.842-1.812,17.99-1.812c3.149,0,6.126,0.647,9.232,0.928V0H15.649v385.233h224.638v-27.158
                                                    C158.534,358.075,57.475,358.075,42.85,358.075z"/>
                                                <path d="M81.527,206.842h184.495c1.812-10.16,5.393-19.608,10.095-28.452H81.527V206.842z"/>
                                                <rect x="81.527" y="89.432" width="225.372" height="28.452"/>
                                                <path d="M81.527,295.822h191.268c5.112-3.106,10.57-5.63,16.415-7.183c-5.544-6.45-10.095-13.697-13.978-21.269H81.527V295.822z"
                                                    />
                                                <path d="M363.629,298.669c41.071,0,74.16-33.197,74.16-74.139c0-40.984-33.09-74.16-74.16-74.16
                                                    c-40.898,0-74.009,33.176-74.009,74.16C289.62,265.472,322.731,298.669,363.629,298.669z"/>
                                                <path d="M423.143,310.706H304.288c-21.226,0-38.612,19.457-38.612,43.422v119.33c0,1.316,0.604,2.481,0.69,3.84h194.59
                                                    c0.086-1.337,0.69-2.524,0.69-3.84v-119.33C461.733,330.227,444.39,310.706,423.143,310.706z"/>
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                                Client Worksheet
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionain">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <router-link to="/add-client">Add New</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/client-list">List</router-link>
                                    </li>
                                </ul>        
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <span>
                                    <svg height="800px" width="800px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 512 512"  xml:space="preserve">
                                    <g>
                                        <path class="st0" d="M256.008,411.524c54.5,0,91.968-7.079,92.54-13.881c2.373-28.421-34.508-43.262-49.381-48.834
                                            c-7.976-2.984-19.588-11.69-19.588-17.103c0-3.587,0-8.071,0-14.214c4.611-5.119,8.095-15.532,10.183-27.317
                                            c4.857-1.738,7.627-4.524,11.095-16.65c3.69-12.93-5.548-12.5-5.548-12.5c7.468-24.715-2.357-47.944-18.825-46.246
                                            c-11.358-19.857-49.397,4.54-61.31,2.841c0,6.818,2.834,11.92,2.834,11.92c-4.143,7.882-2.548,23.564-1.389,31.485
                                            c-0.667,0-9.016,0.079-5.468,12.5c3.452,12.126,6.23,14.912,11.088,16.65c2.079,11.786,5.571,22.198,10.198,27.317
                                            c0,6.143,0,10.627,0,14.214c0,5.413-12.35,14.548-19.611,17.103c-14.953,5.262-51.746,20.413-49.373,48.834
                                            C164.024,404.444,201.491,411.524,256.008,411.524z"/>
                                        <path class="st0" d="M404.976,56.889h-75.833v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508
                                            c-31.366,0-56.889-25.524-56.889-56.889V56.889h-75.834c-25.444,0-46.071,20.627-46.071,46.071v362.969
                                            c0,25.444,20.627,46.071,46.071,46.071h297.952c25.445,0,46.072-20.627,46.072-46.071V102.96
                                            C451.048,77.516,430.421,56.889,404.976,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z"/>
                                        <path class="st0" d="M239.746,113.778h32.508c22.405,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0
                                            h-32.508c-22.406,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635
                                            c0-4.492,3.634-8.127,8.127-8.127h32.508c4.492,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.635,8.127-8.127,8.127h-32.508
                                            c-4.493,0-8.127-3.635-8.127-8.127V40.635z"/>
                                    </g>
                                    </svg>
                                </span>
                                Employee Worksheet
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionain">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <router-link to="/add-employee">Add New</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/employee-list">List</router-link>
                                    </li>
                                    <!-- <li>
                                        <router-link to="/">Catagories</router-link>
                                    </li> -->
                                </ul> 
                            </div>
                        </div>
                    </div>
                  
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <span>
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke="#000000" stroke-width="2" d="M4.99787498,6.99999999 L4.99787498,0.999999992 L19.4999998,0.999999992 L22.9999998,4.50000005 L23,23 L17,23 M18,1 L18,6 L23,6 M10,23 C13.8659932,23 17,19.8659932 17,16 C17,12.1340068 13.8659932,9 10,9 C6.13400675,9 3,12.1340068 3,16 C3,19.8659932 6.13400675,23 10,23 Z M10,12 L10,16 L13,19"/>
                                    </svg>
                                </span>
                                Project Requirment
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionain">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <router-link to="/add-project">Add New</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/project-list">List</router-link>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <span>
                                    <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="800px" height="800px" viewBox="0 0 256 190" enable-background="new 0 0 256 190" xml:space="preserve">
                                    <path d="M48.12,27.903C48.12,13.564,59.592,2,74.023,2c14.339,0,25.903,11.564,25.903,25.903
                                        C99.834,42.335,88.27,53.806,74.023,53.806C59.684,53.806,48.12,42.242,48.12,27.903z M191,139h-47V97c0-20.461-17.881-37-38-37H43
                                        C20.912,60,1.99,79.14,2,98v77c-0.026,8.533,6.001,12.989,12,13c6.014,0.011,12-4.445,12-13v-75h8v88h78v-88h8l0.081,50.37
                                        c-0.053,8.729,5.342,12.446,10.919,12.63h60C207.363,163,207.363,139,191,139z M217.544,122.684h7.812v5.859H185.54
                                        c-0.046,0,0.104-0.43,0.104-0.43v-5.384c0-0.007-0.078-0.026-0.104-0.045h7.916v-8.463h-31.274c-2.728,0-5.182-2.155-5.182-4.883
                                        V51.939c0-2.728,2.454-5.423,5.182-5.423h86.675c2.728,0,5.143,2.656,5.143,5.423v57.399c0,2.728-2.383,4.883-5.11,4.883h-31.346
                                        V122.684z M246.839,103.153V54.979h-82.027v48.174H246.839z"/>
                                    </svg>
                                </span>
                                Skill Set
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionain">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <router-link to="/add-skill">Add new</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/skills-list">List</router-link>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <span>
                                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="800px" height="800px" viewBox="0 0 512 512"  xml:space="preserve">
                                    <g>
                                        <path class="st0" d="M208.971,443.563c2.203-2.219,3.281-5.109,3.234-8l8.047-8.031l65.25-14
                                            c6.672-1.203,12.266-5.719,14.859-11.984c0,0,12.375-27.641,19.891-40.172l-20.781-20.781l-3.234-3.25l-20.797-20.797
                                            c-12.531,7.516-40.188,19.891-40.188,19.891c-6.266,2.594-10.766,8.188-11.969,14.844l-14.016,65.266l-8.016,8.031
                                            c-2.906-0.016-5.813,1.047-8.016,3.25c-4.344,4.359-4.344,11.391,0,15.734S204.627,447.906,208.971,443.563z M256.564,363.063
                                            c4.734-4.75,12.422-4.75,17.188,0c4.734,4.734,4.734,12.438,0,17.172c-4.766,4.734-12.453,4.734-17.188,0
                                            C251.814,375.5,251.814,367.797,256.564,363.063z"/>
                                        <path class="st0" d="M362.346,318.766l-44.313-44.328c0,0-15.531,15.531-20.531,20.531c-5.016,5-11.531,3.5-11.531,3.5l-6,6.031
                                            l21.031,21.031l5.016,5l26.297,26.297l6-6.016c0,0-1.5-6.5,3.5-11.516C346.83,334.281,362.346,318.766,362.346,318.766z"/>
                                        <path class="st0" d="M497.83,138.969c-20.5-20.484-42.844-18.625-66.141,4.656c-23.266,23.281-90.219,106.625-106,122.406
                                            l45.078,45.063c15.766-15.766,99.109-82.719,122.391-106S518.314,159.453,497.83,138.969z M477.486,175.141l-70.156,70.141
                                            c-1.719,1.734-4.484,1.734-6.203,0l-9.625-9.625c-1.703-1.688-1.703-4.469,0-6.188l70.141-70.156c1.719-1.719,4.516-1.719,6.234,0
                                            l9.609,9.625C479.205,170.656,479.205,173.438,477.486,175.141z"/>
                                        <rect x="88.408" y="201.844" class="st0" width="194.5" height="22.109"/>
                                        <rect x="88.408" y="279.219" class="st0" width="145.875" height="22.094"/>
                                        <rect x="88.408" y="356.563" class="st0" width="103.891" height="22.109"/>
                                        <path class="st0" d="M358.58,356.969l-8.063,6.656l-7.938,7.938v102.156H26.518V38.281h213.281v83.484
                                            c0,5.906,2.438,11.359,6.313,15.203c3.859,3.875,9.297,6.313,15.219,6.313h81.25v76.5c4.297-5.125,8.813-10.469,13.391-15.922
                                            c4.313-5.141,8.719-10.391,13.125-15.625v-72.578L265.221,11.766H11.049c-6.109,0-11.047,4.953-11.047,11.047v466.375
                                            c0,6.094,4.938,11.047,11.047,11.047h347c6.109,0,11.047-4.953,11.047-11.047V337.031l-12.672,12.672L358.58,356.969z
                                            M261.924,45.969l75.188,75.203h-75.188V45.969z"/>
                                    </g>
                                    </svg>
                                </span>
                                Employee Category
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionain">
                            <div class="accordion-body">
                                <ul>
                                    <li>
                                        <router-link to="/add-category">Add New</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/category-list">List</router-link>
                                    </li>
                                    <!-- <li>
                                        <router-link to="/">Catagories</router-link>
                                    </li> -->
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting_div">
                    <router-link to="/settings">
                        <span>
                            <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M600.704 64a32 32 0 0 1 30.464 22.208l35.2 109.376c14.784 7.232 28.928 15.36 42.432 24.512l112.384-24.192a32 32 0 0 1 34.432 15.36L944.32 364.8a32 32 0 0 1-4.032 37.504l-77.12 85.12a357.12 357.12 0 0 1 0 49.024l77.12 85.248a32 32 0 0 1 4.032 37.504l-88.704 153.6a32 32 0 0 1-34.432 15.296L708.8 803.904c-13.44 9.088-27.648 17.28-42.368 24.512l-35.264 109.376A32 32 0 0 1 600.704 960H423.296a32 32 0 0 1-30.464-22.208L357.696 828.48a351.616 351.616 0 0 1-42.56-24.64l-112.32 24.256a32 32 0 0 1-34.432-15.36L79.68 659.2a32 32 0 0 1 4.032-37.504l77.12-85.248a357.12 357.12 0 0 1 0-48.896l-77.12-85.248A32 32 0 0 1 79.68 364.8l88.704-153.6a32 32 0 0 1 34.432-15.296l112.32 24.256c13.568-9.152 27.776-17.408 42.56-24.64l35.2-109.312A32 32 0 0 1 423.232 64H600.64zm-23.424 64H446.72l-36.352 113.088-24.512 11.968a294.113 294.113 0 0 0-34.816 20.096l-22.656 15.36-116.224-25.088-65.28 113.152 79.68 88.192-1.92 27.136a293.12 293.12 0 0 0 0 40.192l1.92 27.136-79.808 88.192 65.344 113.152 116.224-25.024 22.656 15.296a294.113 294.113 0 0 0 34.816 20.096l24.512 11.968L446.72 896h130.688l36.48-113.152 24.448-11.904a288.282 288.282 0 0 0 34.752-20.096l22.592-15.296 116.288 25.024 65.28-113.152-79.744-88.192 1.92-27.136a293.12 293.12 0 0 0 0-40.256l-1.92-27.136 79.808-88.128-65.344-113.152-116.288 24.96-22.592-15.232a287.616 287.616 0 0 0-34.752-20.096l-24.448-11.904L577.344 128zM512 320a192 192 0 1 1 0 384 192 192 0 0 1 0-384zm0 64a128 128 0 1 0 0 256 128 128 0 0 0 0-256z"/></svg>
                        </span>
                        Setting
                    </router-link>
                </div>
                <div class="setting_div">
                    <button @click="logout">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 40" x="0px" y="0px"><g data-name="Layer 2"><path d="M23.483,8.74a1.93,1.93,0,0,0-2.648,2.809l2.379,2.244H11.934a1.93,1.93,0,0,0,0,3.859h11.28L20.835,19.9a1.93,1.93,0,0,0,2.65,2.807L29.4,17.123a1.933,1.933,0,0,0,0-2.805Z"/><path d="M14.557,25.879H5.844V5.566h8.713a1.929,1.929,0,1,0,0-3.858H3.914a1.932,1.932,0,0,0-1.93,1.93v24.17a1.932,1.932,0,0,0,1.93,1.929H14.557a1.929,1.929,0,1,0,0-3.858Z"/></g></svg>
                        </span>
                        Log out
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions,mapGetters } from 'vuex';
export default {
    name: 'Leftbar',
    data() {
        return  {
            isClassAdded: false
        }
    },
    computed: {
        ...mapGetters('userDataModule', ['userData']),
        sitename() {
            return 'Job Board';
        },

        userplane() {
            if(this.userData) {
                if (this.userData.usertype == 1) {
                    return  'Super Admin';
                } 
                if (this.userData.usertype == 2) {
                    return 'Client';
                }
                else {
                    return 'Employee';
                }
            }else{
                return 'Employee';
            }    
        },
       
    },    
    mounted() {
        console.log('Left sitebar mounted');
    },
    methods:{
        ...mapActions('userDataModule', ['userlogout']),
        logout(){
            this.userlogout()
        }
    }
    
}
</script>