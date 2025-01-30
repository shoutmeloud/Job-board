const mutations = {
    userData(state, resUserData) {
        // console.log('test - updatePostData');
        state.userData = resUserData;
    },
    clientData(state, resClientData) {
        // console.log('test - updatePostData');
        state.clientData = resClientData;
    },

    refarralTransactionData(state, resrefarralTransactionData) {
        state.refarralTransactionData = resrefarralTransactionData;
    }, 

    dashboardData(state, resdashboardData) {
        state.dashboardData = resdashboardData;
    }, 

    inviteData(state, resinviteData) {
        state.inviteData = resinviteData;
    }, 

    commentsData(state, commentsData) {
        state.commentsData = commentsData;
    },
  
}

export default mutations;