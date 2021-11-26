export default {
    namespaced: true,
    state: {
        user_questions: [],
    },

    getters: {
        userQuestions(state) {
            return state.user_questions;
        },
    },

    mutations: {
        setUserQuestions(state, payload) {
            state.user_questions = payload;
        },
    },

    actions: {
        doUpdate({ commit }, user_questions) {
            commit("setUserQuestions", { user_questions });
        },
    },
};
