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
                            @click="removeCategory(node, data)">
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
        methods: {
            removeCategory: function (node, data) {
                let that = this;
                that.$confirm("删除分类可能会导致严重的问题，是否确认删除！", '警告', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'danger'
                }).then(() => {
                    axios.post("category/delete", {
                        id: data.id
                    })
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.$message({
                                    type: 'success',
                                    message: '删除成功!'
                                });
                                const parent = node.parent;
                                const children = parent.data.children || parent.data;
                                const index = children.findIndex(d => d.id === data.id);
                                children.splice(index, 1);
                                that.$router.reload();
                            }
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            }
        }
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