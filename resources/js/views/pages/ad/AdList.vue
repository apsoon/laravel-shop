<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <router-link :to="{path: '/ad-edit', query: {type: 'create'}}">
                <el-button type="primary" size="medium">添加广告</el-button>
            </router-link>
            <el-button type="danger" size="medium" @click="deleteAds">批量删除</el-button>
        </div>
        <el-table ref="adList" :data="adList" tooltip-effect="dark" style="width: 100%" v-loading="loading">
            <el-table-column type="selection" width="55"/>
            <el-table-column prop="name" label="名称" width="120"/>
            <el-table-column prop="image_url" label="广告图片" width="120">
                <template slot-scope="scope">
                    <el-popover placement="right" title="图片预览" trigger="hover">
                        <img :src="scope.row.image_url"/>
                        <img slot="reference" :src="scope.row.image_url" :alt="scope.row.image_url"
                             style="max-height: 50px;max-width: 130px"/>
                    </el-popover>
                </template>
            </el-table-column>
            <el-table-column prop="content" label="描述" min-width="1"/>
            <el-table-column prop="position_id" label="位置" width="120"/>
            <el-table-column prop="sort_order" label="排序" width="120"/>
            <el-table-column prop="state" label="状态" width="120">
                <template slot-scope="scope">
                    <span v-if="scope.row.state === 0">已禁用</span>
                    <span v-else>已启用</span>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="300">
                <template slot-scope="scope">
                    <router-link :to="{path: '/ad-edit', query: {type: 'modify', adId: scope.row.id}}">
                        <el-button size="mini" type="info">修改</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state" size="mini" type="warning"
                               @click="modifyState('disable', scope.$index, scope.row.id)">禁用
                    </el-button>
                    <el-button v-else size="mini" type="success"
                               @click="modifyState('enable', scope.$index, scope.row.id)">启用
                    </el-button>
                    <el-button size="mini" type="danger"
                               @click="deleteAd(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination background layout="prev, pager, next, jumper"
                       :total="totalAd"
                       :page-sizes="[20, 50, 100]"
                       :page-size="20"
                       @current-change="onPageNoChanged"
                       :current-page.sync="pageNo"
                       style="margin-top: 20px; margin-bottom: 20px; float: right;"/>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdList",
        data() {
            return {
                adList: [],
                pageNo: 1,
                loading: true,
                token: "",
                adminId: "",
                totalAd: 0,
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.getAdList();
        },
        methods: {
            getAdList: function () {
                let that = this;
                that.loading = true;
                axios.get('ad/list' + "?adminId=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        that.loading = false;
                        if (res.data.code === 2000) {
                            that.adList = res.data.data.adList;
                            that.totalAd = res.data.data.total
                        }
                    });
            },
            modifyState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 0;
                let message = state ? "启用" : "禁用";
                that.$confirm("确认" + message + "广告?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let data = {
                        state: state,
                        id: id,
                        token: that.token,
                        adminId: that.adminId
                    };
                    axios.post("ad/modState", data)
                        .then(res => {
                            if (res.data.code === 2000) that.adList[index].state = state;
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消' + message
                    });
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
                    let data = {
                        state: state,
                        id: id,
                        token: that.token,
                        adminId: that.adminId
                    };
                    axios.post("ad/delete", data)
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
                        let data = {
                            state: state,
                            id: id,
                            token: that.token,
                            adminId: that.adminId
                        };
                        axios.post("ad/delete", data)
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
            },
            onPageNoChanged: function (e) {
                let that = this;
                that.pageNo = e;
                that.getAdList();
            }
        }
    }

</script>

<style scoped>

</style>