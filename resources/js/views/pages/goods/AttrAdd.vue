<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>添加属性</span>
        </div>
        <div>
            <el-tag
                    v-for="attr in attrList"
                    :key="attr.name"
                    type="primary"
                    :disable-transitions="true">
                {{attr.name}}
            </el-tag>
            <el-input
                    class="input-new-tag"
                    v-if="inputVisible"
                    v-model="inputValue"
                    ref="attrInput"
                    size="small"
                    @keyup.enter.native="addAttr"
                    @blur="addAttr">
            </el-input>
            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加属性</el-button>
        </div>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AttrAdd",
        data: function () {
            return {
                attrGroupId: "",
                attrList: [],
                inputVisible: false,
                inputValue: '',
                token: "",
                adminId: ""
            }
        },
        mounted: function () {
            let that = this,
                attrGroupId = that.$route.query.attrGroupId,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.attrGroupId = attrGroupId;
            axios.get("/attr/list-group?attrGroupId=" + attrGroupId + "&adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.attrList = res.data.data;
                    }
                })
        },
        methods: {
            showInput: function () {
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.attrInput.$refs.input.focus();
                });
            },
            addAttr: function () {
                let that = this,
                    inputValue = that.inputValue;
                if (inputValue) {
                    let data = {
                        attrGroupId: that.attrGroupId,
                        name: inputValue,
                        token: that.token,
                        adminId: that.adminId
                    };
                    axios.post("/attr/create", data)
                        .then(res => {
                            if (res.data.code === 2000) {
                                that.attrList.push({name: inputValue});
                            } else {
                                that.$message({
                                    type: 'error',
                                    message: '添加失败!'
                                });
                            }
                        })
                        .catch(err => {
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