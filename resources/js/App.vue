<template>
    <!--<el-container class="app-container" direction="vertical">-->
    <!--<el-header class="app-header" height="50px">-->
    <!--<Header></Header>-->
    <!--</el-header>-->
    <!--<el-container style="height: 100%;" direction="horizontal">-->
    <!--<el-aside width="230px">-->
    <!--<Sidebar></Sidebar>-->
    <!--</el-aside>-->
    <!--<el-main>-->
    <transition name="fade"
                mode="out-in">
        <router-view></router-view>
    </transition>
    <!--<router-view></router-view>-->
    <!--</el-main>-->
    <!--</el-container>-->
    <!--</el-container>-->
</template>
<script scoped>
    import Sidebar from "./views/layouts/Sidebar";
    import Header from "./views/layouts/Header";

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

            this.windowHeight = h + "px"; //减去页面上固定高度height

        },
        mounted() {
        },
    }
</script>
<style lang="scss">
    body {
        margin: 0px;
        padding: 0px;
        /*background: url(assets/bg1.jpg) center !important;
            background-size: cover;*/
        // background: #1F2D3D;
        font-family: Helvetica Neue, Helvetica, PingFang SC, Hiragino Sans GB, Microsoft YaHei, SimSun, sans-serif;
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
    }

    #app {
        position: absolute;
        top: 0px;
        bottom: 0px;
        width: 100%;
    }

    .el-submenu [class^=fa] {
        vertical-align: baseline;
        margin-right: 10px;
    }

    .el-menu-item [class^=fa] {
        vertical-align: baseline;
        margin-right: 10px;
    }

    .toolbar {
        background: #f2f2f2;
        padding: 10px;
        //border:1px solid #dfe6ec;
        margin: 10px 0px;
        .el-form-item {
            margin-bottom: 10px;
        }
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: all .2s ease;
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0;
    }

    /*.app-container {*/
    /*width: 100%;*/
    /*background-color: #ecf0f5;*/
    /*}*/

    /*.app-header {*/
    /*padding: 0;*/
    /*}*/
</style>