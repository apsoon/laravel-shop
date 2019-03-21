<template>
    <el-card shadow="never">
        <div slot="header">
            <span>订单详情</span>
        </div>
        <span>订单信息</span>
        <span>{{order.sn}}</span>
        <br/>
        <span>地址信息</span>
        <br/>
        <template v-model="order">
            <span>收件人：{{order.consignee}}</span>
            <br/>
            <span>电话：{{order.phone}}</span>
            <br/>
        </template>
        <br/>
        <span>产品信息</span>
        <el-table ref="skuList" :data="skuList" tooltip-effect="dark" style="width: 100%" stripe show-summary>
            <el-table-column label="产品名称" prop="name"/>
            <el-table-column label="价格" prop="price"/>
            <el-table-column label="数量" prop="number"/>
            <el-table-column label="总计" prop="total"/>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "OrderDetail",
        data: function () {
            return {
                sn: "",
                order: {},
                skuList: [],
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                orderSn = that.$route.query.sn,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.sn = orderSn;
            axios.get("/order/detail?orderSn=" + orderSn + "&admin_id=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        let orderDetail = res.data.data;
                        that.skuList = orderDetail.skuList;
                        delete orderDetail.skuList;
                        that.order = orderDetail;
                        console.info(that.order);
                    }
                })
                .catch(res => {

                });
        },
        methods: {}
    }
</script>

<style scoped>

</style>