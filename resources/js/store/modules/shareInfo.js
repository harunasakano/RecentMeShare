export default {
    namespaced: true,
    state: {
        share_info: [],
    },

    getters: {
        shareInfo(state) {
            return state.share_info;
        },
    },

    mutations: {
        setShareInfo(state, payload) {
            state.share_info = payload;
        },
    },

    actions: {
        doUpdate({ commit }, share_info) {
            commit("setShareInfo", { share_info });
        },
    },
};
