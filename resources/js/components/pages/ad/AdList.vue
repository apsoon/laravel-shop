<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link to="/ad-add">
                <el-button type="primary" size="medium">添加广告</el-button>
            </router-link>
            <el-button type="danger" size="medium" @click="deleteAds">批量删除</el-button>
        </div>
        <el-table
                ref="multipleTable"
                :data="adList"
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
                    prop="position"
                    label="位置"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="sort_order"
                    label="排序"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop=""
                    label="操作">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="info"
                            @click="">修改
                    </el-button>
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
                            @click="deleteAd(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdList",
        data() {
            return {
                adList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get('ad/list').then(res => {
                that.adList = res.data.data;
            });
        },
        methods: {
            modifyState: function (type, index, id) {
                let state = 1;
                if (type === "disable") state = 0;
                let that = this;
                console.info("index = ", index, ", id = ", id);
                axios.post("ad/modState", {
                    state: state,
                    id: id
                }).then(res => {
                    if (res.data.code === 2000) that.adList[index].state = state;
                });
            },
            deleteAd: function (index, id) {
                let that = this;
                this.$confirm(' 确认删除当前广告?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let ids = [];
                    ids.push(id);
                    axios.post("ad/delete", {
                        ids: ids
                    })
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.adList.splice(index, 1);
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
            deleteAds: function () {
                let that = this;
                let selections = that.$refs.multipleTable.selection;
                if (selections.length) {
                    that.$confirm("确认删除选中的广告?", '提示', {
                        confirmButtonText: "确认",
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        let ids = [];
                        for (let section of selections) {
                            ids.push(section.id);
                        }
                        axios.post("ad/delete", {
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

</style>