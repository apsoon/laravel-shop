<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>评论列表</span>
        </div>
        <el-tabs v-model="active" @tab-click="changeActive">
            <el-tab-pane label="全部" name="all"/>
            <el-tab-pane label="待审核" name="audit"/>
            <el-tab-pane label="审核通过" name="valid"/>
            <el-tab-pane label="审核不通过" name="invalid"/>
        </el-tabs>
        <el-table ref="commentList" :data="commentList" tooltip-effect="dart" width="100%" v-loading="loading">
            <el-table-column type="selection" width="55"/>
            <el-table-column label="商品" prop="sku_name" width="150" align="center"/>
            <el-table-column label="订单编号" prop="order_sn" width="220" align="center"/>
            <el-table-column label="用户" prop="nickname" width="150" align="center"/>
            <el-table-column label="评分" prop="rating" width="150" align="center">
                <template slot-scope="scope">
                    <el-rate v-model="scope.row.rating" disabled>
                    </el-rate>
                </template>
            </el-table-column>
            <el-table-column label="内容" prop="content" min-width="1"/>
            <el-table-column label="评论时间" prop="created_at" width="200" align="center"/>
            <el-table-column label="排序" prop="sort_order" width="50" align="center"/>
            <el-table-column label="状态" prop="state" width="100" align="center">
                <template slot-scope="scope">
                    <span v-if="scope.row.state === 0">待审核</span>
                    <span v-else-if="scope.row.state === 1">审核通过</span>
                    <span v-else>审核不通过</span>
                </template>
            </el-table-column>
            <el-table-column width="300" label="操作">
                <template slot-scope="scope">
                    <router-link :to="{path: '/brand-add',query :{type: 'modify', brandId:scope.row.id}}">
                        <el-button size="mini" type="info">修改</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state === 1"
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
                            @click="deleteComment(scope.$index, scope.row.id)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination background layout="total, sizes, prev, pager, next, jumper"
                       :total="1000"
                       :page-sizes="[20, 50, 100]"
                       :page-size="20"
                       @current-change="onPageNoChanged"
                       :current-page.sync="pageNo"
                       @size-change="onPageSizeChanged"
                       style="margin-top: 20px; margin-bottom: 20px; float: right;"/>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "CommentList",
        data: function () {
            return {
                commentList: [],
                pageNo: 1,
                active: "all",
                loading: true,
                token: "",
                adminId: "",
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.getCommentList();
        },
        methods: {
            modifyState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 4;
                let message = state ? "展示" : "不展示";
                that.$confirm("确认前台" + message + "该评论?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post("comment/modify-state", {
                        state: state,
                        id: id,
                        token: that.token,
                        adminId: that.adminId
                    }).then(res => {
                        if (res.data.code === 2000) that.commentList[index].state = state;
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消' + message
                    });
                });
            },
            getCommentList: function (type = 'all', pageNo = 1) {
                let that = this;
                that.loading = true;
                axios.get("/comment/list?type=" + type + "&pageNo=" + pageNo + "&admin_id=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        that.loading = false;
                        if (res.data.code === 2000) {
                            that.commentList = res.data.data;
                        }
                    }).catch(err => {
                });
            },
            changeActive: function (tab, event) {
                let that = this;
                that.getCommentList(tab.name);
            },
            onPageNoChanged: function () {

            },
            onPageSizeChanged: function () {

            }
        }
    }
</script>

<style scoped>

</style>