<template>
    <el-form :model="loginForm" :rules="rules2" ref="loginForm" label-position="left" label-width="0px"
             class="demo-ruleForm login-container">
        <h3 class="title">系统登录</h3>
        <el-form-item prop="name">
            <el-input type="text" v-model="loginForm.name" auto-complete="off" placeholder="账号"></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input type="password" v-model="loginForm.password" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;" @click.native.prevent="onLogin" :loading="logining">登录
            </el-button>
        </el-form-item>
    </el-form>
</template>

<script>

    const bcrypt = require('bcryptjs');

    export default {
        name: "Login",
        data() {
            return {
                logining: false,
                loginForm: {
                    name: 'admin',
                    password: '123456'
                },
                rules2: {
                    name: [
                        {required: true, message: '请输入账号', trigger: 'blur'},
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                    ]
                },
                checked: true
            };
        },
        methods: {
            onLogin(ev) {
                let that = this;
                that.$refs.loginForm.validate((valid) => {
                    if (valid) {
                        that.logining = true;
                        //生成salt的迭代次数
                        const saltRounds = 10;
                        //随机生成salt
                        const salt = bcrypt.genSaltSync(saltRounds);
                        //获取hash值
                        let hash = bcrypt.hashSync(this.loginForm.password, salt);
                        //把hash值赋值给password变量
                        let loginParams = {name: this.loginForm.name, password: hash};
                        this.requestLogin(loginParams).then(res => {
                            this.logining = false;
                            console.info(res);
                            if (res.code !== 2000) {
                                that.$message({
                                    message: res.message,
                                    type: 'error'
                                });
                            } else {
                                const pwdMatchFlag = bcrypt.compareSync(that.loginForm.password, res.data.hash);
                                if (pwdMatchFlag) {
                                    that.$message({
                                        message: "登录成功",
                                        type: 'success'
                                    });
                                    // sessionStorage.setItem('user', JSON.stringify(user));
                                    that.$router.push({path: '/index'});
                                } else {
                                    that.$message({
                                        message: "账号或密码错误",
                                        type: 'error'
                                    });
                                }
                            }
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            requestLogin: function (params) {
                return axios.post('/admin/login', params).then(res => res.data);
            }
        }
    }
</script>

<style lang="scss" scoped>

    .login-container {
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        background-clip: padding-box;
        margin: 180px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;
        .title {
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
        }
        .remember {
            margin: 0px 0px 35px 0px;
        }
    }
</style>