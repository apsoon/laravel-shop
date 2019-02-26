<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>订单列表</span>
        </div>
        <el-table ref="couponList" tooltip-effect="dark" width="100%" :data="orderList">
            <el-table-column label="订单号" prop="sn" width="250"/>
            <el-table-column label="下单时间" prop="create_time" width="250"/>
            <el-table-column label="订单总额" prop="price" width="150"/>
            <el-table-column label="收货人" prop="consignee" width="150"/>
            <el-table-column label="订单状态" prop="state" width="150"/>
            <el-table-column label="操作" min-width="1">
                <template slot-scope="scope">
                    <router-link :to="{path: '', query: { sn: scope.row.sn}}">
                        <el-button size="mini" type="warning">发货</el-button>
                    </router-link>
                    <el-button v-if="scope.row.state === 0"
                               size="mini"
                               type="warning"
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