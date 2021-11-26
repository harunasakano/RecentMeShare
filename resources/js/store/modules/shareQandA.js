export default {
    namespaced: true,
    state: {
        share_q_and_a: [],
    },

    getters: {
        shareQandA(state) {
            return state.share_q_and_a;
        },
    },

    mutations: {
        setShareQandA(state, payload) {
            state.share_q_and_a = payload;
        },
    },

    actions: {
        doUpdate({ commit }, share_q_and_a) {
            commit("setShareQandA", { share_q_and_a });
        },
    },
};
