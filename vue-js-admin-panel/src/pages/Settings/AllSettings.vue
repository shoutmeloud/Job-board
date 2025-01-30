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
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Settings</button>
                                </li>
                               
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="input_box">
                                        <form @submit.prevent="saveSettings()" ref="settings_form">
                                            <div class="input_sub_box" :key="allSettingsData.id" v-for="allSettingsData in settingsData">
                                                <label :for="allSettingsData.option_key">{{allSettingsData.option_key}} :</label>
                                                <input type="text" :id="allSettingsData.id" :ref="allSettingsData.id" v-model="allSettingsData.option_value"  />
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
import {mapActions, mapState } from 'vuex';

export default {
    name: 'SettingPage',
    components: {
        Header,
        Leftside
    },
    data() {
        return {
           formData: {},
        };
    },

    computed: {
        ...mapState('userDataModule', ['settingsData'])
    },

    methods: {
        ...mapActions('userDataModule', ['getSettingsData','updateSettingsData']),

        //  this function is using for show and hide password in login form 
        saveSettings(){
            this.formData = {}
            this.settingsData.forEach((setting) => {
                const value = this.$refs[setting.id][0].value;
                this.formData[setting.id] = value;               
            });
            this.updateSettingsData({'data':this.formData});
            // console.log(JSON.stringify(this.formData));
        },
    },

    created() {
       this.getSettingsData();
       console.log(this.settingsData);
    },



};
</script>