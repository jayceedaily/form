
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

        let response = await dispatch('index', {...state.__queries, ...state.queries, });

        if (response.status == 200) {

            response.data.data.forEach((item) => {
                item.status =  statuses.idle;

                item.delete = () => {
                    dispatch('select', item);
                    commit('SET_SELECT_STATUS', statuses.deleting);
                    dispatch('delete');
                }
            });

            commit('SET_COLLECTION',  response.data.data);

            commit('SET_PAGINATE', {
                currentPage:    response.data.current_page,
                from:           response.data.from,
                to:             response.data.to,
                perPage:        response.data.per_page,
                lastPage:       response.data.last_page,
                total:          response.data.total,
            });
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },

    /**
     * Send request to API endpoint and
     * return the response value.
     *
     * @param {*} param0
     * @param {*} queries
     * @returns
     */
    index: async({state}, queries = {}) => {

        let response = await http.get(state.endpoint, queries);

        return response;
    },

    /**
     *
     *
     * @param {*} param0
     * @param {*} queries
     */
    setQueries: async ({commit}, queries) => {

        // router.push({
        //     ...router.currentRoute,
        //     query: queries
        // }).catch(()=> {});

        commit('SET_QUERIES', queries)
    },

    /**
     * Set hidden queries
     *
     * @param {*} param0
     * @param {*} queries
     */
    setHiddenQueries: async ({commit}, queries) => {
        commit('SET_HIDDEN_QUERIES', queries)
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

        commit('SET_QUERIES', {});

        commit('SET_HIDDEN_QUERIES', {});

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
        commit('SELECT_ITEM', data);
    },

    deselect: ({commit}) => {
        commit('SELECT_ITEM');
    },

    delete: async ({commit, state}, id) => {

        commit('SET_STATUS', statuses.deleting);

        let response = await http.delete(state.endpoint + '/' + state.selected[state.key]);

        if(response.status == 200) {

            commit('DELETE_ITEM',  state.selected);

            commit('SELECT_ITEM');
        }

        commit('SET_STATUS', statuses.idle);

        return response;
    },
}
