const getters = {
    personName(state) {
        return state.userData !== null ? state.userData.message : null;
    },
    userData(state) {
        return state.userData;
    },
    commentsData(state) {
        return state.commentsData;
    }
}

export default getters;