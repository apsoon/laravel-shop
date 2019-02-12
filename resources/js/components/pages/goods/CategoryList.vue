<template>
    <div>
        <router-link :to="{path:'/category-add', query: {parentId: 0, parentName:'一级分类'}}">
            <el-button type="primary" size="medium">添加一级分类</el-button>
        </router-link>
        <el-tree :data="categoryList"
                 empty-text="没有分类"
                 node-key="id"
                 ref="treeCategory"
                 default-expand-all
                 :expand-on-click-node="false">
            <span class="custom-tree-node" slot-scope="{ node, data }">
                <span>{{ node.label }}</span>
                <span>
                    <router-link :to="{path:'/category-add', query: {parentId: data.id, parentName: data.name}}">
                        <el-button type="text" size="mini">添加子分类</el-button>
                    </router-link>
                    <el-button
                            type="text"
                            size="mini"
                            @click="() => remove(node, data)">
                        删除分类
                    </el-button>
                </span>
            </span>
        </el-tree>
    </div>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "CategoryList",
        data: function () {
            return {
                categoryList: [],
            }
        },
        mounted: function () {
            let that = this;
            axios.get("category/treeList").then(res => {
                if (res.data.code === 2000) {
                    that.categoryList = res.data.data;
                }
            }).catch(err => {
            });
        },
    }
</script>

<style scoped>
    .custom-tree-node {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        padding-right: 8px;
    }
</style>