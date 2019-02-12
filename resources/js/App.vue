<template>
    <el-container>
        <el-header>Header</el-header>
        <el-container>
            <el-aside width="200px">
                <Siderbar></Siderbar>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>
<script scoped>
    export default {
        data() {
            return {}
        },
        components: {Siderbar},
        computed: {},
        methods: {},
        mounted() {
        },
    }
</script>
<style scoped>
    .header {
        position: relative;
        box-sizing: border-box;
        width: 100%;
        height: 70px;
        font-size: 22px;
        background-color: #518CB8;
        color: #fff;
    }

    .header-left {
        width: 250px;
        height: 70px;
        background-color: #497EA5;
    }

    .sidebar-el-menu:not(.el-menu--collapse) {
        width: 250px;
    }

    .sidebar {
        display: block;
        position: absolute;
        left: 0;
        top: 70px;
        bottom: 0;
        overflow-y: scroll;
        background: #242C31;
    }
</style>