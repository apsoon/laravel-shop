<template>
    <div>
        <el-tabs v-model="activeName" type="border-card" @tab-click="handleClick">
            <el-tab-pane label="商品信息" name="info">商品信息</el-tab-pane>
            <el-tab-pane label="商品属性" name="attr">商品属性</el-tab-pane>
            <el-tab-pane label="产品列表" name="sku">
                <router-link :to="{path:'/spec-option-add', query: {spuId: spuId}}">
                    <el-button type="primary" size="medium">添加规格选项</el-button>
                </router-link>
                <router-link to="/sku-add">
                    <el-button type="primary" size="medium">添加产品</el-button>
                </router-link>
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
                activeName: "info"
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