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
            <el-form-item prop="password" label="新密码">
                <el-input v-model="adminForm.password" type="password" placeholder="请输入新密码" show-password/>
            </el-form-item>
            <el-form-item prop="confirm" label="确认密码">
                <el-input v-model="adminForm.confirm" type="password" placeholder="请再次输入密码" show-password/>
            </el-form-item>
            <el-form-item prop="originPwd" label="登录密码">
                <el-input v-model="adminForm.originPwd" type="password" placeholder="请输入登录密码" show-password/>
            </el-form-item>
        </el-form>
        <el-button type="primary" @click="onSubmit" v-if="type === 'create'">立即创建</el-button>
        <el-button type="primary" @click="onSubmit" v-else>立即修改</el-button>
    </el-card>
</template>

<script>
    import axios from "axios";
    import md5 from "md5";

    export default {
        name: "AdminEdit",
        data: function () {
            let validatePassword = (rule, value, callback) => {
                if (this.type === 'create' && value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    callback();
                }
            };
            let validatePasswordConfirm = (rule, value, callback) => {
                if (this.type === 'create' && value === '') {
                    callback(new Error('请再次输入密码'));
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
                    originPwd: "",
                },
                rules: {
                    name: [
                        {required: true, message: '请输入名称', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '请输入邮箱', trigger: 'blur'}
                    ],
                    phone: [
                        {required: true, message: '请输入电话', trigger: 'blur'}
                    ],
                    originPwd: [
                        {required: true, message: '请输入登录密码', trigger: 'blur'}
                    ],
                    password: [
                        {validator: validatePassword, trigger: 'blur'},
                    ],
                    confirm: [
                        {validator: validatePasswordConfirm, trigger: 'blur'}
                    ],
                },
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
            if (type === "modify") {
                axios.get("admin/detail?adminId=" + that.adminId + "&adminId=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.adminForm = {
                                name: data.name,
                                email: data.email,
                                phone: data.phone,
                                confirm: "",
                                originPwd: "",
                            }
                        }
                    }).catch(err => {
                });
            }
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.adminForm.validate((valid) => {
                    if (valid) {
                        that.adminForm.token = that.token;
                        that.adminForm.adminId = that.adminId;
                        that.adminForm.originPwd = md5(that.adminForm.originPwd);
                        that.adminForm.password = md5(that.adminForm.password);
                        that.adminForm.confirm = md5(that.adminForm.confirm);
                        if (that.type === 'create') {
                            axios.post("admin/create", that.adminForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        that.$router.push("/admin-list");
                                    } else {
                                        this.$message({
                                            type: 'error',
                                            message: '参数错误或无相映权限'
                                        });
                                    }
                                }).catch(err => {
                            });
                        } else if (that.type === 'modify') {
                            axios.post("admin/update", that.adminForm)
                                .then(res => {
                                    if (res.data.code === 2000) {
                                        that.$router.push("/");
                                    } else {
                                        this.$message({
                                            type: 'error',
                                            message: '参数错误或无相映权限'
                                        });
                                    }
                                }).catch(err => {
                            });
                        }
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>