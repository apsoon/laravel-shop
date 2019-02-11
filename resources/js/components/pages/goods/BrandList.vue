<template>
    <div>
        <router-link to="/brand-add">
            <el-button type="primary">添加品牌</el-button>
        </router-link>
        <el-button type="danger" @click="deleteAds">批量删除</el-button>
        <el-table
                ref="multipleTable"
                :data="brandList"
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    type="selection"
                    width="55">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="region"
                    label="地区"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="describe"
                    label="描述"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop=""
                    label="操作">
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
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BrandList",
        data: function () {
            return {
                brandList: [],
                pageNo: 1
            }
        },
        mounted: function () {
            let that = this;
            console.info("---------");
            axios.get('brand/list')
                .then(res => {
                    if (res.data.code === 2000) {
                        // if (res.data.data) {
                        // that.pageNo++;
                        that.brandList = res.data.data;
                        console.info(res.data.data);
                        // }
                    }
                });
        }
    }
</script>

<style scoped>

</style>