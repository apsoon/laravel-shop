<template>
    <el-card>
        <div slot="header" class="clearfix">

        </div>
        <el-table ref="commentList" :data="commentList" tooltip-effect="dart" width="100%">
            <el-table-column type="selection" width="55"/>
            <el-table-column label="商品" prop="sku_name" width="150" align="center"/>
            <el-table-column label="订单编号" prop="order_sn" width="220" align="center"/>
            <el-table-column label="用户" prop="nickname" width="150" align="center"/>
            <el-table-column label="内容" prop="content" min-width="1"/>
            <el-table-column label="评论时间" prop="created_at" width="200" align="center"/>
            <el-table-column label="排序" prop="sort_order" width="50" align="center"/>
            <el-table-column label="状态" prop="state" width="100" align="center">
                <template slot-scope="scope">
                    <span v-if="scope.row.state === 0">待审核</span>
                    <span v-else-if="scope.row.state === 1">前台显示</span>
                    <span v-else>前台不显示</span>
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
                       :current-page.sync="currentPage3"
                       @size-change="handleSizeChange"
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
                pageNo: 1
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/comment/list?pageNo=" + that.pageNo)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.commentList = res.data.data;
                    }
                })
                .catch(err => {

                });
        },
        methods: {
            modifyState: function (type, index, id) {
                let that = this,
                    state = 1;
                if (type === "disable") state = 2;
                let message = state ? "展示" : "不展示";
                that.$confirm("确认前台" + message + "该评论?", '提示', {
                    confirmButtonText: "确认",
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post("comment/modify-state", {
                        state: state,
                        id: id
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
        }
    }
</script>

<style scoped>

</style>