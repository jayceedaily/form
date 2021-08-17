const statuses = Object.freeze({
    indexing: 'INDEXING',
    showing: 'SHOWING',
    updating: 'UPDATING',
    saving: 'SAVING',
    idle: 'IDLE',
});

export const baseStates = {

        /**
         * URL for REST making AXIOS request
         * to the server of the API.
         */
         endpoint: '',

         /**
          * Primary key of object that is
          * used for API transactions.
          */
         key: 'id',

         /**
          * Collection of objects
          */
         collection: [],

         /**
          * Selected object to be used for
          * specific transactions.
          */
         selected: {},

         /**
          *
          */
         status: statuses.idle,

         /**
          * Query params used to persist
          * API queries on runtime and reload
          *
          */
         queries: {},

        /**
          * Queries hidden from URL
          * and is persisted on requests
          */
         __queries: {},

         /**
          * Pagination
          */
         currentPage: 0,
         perPage: 0,
         lastPage: 0,
         total: 0,
         itemFrom: 0,
         itemTo: 0,
}
