<template>
    <div class="confirm-authority-contents">
        <h3>パスワード確認</h3>
        <p v-show="this.pass_loading">お待ちください..</p>
        <p v-show="!this.pass_loading">
            共有してもらったパスワードを入力してください。
        </p>
        <div class="password-area">
            <InputPassword @getInputPass="getPass"></InputPassword>
        </div>
        <div class="submit-button">
            <middle-button
                :text="this.submit_txt"
                @click="moveShow(this.input_pass)"
            ></middle-button>
        </div>
    </div>
</template>

<script>
import InputPassword from "../components/module/InputPassword";
import MiddleButton from "../components/module/MiddleButton";
import axios from "axios";

export default {
    name: "ConfirmBrowsingAuthority",
    components: { MiddleButton, InputPassword },
    data() {
        return {
            submit_txt: "決定",
            input_pass: "",
            pass_error: null,
            pass_loading: false,
        };
    },
    methods: {
        getPass(inputPass) {
            this.input_pass = inputPass;
        },
        //passwordをチェックし、照合OKの場合showページへ移動する
        moveShow(input_pass) {
            let pass_check_res = this.validateHalfWidthAlphanumeric(input_pass);
            if (pass_check_res) {
                alert(pass_check_res);
                return;
            }
            this.collatePasswordSaveAnswer();
        },
        validateHalfWidthAlphanumeric(str) {
            if (
                str.match(/[^A-Za-z0-9]+/) ||
                !str ||
                str.length >= 9 ||
                str.length <= 3
            ) {
                return "パスワードが違います";
            } else {
                return null;
            }
        },
        collatePasswordSaveAnswer() {
            this.pass_loading = true;
            axios
                .post("/api/collate_password_get_answer", {
                    share_id: this.$route.params["share_id"],
                    pass: this.input_pass,
                })
                .then((res) => {
                    if (res.data == "not exist pass") {
                        this.pass_loading = false;
                        alert("パスワードが一致しません。");
                        return;
                    } else if (res.data == "error") {
                        this.pass_loading = false;
                        alert("エラーが発生しました。");
                        return;
                    }
                    this.show_data = res.data;
                    this.$store.commit(
                        "shareQandA/setShareQandA",
                        this.show_data
                    );
                    //遷移
                    this.$router.push({
                        name: "show-certified",
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style scoped></style>
