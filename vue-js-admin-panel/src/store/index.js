
import { createStore } from "vuex";

const store = createStore({
  modules: {},
});

// register modules Dynamically
Promise.all([import("./modules/userData"),]).then(([userDataModule]) => {
  store.registerModule("userDataModule", userDataModule.default)
});

export default store;
