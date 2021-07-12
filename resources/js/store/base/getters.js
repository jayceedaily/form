export const baseGetters = {
    collection: (state) => {
        return state.collection;
    },

    selected: (state) => {
        return Object.assign({}, state.selected);
    },

    hasSelected: (state) => {
        return JSON.stringify(state.selected) == '{}' ? false : true;
    },

    hasNextPage: (state) => {
        return state.currentPage != state.lastPage;
    },

    hasPrevPage: (state) => {
        return state.currentPage > 1;
    },

    total: (state) => {
        return state.total;
    },

    currentPage: (state) => {
        return state.currentPage;
    },

    lastPage: (state) => {
        return state.lastPage;
    },

    status: (state) => {
        return state.status
    },

    totalItem: (state) => {
        return state.total;
    },

    itemFrom: (state) => {
        return state.itemFrom;
    },

    itemTo: (state) => {
        return state.itemTo;
    },

    filters: (state) => {
        return  Object.assign({}, state.filters);
    },

    perPage: (state) => {
        return Number(state.perPage);
    },
}
