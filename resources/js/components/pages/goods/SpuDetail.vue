<template>
    <div>
        <el-tabs v-model="activeName" type="border-card">
            <el-tab-pane label="商品信息" name="info">商品信息</el-tab-pane>
            <el-tab-pane label="商品属性" name="attr">商品属性</el-tab-pane>
            <el-tab-pane label="商品规格" name="spec">
                <router-link :to="{path: '/spu-spec-add', query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">添加规格选项</el-button>
                </router-link>
                <el-table width="100%">
                    <el-table-column prop="name"
                                     label="名称"
                                     width="150px">
                    </el-table-column>
                    <el-table-column prop="options"
                                     label="选项"
                                     min-width="1">
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="产品列表" name="sku">
                <router-link :to="{path: '/sku-add',query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">添加产品</el-button>
                </router-link>
                <el-table ref="skuList"
                          :data="skuList"
                          tooltip-effect="dark"
                          width="100%">
                    <el-table-column
                            prop="name"
                            label="名称"
                            width="150px">
                    </el-table-column>
                    <el-table-column
                            prop="origin_price"
                            label="原价"
                            width="150px">
                    </el-table-column>
                    <el-table-column
                            prop="price"
                            label="价格"
                            width="150px">
                    </el-table-column>
                    <el-table-column
                            prop="number"
                            label="数量"
                            width="150px">
                    </el-table-column>
                    <el-table-column
                            prop="value"
                            label="规格"
                            min-width="1">
                    </el-table-column>
                    <el-table-column
                            prop="state"
                            label="状态"
                            width="150px">
                    </el-table-column>
                    <el-table-column
                            prop=""
                            label="操作"
                            width="200px">
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
                                    @click="deleteAd(scope.$index, scope.row.id)">删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuDetail",
        data: function () {
            return {
                spuId: 0,
                activeName: "info",
                skuList: []
            }
        },
        beforeCreate: function () {
        },
        mounted: function () {
            let that = this;
            that.spuId = that.$route.query.spuId;
            axios.get("spu/detail?spuId=" + that.spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        console.info(res);
                    }
                }).catch(err => {
            });
        }
    }
</script>

<style scoped>
    /*.el-tabs {*/
    /*background-color: white;*/
    /*}*/
</style>