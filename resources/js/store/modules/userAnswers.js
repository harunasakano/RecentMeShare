export default {
    namespaced: true,
    state: {
        user_answers: [],
    },

    getters: {
        userAnswers(state) {
            return state.user_answers;
        },
    },

    mutations: {
        setUserAnswers(state, payload) {
            state.user_answers = payload;
        },
    },

    actions: {
        doUpdate({ commit }, user_answers) {
            commit("setUserAnswers", { user_answers });
        },
    },
};
