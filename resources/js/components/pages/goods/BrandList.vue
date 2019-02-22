<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link :to="{path: '/brand-add',query :{type: 'create'}}">
                <el-button type="primary" size="medium">添加品牌</el-button>
            </router-link>
            <el-button type="danger" size="medium" @click="deleteBrands()">批量删除</el-button>
        </div>
        <el-table
                ref="multipleTable"
                :data="brandList"
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    type="selection"
                    width="55">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="cover"
                    label="品牌图片"
                    width="120">
                <template slot-scope="scope">
                    <img class="logo" :src="scope.row.logo"/>
                </template>
            </el-table-column>
            <el-table-column
                    prop="region"
                    label="地区"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="describe"
                    label="描述"
                    min-width="1">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop=""
                    width="300"
                    label="操作">
                <template slot-scope="scope">
                    <router-link :to="{path: '/brand-add',query :{type: 'modify', brandId:scope.row.id}}">
                        <el-button size="mini" type="info">修改</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state"
                               size="mini"
                               type="warning"
                               @click="modifyState('disable', scope.$index, scope.row.id)">禁用
                    </el-button>
                    <el-button v-else
                               size="mini"
                               type="success"
                               @click="modifyState('enable', scope.$index, scope.row.id)">启用
                    </el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteBrand(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BrandList",
        data: function () {
            return {
                brandList: [],
                pageNo: 1
            }
        },
        mounted: function () {
            let that = this;
            console.info("---------");
            axios.get('brand/list')
                .then(res => {
                    if (res.data.code === 2000) {
                        // if (res.data.data) {
                        // that.pageNo++;
                        that.brandList = res.data.data;
                        console.info(res.data.data);
                        // }
                    }
                });
        },
        methods: {
            modifyState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 0;
                let message = state ? "启用" : "禁用";
                that.$confirm("确认" + message + "品牌?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post("brand/modState", {
                        state: state,
                        id: id
                    }).then(res => {
                        if (res.data.code === 2000) that.brandList[index].state = state;
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消' + message
                    });
                });
            },
            deleteBrand: function (index, id) {
                let that = this;
                this.$confirm("删除品牌可能会导致严重的问题，是否确认删除！", '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let ids = [];
                    ids.push(id);
                    axios.post("brand/delete", {
                        ids: ids
                    })
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.brandList.splice(index, 1);
                                that.$message({
                                    type: 'success',
                                    message: '删除成功!'
                                });
                            }
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            deleteBrands: function () {
                let that = this;
                let selections = that.$refs.multipleTable.selection;
                if (selections.length) {
                    that.$confirm("删除品牌可能会导致严重的问题，是否确认删除！", '提示', {
                        confirmButtonText: "确认",
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        let ids = [];
                        for (let section of selections) {
                            ids.push(section.id);
                        }
                        axios.post("brand/delete", {
                            ids: ids
                        })
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$message({
                                        type: 'success',
                                        message: '删除成功!'
                                    });
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
    }
</script>

<style scoped>
    .logo {
        width: 48px;
        height: 48px;
    }
</style>