<template>
    <el-container class="app-container" direction="vertical">
        <el-header class="app-header" height="50px">
            <Header></Header>
        </el-header>
        <el-container style="height: 100%;" direction="horizontal">
            <el-aside width="230px">
                <Sidebar></Sidebar>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
    import Sidebar from "./Sidebar.vue";
    import Header from "./Header.vue";

    export default {
        name: "Home",
        components: {Header, Sidebar},
    }
</script>

<style>
    .el-header {
        padding: 0;
    }
</style>