
import {authenticate} from '../services/auth'

export const auth = {

    namespaced: true,

    state: {
        user: {}
    },

    mutations: {
        setUser: (state, item) => {
            state.user = item;
        }
    },

    actions: {
        init: async ({commit}) => {

            if(authenticate.hasToken()) {

                authenticate.setToken();

                let response = await http.get('/init');

                if(response.status == 200) {

                    commit('setUser', response.data);

                } else {

                    authenticate.destroyToken();

                }

                return response;

            } else {

                commit('setUser', {});

            }

            return false;
        },

        login: async ({dispatch}, data) => {

            let response = await authenticate.post('/login', data);

            if(response.status == 201) {

                localStorage.token = response.data.token;

                authenticate.setToken();

                dispatch('init');
            }

            return response;

        },

        logout: async ({commit}) => {

            let response = await http.post('/logout');

            if(response.status == 200) {

                commit('setUser', {});

                authenticate.destroyToken();
            }

            return response;
        },
    },

    getters: {
        authenticated: (state) => {
            return JSON.stringify(state.user) == '{}' ? false : true;
        },

        user: (state) => {
            return state.user;
        }
    }

}
