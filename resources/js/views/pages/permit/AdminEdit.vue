<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>编辑管理员</span>
        </div>
        <el-form ref="adminForm" :rules="rules" :model="adminForm" label-width="100px">
            <el-form-item prop="name" label="名称">
                <el-input v-model="adminForm.name" placeholder="请输入名称"/>
            </el-form-item>
            <el-form-item prop="email" label="邮箱">
                <el-input v-model="adminForm.email" type="email" placeholder="请输入邮箱"/>
            </el-form-item>
            <el-form-item prop="phone" label="手机">
                <el-input v-model="adminForm.phone" type="tel" placeholder="请输入员电话"/>
            </el-form-item>
            <el-form-item prop="oldPwd" label="旧密码" v-if="type ==='modify'">
                <el-input v-model="adminForm.oldPwd" type="password" placeholder="请输入原密码" show-password/>
            </el-form-item>
            <el-form-item prop="password" label="新密码">
                <el-input v-model="adminForm.password" type="password" placeholder="请输入新密码" show-password/>
            </el-form-item>
            <el-form-item prop="confirm" label="确认密码">
                <el-input v-model="adminForm.confirm" type="password" placeholder="请再次输入密码" show-password/>
            </el-form-item>
            <el-form-item prop="rootPwd" label="管理员密码" v-if="type ==='create'">
                <el-input v-model="adminForm.rootPwd" type="password" placeholder="请输入原管理员密码" show-password/>
            </el-form-item>
        </el-form>
        <el-button type="primary" @click="onSubmit" v-if="type === 'create'">立即创建</el-button>
        <el-button type="primary" @click="onSubmit" v-else>立即修改</el-button>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdminEdit",
        data: function () {
            let validatePasswordConfirm = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入管理员密码'));
                } else if (value !== this.adminForm.password) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                adminForm: {
                    name: "",
                    email: "",
                    phone: "",
                    password: "",
                    confirm: "",
                    oldPwd: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入管理员名称', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '请输入管理员邮箱', trigger: 'blur'}
                    ],
                    phone: [
                        {required: true, message: '请输入管理员电话', trigger: 'blur'}
                    ],
                    oldPwd: [
                        {required: true, message: '请输入原管理员密码', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入新管理员密码', trigger: 'blur'}
                    ],
                    confirm: [
                        {required: true, validator: validatePasswordConfirm, trigger: 'blur'}
                    ],
                },
                password: "",
                confirm: "",
                type: "create",
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                type = that.$route.query.type,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.type = type;
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.couponForm.validate((valid) => {
                    if (valid) {
                        that.adminForm.token = that.token;
                        that.adminForm.adminId = that.adminId;
                        if (that.type === 'create') {
                            axios.post("admin/create", that.adminForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        that.$router.push("/admin-list");
                                    }
                                }).catch(err => {
                            });
                        } else if (that.type === 'modify') {
                        }
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>