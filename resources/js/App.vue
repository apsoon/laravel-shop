<template>
    <el-container>
        <el-header>Header</el-header>
        <el-container>
            <el-aside width="200px">
                <el-menu :unique-opened="true"
                         :router="true" default-active="1">
                    <el-menu-item index="index">
                        <i class="el-icon-menu"></i>
                        <span slot="title">首页</span>
                    </el-menu-item>
                    <el-submenu index="goods">
                        <template slot="title"><i class="el-icon-message"></i>商品管理</template>
                        <el-menu-item index="list">商品列表</el-menu-item>
                        <el-menu-item index="category-list">商品分类</el-menu-item>
                        <el-menu-item index="brand-list">品牌管理</el-menu-item>
                        <el-menu-item index="specification">规格管理</el-menu-item>
                        <el-menu-item index="attribute">属性管理</el-menu-item>
                    </el-submenu>
                    <el-submenu index="order">
                        <template slot="title"><i class="el-icon-menu"></i>导航二</template>
                        <el-menu-item-group>
                            <template slot="title">分组一</template>
                            <el-menu-item index="2-1">选项1</el-menu-item>
                            <el-menu-item index="2-2">选项2</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="分组2">
                            <el-menu-item index="2-3">选项3</el-menu-item>
                        </el-menu-item-group>
                        <el-submenu index="2-4">
                            <template slot="title">选项4</template>
                            <el-menu-item index="2-4-1">选项4-1</el-menu-item>
                        </el-submenu>
                    </el-submenu>
                    <el-submenu index="coupon">
                        <template slot="title"><i class="el-icon-setting"></i>导航三</template>
                        <el-menu-item-group>
                            <template slot="title">分组一</template>
                            <el-menu-item index="3-1">选项1</el-menu-item>
                            <el-menu-item index="3-2">选项2</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="分组2">
                            <el-menu-item index="3-3">选项3</el-menu-item>
                        </el-menu-item-group>
                        <el-submenu index="3-4">
                            <template slot="title">选项4</template>
                            <el-menu-item index="3-4-1">选项4-1</el-menu-item>
                        </el-submenu>
                    </el-submenu>
                    <el-submenu index="ad">
                        <template slot="title"><i class="el-icon-setting"></i>广告管理</template>
                        <el-menu-item index="ad-list">广告列表</el-menu-item>
                    </el-submenu>
                </el-menu>
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
        components: {},
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