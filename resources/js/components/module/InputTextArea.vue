<template>
    <textarea
        v-model="inputTxt"
        name="answer_txt"
        class="m-form-textarea"
        cols="40"
        rows="7"
        maxlength="140"
    ></textarea>
</template>

<script>
export default {
    name: "InputTextArea",
    props: {
        modelValue: {
            type: String,
        },
    },
    computed: {
        inputTxt: {
            get: function () {
                return this.modelValue;
            },
            set: function (modelValue) {
                this.$emit("sendInputTxt", modelValue);
            },
        },
    },
};
</script>

<style scoped>
.m-form-item-textarea textarea {
    height: 300px;
}

.m-form-textarea {
    display: block;
    width: 100%;
    padding: 4px 16px;
    border-radius: 4px;
    border: none;
    box-shadow: 0 0 0 1px #ccc inset;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    resize: vertical;
}

.m-form-textarea:focus {
    outline: 0;
    box-shadow: 0 0 0 2px rgb(33, 150, 243) inset;
}
</style>
