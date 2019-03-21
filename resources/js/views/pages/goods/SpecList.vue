<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>规格列表</span>
        </div>
        <div v-loading="loading">
            <el-tag
                    v-for="spec in specList"
                    :key="spec.name"
                    type="primary"
                    :disable-transitions="true">
                {{spec.name}}
            </el-tag>
            <el-input
                    class="input-new-tag"
                    v-if="inputVisible"
                    v-model="inputValue"
                    ref="specInput"
                    size="small"
                    @keyup.enter.native="addSpec"
                    @blur="addSpec">
            </el-input>
            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加规格</el-button>
        </div>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpecList",
        data: function () {
            return {
                specList: [],
                inputVisible: false,
                inputValue: '',
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
            axios.get("/spec/list" + "?adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    that.loading = false;
                    if (res.data.code === 2000) {
                        that.specList = res.data.data;
                    }
                }).catch(err => {
            })
        },
        methods: {
            showInput: function () {
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.specInput.$refs.input.focus();
                });
            },
            addSpec: function () {
                let that = this,
                    inputValue = that.inputValue;
                if (inputValue) {
                    let data = {
                        name: inputValue,
                        token: that.token,
                        adminId: that.adminId
                    };
                    axios.post("/spec/create", data)
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.specList.push({name: inputValue});
                            } else {
                                that.$message({
                                    type: 'error',
                                    message: '添加失败!'
                                });
                            }
                        }).catch(err => {
                    });
                }
                this.inputVisible = false;
                this.inputValue = '';
            }
        }
    }
</script>

<style scoped>
    .el-tag {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .button-new-tag {
        height: 32px;
        line-height: 30px;
        padding-top: 0;
        padding-bottom: 0;
    }

    .input-new-tag {
        margin-bottom: 10px;
        width: 90px;
        vertical-align: bottom;
    }
</style>