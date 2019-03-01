<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>管理员列表</span>
        </div>
        <el-table ref="adminList" :data="adminList" tooltip-effect="dark" width="100%">
            <el-table-column label="编号" prop="id"/>
            <el-table-column label="名称" prop="name"/>
            <el-table-column label="电话" prop="phone"/>
            <el-table-column label="邮箱" prop="email"/>
            <el-table-column label="注册时间" prop="created_at"/>
            <el-table-column label="操作">

            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdminList",
        data: function () {
            return {
                adminList: []
            }
        },
        mounted: {},
        methods: {}
    }
</script>

<style scoped>

</style>