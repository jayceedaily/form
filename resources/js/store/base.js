

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

        load: async ({commit, state, dispatch}, filters = false) => {

            if(state.is_first_load) {

                state.is_first_load = false;

                if(JSON.stringify(router.currentRoute.query) != '{}') {

                    let filters = router.currentRoute.query;

                    let string_filters = '';

                    for (const [key, value] of Object.entries(filters)) {

                        string_filters += key + '=' + value + '&'

                    }

                    return dispatch('setFilter', string_filters);
                }
            }

            let response = await http.get(state.endpoint + '?' + state.filters);

            if(response.status == 200) {

                commit('load',  response.data.data);

                commit('setCurrentPage', response.data.current_page);

                commit('setLastPage', response.data.last_page);

                commit('setTotal', response.data.total);

            }

            return response;
        },

        setFilter: async ({commit,state, dispatch}, filter) => {

            let _parse_filter           = '';

            let _existing_filters       = state.filters.split('&');

            let _new_filter             = filter.split('=');

            let _exist_then_changed     = false;

            _existing_filters.forEach( _filter => {

                if(_filter) {

                    let tag =  _filter.split('=');

                    if(tag[0] == _new_filter[0]) {

                        _exist_then_changed = true;

                        tag[1] = _new_filter[1];

                    }

                    _parse_filter += tag.join('=') + '&';
                }

            });

            if(!_exist_then_changed) {

                _parse_filter += filter + '&';
            }

            let _array_parse_filter = _parse_filter.split('&');

            let json_filters = {};

            _array_parse_filter.forEach( _filter => {


                if(_filter) {

                    let _tag = _filter.split('=');

                    json_filters[_tag[0]] = _tag[1]

                }
            });

            router.push({
                ...router.currentRoute,
                query: json_filters
            });

            commit('setFilter', _parse_filter)

            return await dispatch('load');
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

