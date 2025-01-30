<template>
    <div class="dashboard_box">
        <div class="container-fluid">
            <div class="row">
                <Leftside />
                <div class="right_side">
                    <Header />
                    <div class="main_div">
                        <div class="page_name">
                            <h3>Settings</h3>
                        </div>
                        <div class="settins_tab">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Social</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Email</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="input_box">
                                        <form>
                                            <div class="input_sub_box">
                                                <label for="">First Name :</label>
                                                <input type="text" placeholder="First Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Last Name :</label>
                                                <input type="text" placeholder="Last Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Designation :</label>
                                                <input type="text" placeholder="Enter your designation" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for=""></label>
                                                <button type="submit">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="input_box">
                                        <form>
                                            <div class="input_sub_box">
                                                <label for="">First Name :</label>
                                                <input type="text" placeholder="First Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Last Name :</label>
                                                <input type="text" placeholder="Last Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Designation :</label>
                                                <input type="text" placeholder="Enter your designation" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for=""></label>
                                                <button type="submit">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="input_box">
                                        <form>
                                            <div class="input_sub_box">
                                                <label for="">First Name :</label>
                                                <input type="text" placeholder="First Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Last Name :</label>
                                                <input type="text" placeholder="Last Name" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for="">Designation :</label>
                                                <input type="text" placeholder="Enter your designation" />
                                            </div>
                                            <div class="input_sub_box">
                                                <label for=""></label>
                                                <button type="submit">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import '@/assets/css/setting/setting.css'
import Header from '@/components/Main/Header.vue';
import Leftside from '@/components/Main/Leftside.vue';

export default {
    name: 'SettingPage',
    components: {
        Header,
        Leftside
    },
};
</script>