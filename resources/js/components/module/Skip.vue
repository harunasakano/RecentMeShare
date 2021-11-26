<template>
    <div class="skip-page">
        <span class="skip-action"> >> この質問をスキップ</span>
    </div>
</template>

<script>
export default {
    name: "SkipButton",
};
</script>

<style scoped>
.skip-page {
    position: absolute;
    top: 160%;
}
.skip-action {
    cursor: pointer;
    color: #1b1b1b;
    font-size: 15px;
}
.skip-action:hover {
    color: #868b95;
}
</style>
