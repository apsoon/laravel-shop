<template>
    <el-form :model="ruleForm2" :rules="rules2" ref="ruleForm2" label-position="left" label-width="0px"
             class="demo-ruleForm login-container">
        <h3 class="title">系统登录</h3>
        <el-form-item prop="account">
            <el-input type="text" v-model="ruleForm2.account" auto-complete="off" placeholder="账号"></el-input>
        </el-form-item>
        <el-form-item prop="checkPass">
            <el-input type="password" v-model="ruleForm2.checkPass" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item style="width:100%;">
            <el-button type="primary" style="width:100%;" @click.native.prevent="handleSubmit2" :loading="logining">登录
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
                ruleForm2: {
                    account: 'admin',
                    checkPass: '123456'
                },
                rules2: {
                    account: [
                        {required: true, message: '请输入账号', trigger: 'blur'},
                        //{ validator: validaePass }
                    ],
                    checkPass: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                        //{ validator: validaePass2 }
                    ]
                },
                checked: true
            };
        },
        methods: {
            handleReset2() {
                this.$refs.ruleForm2.resetFields();
            },
            handleSubmit2(ev) {
                var _this = this;
                this.$refs.ruleForm2.validate((valid) => {
                    if (valid) {
                        //_this.$router.replace('/table');
                        this.logining = true;
                        //NProgress.start();
                        //生成salt的迭代次数
                        const saltRounds = 10;
                        //随机生成salt
                        const salt = bcrypt.genSaltSync(saltRounds);
                        //获取hash值
                        var hash = bcrypt.hashSync(this.ruleForm2.checkPass, salt);
                        //把hash值赋值给password变量
                        var loginParams = {name: this.ruleForm2.account, password: hash};
                        this.requestLogin(loginParams).then(res => {
                            this.logining = false;
                            console.info(res);
                            // let {message, code, data} = data;
                            if (res.code !== 2000) {
                                this.$message({
                                    message: res.message,
                                    type: 'error'
                                });
                            } else {
                                const pwdMatchFlag = bcrypt.compareSync(this.ruleForm2.checkPass, res.data.hash);
                                if (pwdMatchFlag) {
                                    this.$message({
                                        message: "登录成功",
                                        type: 'success'
                                    });
                                    // sessionStorage.setItem('user', JSON.stringify(user));
                                    this.$router.push({path: '/index'});
                                } else {
                                    this.$message({
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