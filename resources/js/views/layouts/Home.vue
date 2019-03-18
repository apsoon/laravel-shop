<template>
    <el-row class="container">
        <el-col :span="24" class="header">
            <el-col :span="10" class="logo" style="width: 230px;">
                电商小程序后台
            </el-col>
        </el-col>
        <el-col :span="24" class="main">
            <aside class="sidebar">
                <el-menu :default-active="$route.path" class="el-menu-vertical-demo" @open="handleopen"
                         @close="handleclose" @select="handleselect"
                         unique-opened router v-show="!collapsed">
                    <template v-for="(item,index) in $router.options.routes" v-if="!item.hidden">
                        <el-submenu class="menu-item" :index="index+''" v-if="!item.leaf">
                            <template slot="title"><i :class="item.iconCls"></i>{{item.name}}</template>
                            <el-menu-item class="sub-menu-item" v-for="child in item.children" :index="child.path"
                                          :key="child.path"
                                          v-if="!child.hidden">{{child.name}}
                            </el-menu-item>
                        </el-submenu>
                        <el-menu-item class="menu-item" v-if="item.leaf&&item.children.length>0"
                                      :index="item.children[0].path"><i
                                :class="item.iconCls"></i>{{item.children[0].name}}
                        </el-menu-item>
                    </template>
                </el-menu>
            </aside>
            <section class="content-container">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="breadcrumb-container">
                    </el-col>
                    <el-col :span="24" class="content-wrapper">
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>
</template>

<script>
    import Sidebar from "./Sidebar.vue";
    import Header from "./Header.vue";

    export default {
        name: "Home",
        components: {Header, Sidebar},
        data: function () {
            return {}
        },
        methods: {}
    }
</script>

<style>
    .container {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }

    .header {
        background-color: #3c8dbc;
        width: 100%;
        height: 60px;
        line-height: 60px;
        color: #fff;
    }

    .logo {
        width: 230px;
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

    .main {
        display: flex;
        position: absolute;
        top: 60px;
        bottom: 0;
        overflow: hidden;
    }

    .sidebar {
        flex: 0 0 230px;
        width: 230px;
        background-color: #E9EDF3;
    }

    .content-container {
        flex: 1;
        overflow-y: scroll;
        padding: 20px;
    }

    .content-wrapper {
        background-color: #fff;
        box-sizing: border-box;
    }

    .el-menu {
        border: 0;
    }

    .sub-menu-item {
        background-color: #DEE2ED;
    }

    .menu-item {
        background-color: #E9EDF3;
    }
</style>