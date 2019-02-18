<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link to="/coupon-add">
                <el-button type="primary">添加优惠券</el-button>
            </router-link>
        </div>
        <el-table ref="couponList" tooltip-effect="dark" width="100%" :data="couponList">
            <el-table-column type="expand">
                <template slot-scope="props">
                    <el-form label-position="left" inline class="demo-table-expand">
                        <el-form-item label="发放类型">
                            <span>{{ props.row.send_type}}</span>
                        </el-form-item>
                    </el-form>
                </template>
            </el-table-column>
            <el-table-column label="优惠券名称" prop="name" width="150">
            </el-table-column>
            <el-table-column label="优惠券编号" prop="sn" width="150">
            </el-table-column>
            <el-table-column label="数量" prop="number" width="150">
            </el-table-column>
            <el-table-column label="状态" prop="state" width="150">
            </el-table-column>
            <el-table-column label="操作" prop="">
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
        name: "CouponList",
        data: function () {
            return {
                pageNo: 1,
                couponList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/coupon/list?pageNo=" + that.pageNo)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.couponList = res.data.data
                    }
                    console.info(that.couponList);
                });
            console.info(that.couponList);
        }
    }
</script>

<style scoped>

</style>