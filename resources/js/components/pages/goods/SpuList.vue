<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link to="/spu-add">
                <el-button type="primary" size="medium">添加商品</el-button>
            </router-link>
        </div>
        <el-table ref="spuList" :data="spuList" tooltip-effect="dark" width="100%">
            <el-table-column type="selection" width="55"/>
            <el-table-column prop="name" label="名称" width="150"/>
            <el-table-column prop="category_id" label="分类" width="150"/>
            <el-table-column prop="brand_id" label="排序" width="150"/>
            <el-table-column prop="state" label="状态" width="150"/>
            <el-table-column min-width="1" label="操作">
                <template slot-scope="scope">
                    <router-link :to="{path:'/spu-detail', query: {spuId: scope.row.id}}">
                        <el-button
                                size="mini"
                                type="info">详情
                        </el-button>
                    </router-link>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuList",
        data: function () {
            return {
                spuList: [],
                pageNo: 1,
            }
        },
        mounted: function () {
            let that = this;
            axios.get("spu/pagedList?pageNo=1")
                .then(res => {
                    if (res.data.code && res.data.data) {
                        that.spuList = that.spuList.concat(res.data.data);
                        that.pageNo++;
                        console.info(" ------------------- ", that.spuList);
                    }
                }).catch(err => {
            });
        }
    }
</script>

<style scoped>

</style>