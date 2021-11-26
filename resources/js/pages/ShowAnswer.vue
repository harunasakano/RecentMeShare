<template>
    <div class="q-contents">
        <p v-show="!showUserAnswers['questions']">回答を読み込んでいます。</p>
        <div
            v-for="(value, key, index) in showUserAnswers['questions']"
            :key="index"
        >
            <h5>{{ value }}</h5>
            <p>{{ showUserAnswers["answers"][key] }}</p>
        </div>
        <div v-show="showUserAnswers['questions']" class="top-link-area">
            <router-link to="/" class="top-back-link">
                <middle-button :text="top_link_txt"></middle-button>
            </router-link>
        </div>
    </div>
</template>

<script>
import MiddleButton from "../components/module/MiddleButton";

export default {
    name: "ShowAnswer",
    components: { MiddleButton },
    data() {
        return {
            top_link_txt: "TOPへ",
        };
    },
    computed: {
        showUserAnswers() {
            return this.$store.state.shareQandA.share_q_and_a;
        },
    },
};
</script>

<style scoped>
.top-back-link {
    text-decoration: unset;
}
</style>
