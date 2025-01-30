
import { createStore } from "vuex";

const store = createStore({
  modules: {},
});

// register modules Dynamically
Promise.all([
  import("./modules/userData"),
  import("./modules/ProjectsData"),
  ])
  .then(([userDataModule,projectsDataModule]) => {
       store.registerModule("userDataModule", userDataModule.default);
       store.registerModule("projectsDataModule",projectsDataModule.default);
});

export default store;
