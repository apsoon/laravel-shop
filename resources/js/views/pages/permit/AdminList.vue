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
                    <el-button type="primary" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">修改密码
                    </el-button>
                    <el-button type="warning" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">禁用
                    </el-button>
                    <el-button type="danger" size="medium" @click="modifyPassword(scope.$index, scope.row.id)">删除
                    </el-button>
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
            modifyPassword: function () {
                let that = this;
            },
            onPageNoChanged: function (e) {
                let that = this;
                that.pageNo = e;
            }
        }
    }
</script>

<style scoped>

</style>