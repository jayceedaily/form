
export const baseGetters = {
    collection: (state) => {
        return state.collection;
    },

    selected: (state) => {
        return Object.assign({}, state.selected);
    },

    hasSelected: (state) => {
        return Object.entries(state.selected).length === 0
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

    queries: (state) => {
        return  Object.assign({}, state.queries);
    },

    perPage: (state) => {
        return Number(state.perPage);
    },
}
