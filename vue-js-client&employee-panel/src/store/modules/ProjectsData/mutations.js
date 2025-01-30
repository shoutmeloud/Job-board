const mutations = {
   
    ProjectData(state, clientproject) {
        state.ProjectData = clientproject;
    },
    ProjectDetails(state, ProjectDetailsdata) {
        state.ProjectDetails = ProjectDetailsdata;
    },

    ProjectemployeDetails(state, ProjectemployeDetails) {
        state.ProjectemployeDetails = ProjectemployeDetails;
    },

    // commentsData(state, commentsData) {
    //     state.commentsData = commentsData;
    // },

    EmpProjectData(state, EmpProjectData) {
        state.EmpProjectData = EmpProjectData;
    },

    EmpProjectDetails(state, EmpProjectDetails) {
        state.EmpProjectDetails = EmpProjectDetails;
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