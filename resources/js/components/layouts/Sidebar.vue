<template>
    <div>
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
    </div>
</template>

<script>
    export default {
        name: "Sidebar"
    }
</script>

<style scoped>

</style>