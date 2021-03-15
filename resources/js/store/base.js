

import {router} from '../router'

export const base = {

    namespaced: true,

    state: {
        is_first_load: true,

        endpoint: '',

        items: [],

        selected: {},

        filters: '',
        current_page: 1,
        last_page: 1,
        next_page: 1,
        total: 0,

    },

    mutations: {
        load: (state, items) => {

            state.items = items;

        },

        setFilter: (state, value) => {

            state.filters = value;

        },

        setCurrentPage: (state, value) => {

            state.current_page = value;

        },

        setLastPage: (state, value) => {

            state.last_page = value;

        },

        setTotal: (state, value) => {

            state.total = value;

        },

        select: (state, item) => {
            state.selected = item;
        },

        updateItem: (state, item) => {

            if(item.hasOwnProperty("is_default")) {

                let is_default = state.items.findIndex( list_item => list_item.is_default == 1 );

                if(is_default > 0) {

                    state.items[is_default].is_default = false;
                }

            }

            item.is_updated = true;

            let index = state.items.findIndex( list_item => list_item.id == item.id );

            state.items[index] = item;


        },

        deleteItem: (state, item) => {

            let index = state.items.findIndex( list_item => list_item.id == item.id );

            if(index !== false) {

                state.items.splice(index, 1);
            }
        },

        preppend: (state, item) => {

            item.is_new = true;

            state.items.unshift(item);

        }
    },

    actions: {

        load: async ({commit, state, dispatch}, filters = {}) => {

            let response = await http.get(state.endpoint, filters);

            if(response.status == 200) {

                commit('load',  response.data.data);

                commit('setCurrentPage', response.data.current_page);

                commit('setLastPage', response.data.last_page);

                commit('setTotal', response.data.total);

            }

            return response;
        },

        setFilter: async ({commit,state, dispatch}, filters) => {

            router.push({
                ...router.currentRoute,
                query: filters
            }).catch(()=>{});;

            commit('setFilter', filters)

            return dispatch('load', filters);
        },

        show: async({commit, state}, id) => {

            let response = await http.get(state.endpoint + '/' + id);

            if(response.status == 200) {
                commit('select',  response.data);
            }

            return response;
        },

        update: async ({commit, state}, data) => {

            let response = await http.update(state.endpoint + '/' + state.selected.id, data);

            if(response.status == 200) {

                commit('select',  response.data);

                commit('updateItem',  response.data);
            }

            return response;
        },

        patch: async ({commit, state}, data) => {


            let response = await http.update(state.endpoint + '/' + state.selected.id + '/' + Object.keys(data)[0], data);

            if(response.status == 200) {
                commit('select', response.data)
            }

            return response;
        },

        unload: ({commit}) => {

            commit('setFilter', '');

            commit('load', []);

        },

        store: async({commit, state}, data) => {

            let response = await http.post(state.endpoint, data);

            if(response.status == 201) {

                commit('preppend', response.data);

            }

            return response;
        },

        select: ({commit}, data) => {

            commit('select',data);

        },

        deselect: ({commit}) => {

            commit('select',{});

        },

        delete: async ({commit, state}, id) => {

            let response = await http.destroy(state.endpoint + '/' + state.selected.id);

            if(response.status == 200) {

                commit('deleteItem',  state.selected);

                commit('select',{});

            }

            return response;

        },


    },

    getters: {
        items: (state) => {
            return state.items;
        },

        selected: (state) => {
            return Object.assign({}, state.selected);
        },

        hasSelected: (state) => {
            return JSON.stringify(state.selected) == '{}' ? false : true;
        },

        hasNextPage: (state) => {
            return state.current_page != state.last_page;
        },

        hasPrevPage: (state) => {
            return state.current_page > 1;
        },

        totalItem: (state) => {
            return state.total;
        },

        currentPage: (state) => {
            return state.current_page;
        },

        lastPage: (state) => {
            return state.last_page;
        },
    }
}

