import Vuex from "vuex";

import userAnswers from "./modules/userAnswers";
import userQuestions from "./modules/userQuestions";
import shareInfo from "./modules/shareInfo";
import shareQandA from "./modules/shareQandA";

export default new Vuex.Store({
    modules: { userAnswers, userQuestions, shareInfo, shareQandA },
});
