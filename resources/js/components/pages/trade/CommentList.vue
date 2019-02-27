<template>
    <el-card>
        <div slot="header" class="clearfix">

        </div>
        <el-table ref="commentList" :data="commentList" tooltip-effect="dart" width="100%">
            <el-table-column label="商品" prop="sku_id" width="150"/>
            <el-table-column label="订单编号" prop="order_sn" width="150"/>
            <el-table-column label="用户" prop="user_id" width="150"/>
            <el-table-column label="内容" prop="content" min-width="1"/>
            <el-table-column label="评论时间" prop="create_at" width="150"/>
            <el-table-column label="排序" prop="sort_order" width="100"/>
            <el-table-column label="状态" prop="state" width="100">
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
                    if (res.code === 2000) {
                        that.commentList = res.data.data;
                    }
                })
                .catch(err => {

                });
        },
        methods: {}

    }
</script>

<style scoped>

</style>