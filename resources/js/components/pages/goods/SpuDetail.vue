<template>
    <div>
        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="商品信息" name="first">商品信息</el-tab-pane>
            <el-tab-pane label="商品属性" name="second">商品属性</el-tab-pane>
            <el-tab-pane label="产品列表" name="third">
                <router-link to="/sku-add">
                    <el-button type="primary">添加产品</el-button>
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
            }
        },
        mounted: function () {
            let that = this;
            console.info(that.$route.query);
            that.spuid = that.$route.query.spuId;
            axios.get("spu/detail?spuId=" + that.spuid)
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

</style>