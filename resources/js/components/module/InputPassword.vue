<template>
    <div class="input-password-area">
        <p class="password-head-txt">共有用パスワード</p>
        <input
            v-model="pass"
            @input="sendInputPass"
            placeholder="半角英数4〜8文字まで"
            type="password"
            class="m-form-password"
            name="m-password"
            size="22"
            maxlength="8"
            minlength="4"
        />
    </div>
</template>

<script>
export default {
    name: "InputPassword",

    methods: {
        sendInputPass: function () {
            this.$emit("getInputPass", this.pass);
        },
    },
};
</script>

<style scoped>
.m-form-password {
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 2px;
    border: 2px solid #1b1b1b;
    box-sizing: border-box;
    text-align: center;
}
.password-head-txt {
    display: inline-block;
    margin-right: 20px;
}
</style>
