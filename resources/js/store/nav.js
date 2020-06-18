
export const nav = {

    namespaced: true,

    state: {
        leftText: ''
    },

    mutations: {

        setLeftText: (state, text) => {
            state.leftText = text;
        }
    },

    actions: {

        loadLeftText: ({commit}, text) => {
            commit('setLeftText', text);
        }

    },

    getters: {

        leftText: (state) => {
            return state.leftText
        }

    }

}
