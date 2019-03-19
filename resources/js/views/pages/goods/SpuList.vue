<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <router-link :to="{path: '/spu-edit', query: {type: 'create'}}">
                <el-button type="primary" size="medium">添加商品</el-button>
            </router-link>
        </div>
        <el-table ref="spuList" :data="spuList" tooltip-effect="dark" width="100%" v-loading="loading">
            <el-table-column type="selection" width="55"/>
            <el-table-column prop="name" label="名称" width="150"/>
            <el-table-column prop="category_name" label="分类" width="150"/>
            <el-table-column prop="brand_name" label="品牌" width="150"/>
            <el-table-column prop="created_at" label="创建日期" width="200"/>
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
        name: "SpuList",
        data: function () {
            return {
                spuList: [],
                pageNo: 1,
            }
        },
        mounted: function () {
            let that = this;
            axios.get("spu/page-list?pageNo=1")
                .then(res => {
                    that.loading = false;
                    if (res.data.code && res.data.data) {
                        that.spuList = that.spuList.concat(res.data.data);
                        that.pageNo++;
                    }
                }).catch(err => {
            });
        }
    }
</script>

<style scoped>

</style>