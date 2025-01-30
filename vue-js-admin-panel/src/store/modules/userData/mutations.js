const mutations = {
    userData(state, resUserData) {
        // console.log('test - updatePostData');
        state.userData = resUserData;
    },
    clientData(state, resClientData) {
        state.clientData = resClientData;
    },
    settingsData(state, resSettingsData) {
        state.settingsData = resSettingsData;
    },
    clientData(state, resclientData) {
        state.clientData = resclientData;
    },
    individualclientData(state, resindividualclientData) {
        state.individualclientData = resindividualclientData;
    },
    refarralTransactionData(state, resrefarralTransactionData) {
        state.refarralTransactionData = resrefarralTransactionData;
    },
    refarralClientData(state, resrefarralClientData) {
        state.refarralClientData = resrefarralClientData;
    },

    categoryData(state, resCategoryData) {
        state.categoryData = resCategoryData;
    },
    individualcategoryData(state, resindividualcategoryData) {
        state.individualcategoryData = resindividualcategoryData;
    },

    skillsData(state, resSkillsData) {
        state.skillsData = resSkillsData;
    },
    individualskillsData(state, resindividualskillsData) {
        state.individualskillsData = resindividualskillsData;
    },    
    
    allSkillsList(state, resallSkillsList) {
        state.allSkillsList = resallSkillsList;
    },
    allCategoryList(state, resallCategoryList) {
        state.allCategoryList = resallCategoryList;
    },
   
    employeeData(state, resemployeeData) {
        state.employeeData = resemployeeData;
    },
    employeesSkillsData(state, resemployeesSkillsData) {
        state.employeesSkillsData = resemployeesSkillsData;
    },
    individualempSkillsData(state, resindividualempSkillsData) {
        state.individualempSkillsData = resindividualempSkillsData;
    },    
    individualemployeeData(state, resindividualemployeeData) {
        state.individualemployeeData = resindividualemployeeData;
    },


    
    clientListForProject(state, resclientListForProject) {
        state.clientListForProject = resclientListForProject;
    },
    empDataWithCatAndSkill(state, resempDataWithCatAndSkill) {
        state.empDataWithCatAndSkill = resempDataWithCatAndSkill;
    },    
    projectData(state, resprojectData) {
        state.projectData = resprojectData;
    },
    individualprojectData(state, resindividualprojectData) {
        state.individualprojectData = resindividualprojectData;
    },

    commentsData(state, commentsData) {
        state.commentsData = commentsData;
    },


    dashboardData(state, resdashboardData) {
        state.dashboardData = resdashboardData;
    },

    draftId(state, resdraftId) {
        state.draftId = resdraftId;
    },

    draftFile(state, resdraftFile) {
        state.draftFile = resdraftFile;
    },
    
    setDraftFiles(state, resdraftFile) {
        state.draftFile = resdraftFile;
    },

}

export default mutations;