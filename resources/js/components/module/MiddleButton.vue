<template>
    <div class="middle-button-wrapper">
        <button type="button" class="middle-button">{{ text }}</button>
    </div>
</template>

<script>
export default {
    name: "MiddleButton",
    props: ["text"],
};
</script>

<style scoped>
.middle-button-wrapper {
    margin: 25px 0 25px 0;
}

.middle-button {
    display: block;
    position: relative;
    padding: 10px 20px 10px 20px;
    text-align: center;
    text-decoration: none;
    color: #1b1b1b;
    background: #fff;
    border: 1px solid #1b1b1b;
}

.middle-button:hover {
    background: #1b1b1b;
    color: #fff;
    cursor: pointer;
    text-decoration: none;
}
</style>
