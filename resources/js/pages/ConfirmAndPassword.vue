<template>
    <div class="confirm-contents">
        <h3>回答を確認</h3>
        <div class="q_and_a_confirm_area">
            <div class="q-area">
                <div
                    v-for="(value, key, index) in answerKeyReturn()"
                    :key="index"
                >
                    <h5>{{ showUserQuestions[value] }}</h5>
                    <p>{{ showUserAnswers[value] }}</p>
                </div>
            </div>
            <div class="ans-area"></div>
            <div class="password-area">
                <InputPassword @getInputPass="getPass"></InputPassword>
            </div>
            <p class="note-password">
                ※このパスワードは再発行できないため、大切にメモしてください。
            </p>
            <div class="share-button">
                <middle-button
                    :text="share_txt"
                    @click="moveShare(this.input_pass)"
                ></middle-button>
            </div>
            <div class="redo-button">
                <middle-button :text="redo_txt"></middle-button>
            </div>
        </div>
    </div>
</template>

<script>
import InputPassword from "../components/module/InputPassword";
import MiddleButton from "../components/module/MiddleButton";
import axios from "axios";

export default {
    name: "ConfirmAndPassword",
    components: { MiddleButton, InputPassword },
    data() {
        return {
            share_txt: "この内容で共有する",
            redo_txt: "最初からやりなおす",
            question_ids: [],
            input_pass: "",
            share_data: [],
        };
    },
    methods: {
        answerKeyReturn() {
            return Object.keys(this.showUserAnswers);
        },
        getPass(inputPass) {
            this.input_pass = inputPass;
        },
        //passwordをチェックし、回答保存、shareページへ移動する
        moveShare(input_pass) {
            let pass_check_res = this.validateHalfWidthAlphanumeric(input_pass);
            if (pass_check_res) {
                alert(pass_check_res);
                return;
            }
            this.saveAnswerAndCreateUrl();
            this.$router.push({
                name: "share-url",
            });
        },

        saveAnswerAndCreateUrl() {
            axios
                .post("/api/save_answer_create_url", {
                    answers: this.showUserAnswers,
                    pass: this.input_pass,
                })
                .then((res) => {
                    this.share_data = res.data;
                    this.$store.commit(
                        "shareInfo/setShareInfo",
                        this.share_data
                    );
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        validateHalfWidthAlphanumeric(str) {
            if (str.match(/[^A-Za-z0-9]+/)) {
                return "半角英数で入力してください";
            } else if (!str || str.length >= 9 || str.length <= 3) {
                return "パスワードは4文字以上8文字以内で入力してください";
            } else {
                return null;
            }
        },
    },
    computed: {
        showUserAnswers() {
            return this.$store.state.userAnswers.user_answers;
        },
        showUserQuestions() {
            return this.$store.state.userQuestions.user_questions;
        },
    },
};
</script>

<style scoped>
.note-password {
    font-size: 13px;
    color: #f80f19;
}
</style>
