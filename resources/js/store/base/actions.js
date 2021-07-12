
import {router} from '../../router'

const statuses = Object.freeze({
    loading: 'LOADING',
    showing: 'SHOWING',
    updating: 'UPDATING',
    saving: 'SAVING',
    deleting: 'DELETING',
    idle: 'IDLE',
});

export const baseActions = {

    /**
     * Send request to the configured API
     * and persist values into states.
     *
     * @param {*} param0
     * @returns
     */
    load: async ({commit, state, dispatch}) => {

        commit('SET_STATUS', statuses.loading);

        let response = await dispatch('index', state.filters);

        if (response.status == 200) {

            commit('SET_COLLECTION',  response.data.data);

            commit('SET_CURRENT_PAGE', response.data.current_page);

            commit('SET_FROM', response.data.from);

            commit('SET_TO', response.data.to);

            commit('SET_PER_PAGE', response.data.per_page);

            commit('SET_LAST_PAGE', response.data.last_page);

            commit('SET_TOTAL', response.data.total);
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },

    /**
     * Send request to API endpoint and
     * return the response value.
     *
     * @param {*} param0
     * @param {*} filters
     * @returns
     */
    index: async({state}, filters = {}) => {

        let response = await http.get(state.endpoint, filters);

        return response;
    },

    setFilter: async ({commit}, filters) => {

        router.push({
            ...router.currentRoute,
            query: filters
        }).catch(()=> {});

        commit('SET_FILTER', filters)
    },

    show: async({commit, state}, id) => {

        commit('SET_STATUS', statuses.showing);

        let response = await http.get(state.endpoint + '/' + id);

        if(response.status == 200) {
            commit('SELECT_ITEM',  response.data);
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },

    update: async ({commit, state}, data) => {

        commit('SET_STATUS', statuses.updating);

        let response = await http.update(state.endpoint + '/' + state.selected[state.key], data);

        if(response.status == 200) {

            commit('SELECT_ITEM',  response.data);

            commit('UPDATE_ITEM',  response.data);
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },

    patch: async ({commit, state}, data) => {

        let response = await http.update(state.endpoint + '/' + state.selected[state.key] + '/' + Object.keys(data)[0], data);

        if(response.status == 200) {
            commit('SELECT_ITEM', response.data)
        }

        return response;
    },

    unload: ({commit}) => {

        commit('SET_FILTER', {});

        commit('SET_COLLECTION', []);
    },

    store: async({commit, state}, data) => {

        commit('SET_STATUS', statuses.saving);

        let response = await http.post(state.endpoint, data);

        if(response.status == 201) {
            commit('PREPPEND_ITEM', response.data);
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },

    select: ({commit}, data = {}) => {
        commit('SELECT_ITEM',data);
    },

    deselect: ({commit}) => {
        commit('SELECT_ITEM');
    },

    delete: async ({commit, state}, id) => {

        commit('SET_STATUS', statuses.deleting);

        let response = await http.destroy(state.endpoint + '/' + state.selected[state.key]);

        if(response.status == 200) {

            commit('DELETE_ITEM',  state.selected);

            commit('SELECT_ITEM');
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },
}
