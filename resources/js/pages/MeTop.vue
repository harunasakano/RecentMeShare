<template>
    <div class="top-contents">
        <h3>最近のあなたの状態を、友人や家族、仲間にシェアしませんか？</h3>
        <p>
            ランダムに5つの質問がでますので、回答してみましょう（140文字以内）<br />
            答えたくない質問はスキップして大丈夫です。<br />
            代わりの質問がでます。
        </p>
        <div class="Loading-now" v-show="!this.q_api_flg">
            <p class="loading-txt">
                ※質問を読み込んでいます..少々お待ちください。間もなく始められます。
            </p>
        </div>
        <div class="start-button-area" v-show="this.q_api_flg">
            <LargeButton @click="moveQuestion()" :text="text" />
        </div>
    </div>
</template>

<script>
import LargeButton from "../components/module/LargeButton";
import axios from "axios";

export default {
    name: "MeTop",
    components: { LargeButton },
    data() {
        return {
            text: "始めてみる",
            save: "保存する",
            questions: [],
            q_api_flg: false,
        };
    },
    created() {
        const uri = "/api/get_all_questions";
        axios
            .get(uri)
            .then((response) => {
                this.questions = response.data;
                //storeに登録
                this.$store.commit(
                    "userQuestions/setUserQuestions",
                    this.questions
                );
                this.q_api_flg = true;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        moveQuestion() {
            this.$router.push({
                name: "question",
            });
        },
    },
};
</script>

<style scoped>
.loading-txt {
    margin: 35px;
    font-size: 14px;
    color: #605b64;
}
</style>
