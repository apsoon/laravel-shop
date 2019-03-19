<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>订单列表</span>
        </div>
        <el-tabs v-model="active" @tab-click="changeActive">
            <el-tab-pane label="全部" name="all"/>
            <el-tab-pane label="待支付" name="pay"/>
            <el-tab-pane label="待发货" name="send"/>
            <el-tab-pane label="待收货" name="receive"/>
            <el-tab-pane label="待评论" name="comment"/>
            <el-tab-pane label="已完成" name="complete"/>
            <el-tab-pane label="已取消" name="cancel"/>
        </el-tabs>
        <el-table ref="orderList" tooltip-effect="dark" width="100%" :data="orderList" stripe v-loading="loading">
            <el-table-column type="selection" width="55"/>
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
        <el-pagination background layout="total, sizes, prev, pager, next, jumper"
                       :total="1000"
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
        name: "OrderList",
        data: function () {
            return {
                active: "all",
                pageNo: 1,
                orderList: [],
                loading: true
            }
        },
        mounted: function () {
            let that = this;
            that.getOrderList();
        },
        methods: {
            changeActive: function (tab, event) {
                let that = this;
                that.getOrderList(tab.name);
            },
            getOrderList: function (type = 'all', pageNo = 1) {
                let that = this;
                that.loading = true;
                axios.get("/order/list?type=" + type + "&pageNo=" + pageNo)
                    .then(res => {
                        that.loading = false;
                        if (res.data.code === 2000) {
                            that.orderList = res.data.data;
                        }
                    }).catch(err => {
                });
            },
            onPageNoChanged: function (pageNo) {
                let that = this;
                that.pageNo = pageNo;
                that.getOrderList(that.active, pageNo);
            }
        }
    }
</script>

<style scoped>

</style>