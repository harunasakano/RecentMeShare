<template>
    <button class="btn btn-border">{{ text }}</button>
</template>

<script>
export default {
    name: "LargeButton",
    props: ["text"],
};
</script>

<style scoped>
button.btn-border {
    height: 50px;
    border: 2px solid #000;
    border-radius: 0;
    background: #fff;
    box-shadow: 4px 4px 0 #000;
    width: 160px;
    font-size: 16px;
}

button.btn-border:hover {
    -webkit-box-shadow: -4px -4px 0 #000;
    box-shadow: -4px -4px 0 #000;
}
</style>
