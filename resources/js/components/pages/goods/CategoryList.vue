<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link :to="{path:'/category-add', query: {parentId: 0, parentName:'一级分类'}}">
                <el-button type="primary" size="medium">添加一级分类</el-button>
            </router-link>
        </div>
        <el-tree :data="categoryList"
                 empty-text="没有分类"
                 node-key="id"
                 ref="treeCategory"
                 :props="categoryTreeProps"
                 :default-expand-all="false"
                 :expand-on-click-node="false">
            <span class="custom-tree-node" slot-scope="{ node, data }">
                <span>
                    {{ data.name }}
                    <span v-if="data.is_recom === 1">热推</span>
                </span>
                <span>
                    <router-link :to="{path:'/category-add', query: {parentId: data.id, parentName: data.name}}"
                                 v-if="data.level &lt; 3">
                        <el-button type="text" size="mini">添加子分类</el-button>
                    </router-link>
                    <el-button type="text" size="mini" @click="removeCategory(node, data)">删除分类</el-button>
                    <el-button type="text" size="mini" @click="modifyRecom('add', node, data)"
                               v-if="data.level === 1 && data.is_recom === 0">设置首页热推</el-button>
                    <el-button type="text" size="mini" @click="modifyRecom('remove', node, data)"
                               v-else-if="data.level === 1 && data.is_recom === 1">取消首页热推</el-button>
                </span>
            </span>
        </el-tree>
    </el-card>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "CategoryList",
        data: function () {
            return {
                categoryList: [],
                categoryTreeProps: {
                    label: name,
                    // children: children
                }
            }
        },
        mounted: function () {
            let that = this;
            axios.get("category/treeList").then(res => {
                if (res.data.code === 2000) {
                    that.categoryList = res.data.data;
                    console.info(that.categoryList);
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
                    }).then(res => {
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
            },
            modifyRecom: function (type, node, data) {
                let that = this,
                    message = "设置为";
                if (type === 0) message = "取消";
                that.$confirm("是否" + message + "首页热推分类", '警告', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let isRecom = type === 'add' ? 1 : 0,
                        param = {
                            id: data.id,
                            isRecom: isRecom
                        };
                    axios.post("/category/recom", param)
                        .then(res => {
                            if (res.data.code === 2000) {
                                console.info(node);
                                node.data.is_recom = isRecom
                            }
                        })
                }).catch(() => {
                    that.$message({
                        type: 'info',
                        message: '已取消设置'
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
        font-size: 16px;
        padding-right: 8px;
    }

</style>
<style>
    .el-tree-node__content {
        height: 40px !important;
        font-size: 16px;
    }
</style>