<template>
    <div class="main">
        <div class="left">
            电商小程序后台
        </div>
    </div>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>
    .main {
        background-color: #3c8dbc;
        width: 100%;
        height: 100%;
    }

    .left {
        width: 229px;
        height: 100%;
        background-color: #367fa9;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 20px;
    }
</style>