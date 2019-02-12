<template>
    <el-container class="app-container" direction="vertical">
        <el-header class="app-header">
            <Header></Header>
        </el-header>
        <el-container style="height: 100%;" direction="horizontal">
            <el-aside width="200px">
                <Sidebar></Sidebar>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>
<script scoped>
    import Sidebar from "./components/layouts/Sidebar";
    import Header from "./components/layouts/Header";

    export default {
        data() {
            return {
                windowHeight: 0,
            }
        },
        components: {Header, Sidebar},
        computed: {},
        methods: {},
        beforeMount() {

            let h = document.documentElement.clientHeight || document.body.clientHeight;

            this.windowHeight = h+"px"; //减去页面上固定高度height

        },
        mounted() {
        },
    }
</script>
<style scoped>
    .app-container {
        width: 100%;
    }

    .app-header {
        padding: 0;
    }
</style>