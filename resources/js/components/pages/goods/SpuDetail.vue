<template>
    <div>
        <el-tabs v-model="activeName" type="border-card">
            <el-tab-pane label="商品信息" name="info">
                <el-row>
                    商品名称: {{spu.name}}
                </el-row>
                <el-row>
                    品牌: {{spu.brand_id}}
                </el-row>
                <el-row>
                    分类: {{spu.category_id}}
                </el-row>
                <el-row>
                    状态: {{spu.state}}
                </el-row>
            </el-tab-pane>
            <el-tab-pane label="商品属性" name="attr">
                <router-link :to="{path: '/spu-attr-add', query:{spuId:spuId,categoryId:spu.category_id}}">
                    <el-button type="primary" size="medium">
                        添加属性
                    </el-button>
                </router-link>
                <el-table ref="attrList" :data="attrList" tooltip-effect="dark" width="100%">
                    <el-table-column label="属性名称">
                    </el-table-column>
                    <el-table-column label="值">
                    </el-table-column>
                    <el-table-column label="操作">
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="商品规格" name="spec">
                <router-link :to="{path: '/spu-spec-add', query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">添加规格</el-button>
                </router-link>
                <el-table width="100%"
                          ref="specList"
                          tooltip-effect="dark"
                          :data="specList">
                    <el-table-column prop="name"
                                     label="名称"
                                     width="150px">
                    </el-table-column>
                    <el-table-column
                            label="选项"
                            min-width="1">
                        <template slot-scope="scope">
                            <el-tag
                                    v-for="option in scope.row.options"
                                    :key="option.id"
                                    type="primary"
                                    :disable-transitions="true">
                                {{option.name}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column
                            prop=""
                            label="操作"
                            width="200px">
                        <template slot-scope="scope">
                            <router-link
                                    :to="{path: '/spu-spec-option', query: {spuId: spuId, specId: scope.row.id}}">
                                <el-button
                                        size="mini"
                                        type="info"
                                        @click="">修改选项
                                </el-button>
                            </router-link>
                            <el-button
                                    size="mini"
                                    type="danger"
                                    @click="deleteSpec(scope.$index, scope.row.id)">删除
                            </el-button>
                        </template>
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
                            width="300px">
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
                spu: {},
                skuList: [],
                specList: [],
                attrList: []
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
            that.spuId = spuId;
            axios.get("spu/detail?spuId=" + spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.spu = res.data.data.spu;
                    }
                })
                .catch(err => {
                });
            axios.get("spu/specOptionList?spuId=" + spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data;
                    }
                });
            axios.get("sku/listBySpu?spuId=" + that.spuId)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.skuList = res.data.data;
                    }
                })
                .catch(err => {

                });
            axios.get("/attr/list-spu?spuId=" + that.spuId + "&categoryId=" + that.spu.category_id)
                .then(res => {
                    if (res.data.code === 2000) {
                        console.info(res.data.data);
                        that.attrList = res.data.data;
                    }
                });
        }
    }
</script>

<style scoped>
    .el-tag + .el-tag {
        margin-left: 10px;
    }
</style>