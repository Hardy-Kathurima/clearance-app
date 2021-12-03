import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';
Vue.use(Vuex, axios)


export default new Vuex.Store({
    state: {
        role: ""
    },

    actions: {
        loadRole({ commit }) {
            axios
                .get("http://localhost:3000/api/admin/home")
                .then((response) => {

                    let role = response.data.role;
                    commit('SET_ROLE', role);
                    console.log(role)
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mutations: {
        SET_ROLE(state, role) {
            state.role = role

        }
    },
})

