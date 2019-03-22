<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <router-link :to="{path: '/admin-edit', query: {type: 'create'}}">
                <el-button type="primary" size="medium">添加管理员</el-button>
            </router-link>
        </div>
        <el-table ref="adminList" :data="adminList" tooltip-effect="dark" width="100%" v-loading="loading">
            <el-table-column label="编号" prop="id" width="150"/>
            <el-table-column label="名称" prop="name" width="150"/>
            <el-table-column label="电话" prop="phone" width="150"/>
            <el-table-column label="邮箱" prop="email" width="200"/>
            <el-table-column label="注册时间" prop="created_at" width="200"/>
            <el-table-column label="操作" min-width="1">
                <template slot-scope="scope">
                    <router-link :to="{path: '/admin-edit', query: {type: 'modify', adminId:scope.row.id}}">
                        <el-button type="warning" size="medium">修改资料</el-button>
                    </router-link>
                </template>
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
                adminList: [],
                loading: true,
                token: "",
                adminId: "",
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            axios.get("/admin/list" + "?adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    that.loading = false;
                    if (res.data.code === 2000) {
                        that.adminList = res.data.data;
                    }
                }).catch(err => {
            });
        },
        methods: {
            onPageNoChanged: function (e) {
                let that = this;
                that.pageNo = e;
            }
        }
    }
</script>

<style scoped>

</style>