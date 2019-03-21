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
        <el-pagination background layout=" prev, pager, next, jumper"
                       :total="totalSpu"
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
                loading: true,
                token: "",
                adminId: "",
                totalSpu: 0
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.getSpuList();

        },
        methods: {
            getSpuList: function () {
                let that = this;
                that.loading = true;
                axios.get("spu/page-list?pageNo=" + that.pageNo + "&admin_id=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        that.loading = false;
                        if (res.data.code === 2000) {
                            that.spuList = res.data.data.spuList;
                            that.totalSpu = res.data.data.total;
                        }
                    }).catch(err => {
                });
            },
            onPageNoChanged: function (e) {
                let that = this;
                that.pageNo = e;
                that.getSpuList();
            }
        }
    }
</script>

<style scoped>

</style>