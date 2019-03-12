<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>售后订单</span>
        </div>
        <el-tabs v-model="active" @tab-click="changeActive">
            <el-tab-pane label="全部" name="all"/>
            <el-tab-pane label="待确认" name="accept"/>
            <el-tab-pane label="处理中" name="ing"/>
            <el-tab-pane label="已完成" name="complete"/>
            <el-tab-pane label="已取消" name="cancel"/>
        </el-tabs>
        <el-table ref="afSaleList" tooltip-effect="dark" width="100%" :data="afSaleList" stripe>
            <el-table-column type="selection" width="55"/>
            <el-table-column label="订单号" prop="order_sn" width="250"/>
            <el-table-column label="用户" prop="user_id" width="150"/>
            <el-table-column label="商品" prop="sku_id" width="100"/>
            <el-table-column label="售后原因" prop="reason" width="150"/>
            <el-table-column label="描述" prop="describe" min-width="1"/>
            <el-table-column label="售后状态" prop="state" width="100">
                <template slot-scope="scope">
                    <span v-if="scope.row.state === 0">待确定</span>
                    <span v-else-if="scope.row.state === 4">已完成</span>
                    <span v-else-if="scope.row.state === 7">已取消</span>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="150">
                <template slot-scope="scope">
                    <el-button v-if="scope.row.state === 0"
                               size="mini"
                               type="primary"
                               @click="modifyState('disable', scope.$index, scope.row.id)">确认
                    </el-button>
                    <el-button v-if="scope.row.state === 1"
                               size="mini"
                               type="primary"
                               @click="modifyState('disable', scope.$index, scope.row.id)">完成
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AfterSaleList",
        data: function () {
            return {
                afSaleList: [],
                active: "all",
                pageNo: 1,
            }
        },
        mounted: function () {
            let that = this;
            that.getAfterSaleList();
        },
        methods: {
            changeActive: function (tab, event) {
                let that = this;
                that.getAfterSaleList(tab.name);
            },
            getAfterSaleList: function (type = 'all', pageNo = 1) {
                let that = this;
                axios.get("/after/list?type=" + type + "&pageNo=" + pageNo)
                    .then(res => {
                        if (res.data.code === 2000) {
                            that.afSaleList = res.data.data;
                        }
                    }).catch(err => {
                });
            }
        }
    }
</script>

<style scoped>

</style>