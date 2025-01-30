const getters = {
    personName(state) {
        return state.userData !== null ? state.userData.message : null;
    },
    userData(state) {
        return state.userData;
    },
    dashboardData(state) {
        return state.dashboardData;
    },
    inviteData(state) {
        return state.inviteData;
    },
    
    commentsData(state) {
        return state.commentsData;
    },
}

export default getters;