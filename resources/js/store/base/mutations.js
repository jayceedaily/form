export const baseMutations = {
    SET_COLLECTION: (state, value) => {
        state.collection = value;
    },

    SET_QUERIES: (state, value) => {
        state.queries = value;
    },

    SET_HIDDEN_QUERIES: (state, value) => {
        state.__queries = value;
    },

    SET_STATUS: (state, value) => {
        state.status = value;
    },

    SET_PAGINATE: (state, {currentPage, from, to, perPage, lastPage, total}) => {
        state.total         = total;
        state.itemTo        = to;
        state.perPage       = perPage;
        state.lastPage      = lastPage;
        state.itemFrom      = from;
        state.currentPage   = currentPage;
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
    },

    PREPPEND_ITEM: (state, item) => {
        state.collection.unshift(item);
    },

    APPEND_ITEM: (state, item) => {
        state.collection.push(item);
    },
}
