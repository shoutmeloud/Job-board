import getters from './getters';
import mutations from './mutations';
import actions from './actions';
import state from './state';

const projectsDataModule = {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}

export default projectsDataModule;