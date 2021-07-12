import collect from "collect.js";

export const baseMutations = {
    SET_COLLECTION: (state, value) => {
        state.collection = value;
    },

    SET_FILTER: (state, value) => {
        state.filters = value;
    },

    SET_STATUS: (state, value) => {
        state.status = value;
    },

    SET_CURRENT_PAGE: (state, value) => {
        state.currentPage = value;
    },

    SET_LAST_PAGE: (state, value) => {
        state.lastPage = value;
    },

    SET_FROM: (state, value) => {
        state.itemFrom = value;
    },

    SET_TO: (state, value) => {
        state.itemTo = value;
    },

    SET_PER_PAGE: (state, value) => {
        state.perPage = value;
    },

    SET_TOTAL: (state, value) => {
        state.total = value;
    },

    SELECT_ITEM: (state, value = {}) => {
        state.selected = value;
    },

    UPDATE_ITEM: (state, item) => {

        let index = state.collection.findIndex( list_item => list_item[state.key] === item[state.key] );

        if(index !== false) {
            state.collection[index] = item;

            return;
        }
    },

    DELETE_ITEM: (state, item) => {

        let index = state.collection.findIndex( list_item => list_item[state.key] === item[state.key] );

        if (index !== false) {

            state.collection.splice(index, 1);

            return;
        }

        console.warn('Index not found');
    },

    PREPPEND_ITEM: (state, item) => {
        state.collection.unshift(item);
    },

    APPEND_ITEM: (state, item) => {
        state.collection.push(item);
    },
}
