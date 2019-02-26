<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>订单列表</span>
        </div>
        <el-table ref="couponList" tooltip-effect="dark" width="100%" :data="orderList" stripe>
            <el-table-column label="订单号" prop="sn" width="250"/>
            <el-table-column label="下单时间" prop="create_time" width="250"/>
            <el-table-column label="订单总额" prop="price" width="100"/>
            <el-table-column label="产品数量" prop="number" width="100"/>
            <el-table-column label="收货人" prop="consignee" width="100"/>
            <el-table-column label="联系电话" prop="phone" width="150"/>
            <el-table-column label="订单状态" prop="state" width="150">
                <template slot-scope="scope">
                    <span v-if="scope.row.state === 0">待付款</span>
                    <span v-else-if="scope.row.state === 1">待发货</span>
                    <span v-else-if="scope.row.state === 2">待收货</span>
                    <span v-else-if="scope.row.state === 3">待评论</span>
                    <span v-else-if="scope.row.state === 4">已完成</span>
                    <span v-else-if="scope.row.state === 7">已取消</span>
                </template>
            </el-table-column>
            <el-table-column label="操作" min-width="1">
                <template slot-scope="scope">
                    <router-link :to="{path: '/order-detail', query: { sn: scope.row.sn}}">
                        <el-button size="mini" type="info">详情</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state === 1"
                               size="mini"
                               type="primary"
                               @click="modifyState('disable', scope.$index, scope.row.id)">发货
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "OrderList",
        data: function () {
            return {
                pageNo: 1,
                orderList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/order/list?pageNo=" + that.pageNo)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.orderList = res.data.data;
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