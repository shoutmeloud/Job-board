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
                        <p>{{userPanelName}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="scrool_box">
            <div class="two_box">
                <div class="clientmenu" v-if="usertype==2">
                    <div class="setting_div">
                        <router-link to="/dashboard">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                            </span>
                            Dashboard
                        </router-link>
                    </div>
                    <div class="setting_div">
                        <router-link to="/edit-profile">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                            </span>
                            Edit Profile
                        </router-link>
                    </div>

                    <div class="setting_div">
                        <router-link to="/submit-project-list">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                            </span>
                            Project List
                        </router-link>
                    </div>

                    <div class="setting_div">
                        <router-link to="/post-requirment">
                            <span>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><g><path d="M0,0v60.479L39.521,100H100V0H0z M78.658,64.329H45.224v-9.553H7.014V7.014h85.973v85.973H45.224V73.882h33.435   c2.64,0,4.775-2.137,4.775-4.776C83.434,66.465,81.298,64.329,78.658,64.329z M40.447,59.553v31.456L8.991,59.553H40.447z    M16.566,21.343c0-2.641,2.136-4.777,4.776-4.777h57.316c2.64,0,4.775,2.136,4.775,4.777c0,2.64-2.136,4.776-4.775,4.776H21.342   C18.702,26.119,16.566,23.982,16.566,21.343z M83.434,45.224c0,2.64-2.136,4.776-4.775,4.776H21.342   c-2.64,0-4.776-2.136-4.776-4.776c0-2.64,2.136-4.776,4.776-4.776h57.316C81.298,40.447,83.434,42.584,83.434,45.224z"/></g></svg> -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>
                            </span>
                            Post Requirement
                        </router-link>
                    </div>

                 
                    <div class="setting_div">
                        <router-link to="/referral-history">
                            <span>
                                <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <g fill="">
                                    <path d="M3.05 4.75a.7.7 0 01.7-.7h3.5a.7.7 0 110 1.4h-3.5a.7.7 0 01-.7-.7zM3.75 7.05a.7.7 0 100 1.4h2.5a.7.7 0 100-1.4h-2.5z"/>
                                    <path fill-rule="evenodd" d="M0 3.25A2.25 2.25 0 012.25 1h6.5c.883 0 1.648.51 2.016 1.25h.984c.698 0 1.3.409 1.582 1h.918c.966 0 1.75.784 1.75 1.75v6a1.75 1.75 0 01-1.75 1.75h-.918c-.281.591-.884 1-1.582 1h-.984A2.25 2.25 0 018.75 15h-6.5A2.25 2.25 0 010 12.75v-9.5zm13.5 8h.75a.25.25 0 00.25-.25V5a.25.25 0 00-.25-.25h-.75v6.5zm-2.5 1v-8.5h.75A.25.25 0 0112 4v8a.25.25 0 01-.25.25H11zM2.25 2.5a.75.75 0 00-.75.75v9.5c0 .414.336.75.75.75h6.5a.75.75 0 00.75-.75v-9.5a.75.75 0 00-.75-.75h-6.5z" clip-rule="evenodd"/></g>
                                </svg>
                            </span>
                            Referral Point History
                        </router-link>
                    </div>

                    <div class="setting_div">
                        <router-link to="/change-password">
                            <span>
                                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                    <path d="M20,37.5c0-0.8-0.7-1.5-1.5-1.5h-15C2.7,36,2,36.7,2,37.5v11C2,49.3,2.7,50,3.5,50h15c0.8,0,1.5-0.7,1.5-1.5
                                        V37.5z"/>
                                    <path d="M8.1,22H3.2c-1,0-1.5,0.9-0.9,1.4l8,8.3c0.4,0.3,1,0.3,1.4,0l8-8.3c0.6-0.6,0.1-1.4-0.9-1.4h-4.7
                                        c0-5,4.9-10,9.9-10V6C15,6,8.1,13,8.1,22z"/>
                                    <path d="M41.8,20.3c-0.4-0.3-1-0.3-1.4,0l-8,8.3c-0.6,0.6-0.1,1.4,0.9,1.4h4.8c0,6-4.1,10-10.1,10v6
                                        c9,0,16.1-7,16.1-16H49c1,0,1.5-0.9,0.9-1.4L41.8,20.3z"/>
                                    <path d="M50,3.5C50,2.7,49.3,2,48.5,2h-15C32.7,2,32,2.7,32,3.5v11c0,0.8,0.7,1.5,1.5,1.5h15c0.8,0,1.5-0.7,1.5-1.5
                                        V3.5z"/>
                                </svg>
                            </span>
                            Change Password
                        </router-link>
                    </div> 

                    <div class="setting_div">
                        <button @click="logout">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 40" x="0px" y="0px"><g data-name="Layer 2"><path d="M23.483,8.74a1.93,1.93,0,0,0-2.648,2.809l2.379,2.244H11.934a1.93,1.93,0,0,0,0,3.859h11.28L20.835,19.9a1.93,1.93,0,0,0,2.65,2.807L29.4,17.123a1.933,1.933,0,0,0,0-2.805Z"></path><path d="M14.557,25.879H5.844V5.566h8.713a1.929,1.929,0,1,0,0-3.858H3.914a1.932,1.932,0,0,0-1.93,1.93v24.17a1.932,1.932,0,0,0,1.93,1.929H14.557a1.929,1.929,0,1,0,0-3.858Z"></path></g></svg>
                            </span>
                            Log out
                        </button>
                    </div>
                </div>     

                <div class="clientmenu" v-if="usertype==3">
                    <div class="setting_div">
                        <router-link to="/dashboard">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                            </span>
                            Dashboard
                        </router-link>
                    </div>
                    <div class="setting_div">
                        <router-link to="/edit-employee-profile">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 80" x="0px" y="0px"><path class="cls-1" d="m55.74997,30.46411c-1.34308,0-2.43591,1.09241-2.43591,2.43604v16.28174c0,3.27905-2.66718,5.94629-5.94574,5.94629H14.80417c-3.2785,0-5.94568-2.66724-5.94568-5.94629V16.61816c0-3.27808,2.66718-5.94519,5.94568-5.94519h16.28186c1.34308,0,2.43597-1.09241,2.43597-2.43591s-1.0929-2.43604-2.43597-2.43604H14.80417c-5.96472,0-10.81757,4.85303-10.81757,10.81714v32.56372c0,5.96521,4.85284,10.81812,10.81757,10.81812h32.56415c5.96478,0,10.81763-4.85291,10.81763-10.81812v-16.28174c0-1.34363-1.09283-2.43604-2.43597-2.43604Z"/><path class="cls-1" d="m59.18521,8.08496l-3.28369-3.2738c-1.07184-1.08154-2.94263-1.08154-4.0144,0l-21.55328,21.55322c-.89648.88672-1.56879,1.99756-1.9585,3.19604l-2.24109,7.07397c-.11694.34094-.01947.72107.23389.98413.18512.18506.43848.28259.69177.28259.09747,0,.19489-.01953.29236-.04883l7.07391-2.24097c1.19855-.38965,2.30927-1.06213,3.19598-1.95862l21.56305-21.55322c.53589-.53577.82819-1.24719.82819-2.0072s-.2923-1.47131-.82819-2.00732Z"/></svg>
                            </span>
                            Edit Profile
                        </router-link>
                    </div>

                    <div class="setting_div">
                        <router-link to="/employee-project-list">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 75" x="0px" y="0px"><title>006 - Project List</title><path d="M56,0H4A4,4,0,0,0,0,4V56a4,4,0,0,0,4,4H56a4,4,0,0,0,4-4V4A4,4,0,0,0,56,0Zm2,56a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V4A2,2,0,0,1,4,2H56a2,2,0,0,1,2,2Z"/><path d="M11,6a7,7,0,1,0,7,7A7.008,7.008,0,0,0,11,6Zm0,12a5,5,0,1,1,5-5A5.006,5.006,0,0,1,11,18Z"/><path d="M53,6H23a3,3,0,0,0,0,6H53a3,3,0,0,0,0-6Zm0,4H23a1,1,0,0,1,0-2H53a1,1,0,0,1,0,2Z"/><path d="M23,20H37a3,3,0,0,0,0-6H23a3,3,0,0,0,0,6Zm0-4H37a1,1,0,0,1,0,2H23a1,1,0,0,1,0-2Z"/><path d="M11,23a7,7,0,1,0,7,7A7.008,7.008,0,0,0,11,23Zm0,12a5,5,0,1,1,5-5A5.006,5.006,0,0,1,11,35Z"/><path d="M53,23H23a3,3,0,0,0,0,6H53a3,3,0,0,0,0-6Zm0,4H23a1,1,0,0,1,0-2H53a1,1,0,0,1,0,2Z"/><path d="M23,37H37a3,3,0,0,0,0-6H23a3,3,0,0,0,0,6Zm0-4H37a1,1,0,0,1,0,2H23a1,1,0,0,1,0-2Z"/><path d="M11,40a7,7,0,1,0,7,7A7.009,7.009,0,0,0,11,40Zm0,12a5,5,0,1,1,5-5A5.006,5.006,0,0,1,11,52Z"/><path d="M53,40H23a3,3,0,0,0,0,6H53a3,3,0,0,0,0-6Zm0,4H23a1,1,0,0,1,0-2H53a1,1,0,0,1,0,2Z"/><path d="M37,48H23a3,3,0,0,0,0,6H37a3,3,0,0,0,0-6Zm0,4H23a1,1,0,0,1,0-2H37a1,1,0,0,1,0,2Z"/><path d="M12.2,10.4,9.892,13.478l-.185-.185a1,1,0,0,0-1.414,1.414l1,1A1,1,0,0,0,10,16l.071,0a1,1,0,0,0,.729-.4l3-4a1,1,0,1,0-1.6-1.2Z"/><path d="M12.2,27.4,9.892,30.478l-.185-.185a1,1,0,0,0-1.414,1.414l1,1A1,1,0,0,0,10,33l.071,0a1,1,0,0,0,.729-.4l3-4a1,1,0,0,0-1.6-1.2Z"/></svg>
                            </span>
                            Project List
                        </router-link>
                    </div>
                 
                    <div class="setting_div">
                        <router-link to="/change-password">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" viewBox="0 0 100 125" version="1.1" xml:space="preserve" style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><g><path d="M81.59,44.157C81.35,42.887 80.91,41.628 80.329,40.51C79.617,39.139 78.702,37.968 77.613,37.36C76.61,36.799 76.25,35.528 76.811,34.525C77.372,33.521 78.642,33.161 79.646,33.722C81.36,34.68 82.906,36.431 84.027,38.59C84.942,40.352 85.573,42.378 85.828,44.385L87.011,43.611C87.974,42.983 89.266,43.254 89.895,44.217C90.524,45.179 90.253,46.471 89.29,47.1L84.833,50.01C84.384,50.304 83.838,50.415 83.302,50.312C82.999,50.254 82.715,50.131 82.468,49.951L77.438,46.288C76.509,45.612 76.304,44.307 76.98,43.378C77.657,42.448 78.961,42.243 79.891,42.92C79.891,42.92 80.707,43.515 81.59,44.157ZM14.157,55.615L12.973,56.389C12.011,57.017 10.719,56.746 10.09,55.783C9.461,54.821 9.732,53.529 10.695,52.9L15.151,49.99C15.6,49.696 16.147,49.585 16.683,49.688C16.986,49.746 17.27,49.869 17.517,50.049L22.546,53.712C23.476,54.388 23.681,55.693 23.004,56.622C22.328,57.552 21.024,57.757 20.094,57.08C20.094,57.08 19.277,56.485 18.394,55.843C18.635,57.113 19.075,58.372 19.656,59.49C20.368,60.861 21.283,62.032 22.371,62.64C23.375,63.201 23.735,64.472 23.174,65.475C22.613,66.479 21.343,66.839 20.339,66.278C18.625,65.32 17.079,63.569 15.958,61.41C15.043,59.648 14.411,57.622 14.157,55.615ZM71.89,29.452C71.89,37.474 65.377,43.987 57.355,43.987L19.452,43.987C11.43,43.987 4.917,37.474 4.917,29.452C4.917,21.43 11.43,14.917 19.452,14.917L57.355,14.917C65.377,14.917 71.89,21.43 71.89,29.452ZM67.723,29.452C67.723,23.729 63.077,19.083 57.355,19.083L19.452,19.083C13.729,19.083 9.083,23.729 9.083,29.452C9.083,35.174 13.729,39.82 19.452,39.82L57.355,39.82C63.077,39.82 67.723,35.174 67.723,29.452ZM46.834,30.888L46.164,30.67C45.07,30.315 44.471,29.139 44.826,28.045C45.181,26.952 46.358,26.352 47.451,26.708L48.121,26.925L48.121,26.221C48.121,25.071 49.055,24.138 50.205,24.138C51.354,24.138 52.288,25.071 52.288,26.221L52.288,26.925L52.958,26.708C54.052,26.352 55.228,26.952 55.583,28.045C55.938,29.139 55.339,30.315 54.246,30.67L53.576,30.888L53.99,31.458C54.666,32.388 54.459,33.692 53.529,34.368C52.599,35.044 51.295,34.837 50.619,33.907L50.205,33.337L49.791,33.907C49.115,34.837 47.811,35.044 46.881,34.368C45.95,33.692 45.744,32.388 46.42,31.458L46.834,30.888ZM23.231,30.888L22.561,30.67C21.467,30.315 20.868,29.139 21.223,28.045C21.579,26.952 22.755,26.352 23.848,26.708L24.518,26.925L24.518,26.221C24.518,25.071 25.452,24.138 26.602,24.138C27.752,24.138 28.685,25.071 28.685,26.221L28.685,26.925L29.355,26.708C30.449,26.352 31.625,26.952 31.98,28.045C32.336,29.139 31.736,30.315 30.643,30.67L29.973,30.888L30.387,31.458C31.063,32.388 30.856,33.692 29.926,34.368C28.996,35.044 27.692,34.837 27.016,33.907L26.602,33.337L26.188,33.907C25.512,34.837 24.208,35.044 23.278,34.368C22.347,33.692 22.141,32.388 22.817,31.458L23.231,30.888ZM95.083,70.548C95.083,78.57 88.57,85.083 80.548,85.083L42.645,85.083C34.623,85.083 28.11,78.57 28.11,70.548C28.11,62.526 34.623,56.013 42.645,56.013L80.548,56.013C88.57,56.013 95.083,62.526 95.083,70.548ZM90.917,70.548C90.917,64.826 86.271,60.18 80.548,60.18L42.645,60.18C36.923,60.18 32.277,64.826 32.277,70.548C32.277,76.271 36.923,80.917 42.645,80.917L80.548,80.917C86.271,80.917 90.917,76.271 90.917,70.548ZM46.424,71.985L45.754,71.767C44.661,71.412 44.062,70.235 44.417,69.142C44.772,68.048 45.948,67.449 47.042,67.804L47.712,68.022L47.712,67.317C47.712,66.168 48.646,65.234 49.795,65.234C50.945,65.234 51.879,66.168 51.879,67.317L51.879,68.022L52.549,67.804C53.642,67.449 54.819,68.048 55.174,69.142C55.529,70.235 54.93,71.412 53.836,71.767L53.166,71.985L53.58,72.555C54.256,73.485 54.05,74.789 53.119,75.465C52.189,76.14 50.885,75.934 50.209,75.004L49.795,74.434L49.381,75.004C48.705,75.934 47.401,76.14 46.471,75.465C45.541,74.789 45.334,73.485 46.01,72.555L46.424,71.985ZM70.027,71.985L69.357,71.767C68.264,71.412 67.664,70.235 68.02,69.142C68.375,68.048 69.551,67.449 70.645,67.804L71.315,68.022L71.315,67.317C71.315,66.168 72.248,65.234 73.398,65.234C74.548,65.234 75.482,66.168 75.482,67.317L75.482,68.022L76.152,67.804C77.245,67.449 78.421,68.048 78.777,69.142C79.132,70.235 78.533,71.412 77.439,71.767L76.769,71.985L77.183,72.555C77.859,73.485 77.653,74.789 76.722,75.465C75.792,76.14 74.488,75.934 73.812,75.004L73.398,74.434L72.984,75.004C72.308,75.934 71.004,76.14 70.074,75.465C69.144,74.789 68.937,73.485 69.613,72.555L70.027,71.985Z"/></g></svg>
                            </span>
                            Change Password
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
    </div>
</template>

<script>
import { mapGetters,mapActions } from 'vuex';
export default {
    name: 'Leftbar',
    data() {
        return  {
            isClassAdded: false,
            usertype:localStorage.getItem('LOGEDUSERTYPE'),
            userPanelName: null,
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
                    return  'Supper Admin';
                } 
                if (this.userData.usertype == 2) {
                    return 'Clients';
                }
                else {
                    return 'Employee';
                }
            }else{
                return 'Clients';
            }    
        },
       
    },    
    mounted() {
        console.log(localStorage.getItem('LOGEDUSERTYPE'));
        this.userPanelName = this.userplane
    },
    methods:{
        ...mapActions('userDataModule', ['userlogout']),
        logout(){
            this.userlogout()
        }
    },

    // watch:{
    //     // userData(){
    //     //     alert(123);
    //     //     console.log(this.userData)
    //     //     // var reduserplane = null
    //     //     // if(this.userData && this.userData != undefined) {
    //     //     //     if (this.userData.usertype == 1) {
    //     //     //        reduserplane = 'Supper Admin';
    //     //     //     } 
    //     //     //     if (this.userData.usertype == 2) {
    //     //     //         reduserplane = 'Clients';
    //     //     //     }
    //     //     //     else {
    //     //     //         console.log('1erredd',this.userData)
    //     //     //         reduserplane = 'Employee1';
    //     //     //     }
    //     //     // }else{
    //     //     //     console.log('12erredd',this.userData)
    //     //     //     reduserplane = 'Employee2';
    //     //     // }    


    //     //     //  this.userPanelName= reduserplane
    //     // }



    //         // async userData() {        
    //         //     // this.$store.someStoreValue = 'NEW VALUE'     
    //         //     // await new Promise((resolve) => {
    //         //     //     if (this.flag) {
    //         //     //         resolve();
    //         //     //     } else {
    //         //     //         const unwatch = this.$watch('flag', (newVal) => {
    //         //     //             if (newVal) {
    //         //     //                 unwatch();
    //         //     //                 resolve();
    //         //     //             }
    //         //     //         });
    //         //     //     }
    //         //     // });
    //         //     console.log(this.userData)
    //         // }
            
            
    // }
    
}
</script>