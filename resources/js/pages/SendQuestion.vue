<template>
    <div class="q-contents">
        <h3>質問{{ question_count }}</h3>
        <div class="q-aria">
            <p v-show="this.question_index">{{ questions[question_index] }}</p>
            <div class="answer-input-area">
                <input-text-area
                    :value="inputAnswer"
                    @sendInputTxt="saveInputAnswers"
                />
            </div>
            <div
                class="save-button"
                v-show="Object.keys(this.question_keys).length >= 2"
            >
                <middle-button
                    @click="
                        validate();
                        saveQuestionAfterProcess();
                    "
                    :text="save"
                />
            </div>
            <div
                class="confirm-area"
                v-show="Object.keys(this.question_keys).length == 1"
            >
                <div class="confirm-button">
                    <middle-button
                        @click="manualMoveConfirm()"
                        :text="confirm"
                    />
                </div>
            </div>
            <div
                class="skip-area"
                v-show="Object.keys(this.question_keys).length >= 2"
            >
                <skip-button @click="skipQuestionAfterProcess()" />
            </div>
        </div>
    </div>
</template>

<script>
import InputTextArea from "../components/module/InputTextArea";
import MiddleButton from "../components/module/MiddleButton";
import SkipButton from "../components/module/Skip";

export default {
    name: "SendQuestion",
    components: { InputTextArea, SkipButton, MiddleButton },
    data() {
        return {
            save: "保存する",
            confirm: "確認する",
            questions: [],
            question_count: 1,
            question_index: null,
            empty_check: false,
            inputAnswers: {},
            question_keys: {},
            inputAnswer: "",
            upperLimitAnswer: 5,
            select_key: null,
        };
    },
    methods: {
        saveInputAnswers(payload) {
            this.inputAnswer = payload;
            this.inputAnswers[this.question_index] = payload;
        },

        //回答保存後の処理
        saveQuestionAfterProcess() {
            if (!this.empty_check) {
                return;
            }

            //回答が5つ揃った段階で、確認画面へ遷移
            if (this.question_count >= this.upperLimitAnswer) {
                this.setUserAnswers();
                this.$router.push({
                    name: "confirm-url",
                });
            }

            this.question_count++;
            this.setQuestionIndex();
            this.clearInputTxt();
            return this.question_count;
        },

        //回答スキップ時の処理
        skipQuestionAfterProcess() {
            if (this.question_index in this.inputAnswers) {
                delete this.inputAnswers[this.question_index];
            }
            this.clearInputTxt();
            this.setQuestionIndex();
        },

        //回答欄をクリアにする
        clearInputTxt() {
            this.inputAnswer = "";
        },

        //質問indexのランダム選出
        setQuestionIndex() {
            this.select_key = this.select_key == null ? 0 : this.select_key + 1;
            this.question_index = this.question_keys[this.select_key];
            delete this.question_keys[this.select_key];
            return this.question_index;
        },

        //storeにユーザーの回答を登録する
        setUserAnswers() {
            this.$store.commit("userAnswers/setUserAnswers", this.inputAnswers);
        },

        //システムで出せる質問が上限に達した場合、現状の仕様ではユーザの任意で確認画面に遷移することになる
        manualMoveConfirm() {
            //1つ以上の回答が無い場合は確認画面に遷移不可
            if (!Object.keys(this.inputAnswers).length) {
                alert("回答が一つ以上必要です..");
                return;
            }

            //最後の質問に回答が無い場合（空白）は回答リストから削除
            if (
                this.question_index in this.inputAnswers &&
                !this.inputAnswers[this.question_index]
            ) {
                delete this.inputAnswers[this.question_index];
            }

            this.setUserAnswers();
            this.$router.push({
                name: "confirm-url",
            });
        },

        validate() {
            //現在質問中の項目への回答が未入力で保存クリックした場合NG
            if (!this.inputAnswers[this.question_index]) {
                alert("入力してください");
                this.empty_check = false;
                return;
            } else {
                this.empty_check = true;
            }
        },
    },
    created() {
        this.questions = this.$store.state.userQuestions.user_questions;
        this.question_keys = Object.keys(this.questions);
        this.question_keys = this.question_keys.sort(() => Math.random() - 0.5);
        this.setQuestionIndex();
    },
};
</script>

<style scoped>
.q-aria {
    position: relative;
}

.answer-input-area {
    width: 330px;
}

.confirm-link {
    text-decoration: unset;
}

.save-button {
    position: absolute;
    left: 252px;
}

.confirm-button {
    position: absolute;
    left: 252px;
    top: 230px;
}
</style>
