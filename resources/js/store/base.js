
import { baseActions } from './base/actions';
import { baseGetters } from './base/getters';
import { baseMutations } from './base/mutations';
import { baseStates } from './base/states';

export const base = {

    namespaced: true,

    state: {
        ...baseStates,
    },

    mutations: {
        ...baseMutations,
    },

    actions: {
        ...baseActions,
    },

    getters: {
        ...baseGetters
    }
}

