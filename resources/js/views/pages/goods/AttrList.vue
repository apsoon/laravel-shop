<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link to="/attr-group-add">
                <el-button type="primary" size="medium">添加属性组</el-button>
            </router-link>
        </div>
        <el-table ref="groupList" :data="groupList" tooltip-effect="dark" width="100%">
            <el-table-column label="属性组名称" prop="name" width="150px">
            </el-table-column>
            <el-table-column label="所属分类" prop="category_id" width="150px">
            </el-table-column>
            <el-table-column label="包含属性" prop="" min-width="1">
                <template slot-scope="scope">
                    <el-tag
                            v-for="attr in scope.row.attrs"
                            :key="attr.id"
                            type="primary"
                            :disable-transitions="true">
                        {{attr.name}}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column
                    prop=""
                    width="200"
                    label="操作">
                <template slot-scope="scope">
                    <router-link :to="{path:'/attr-add', query: {attrGroupId: scope.row.id}}">
                        <el-button
                                size="mini"
                                type="primary">添加属性
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
        name: "AttrList",
        data: function () {
            return {
                groupList: [],
                pageNo: 1
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/attrGroup/list?pageNo=" + that.pageNo)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.groupList = res.data.data;
                        console.info(that.groupList);
                    }
                })
                .catch(err => {

                })
        },
        methods: {}
    }
</script>

<style scoped>
    .el-tag + .el-tag {
        margin-left: 10px;
    }
</style>