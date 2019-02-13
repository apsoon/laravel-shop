<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加规格及选项</span>
        </div>
        <el-form ref="spuSForm" :model="spuSForm" :rules="rules" label-width="100px">
            <el-form-item label="请选择规格" prop="specId">
                <el-select placeholder="请选择" v-model="spuSForm.specId">
                    <el-option
                            v-for="item in specList"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="请添加选项">
                <el-tag
                        v-for="option in spuSForm.options"
                        :key="option.index"
                        type="primary"
                        disable-transitions=true>
                    {{option}}
                </el-tag>
                <el-input
                        class="input-new-tag"
                        v-if="inputVisible"
                        v-model="inputValue"
                        ref="optionInput"
                        size="small"
                        @keyup.enter.native="addOption"
                        @blur="addOption">
                </el-input>
                <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加规格</el-button>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加规格</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuSpecAdd",
        data: function () {
            return {
                spuId: 0,
                spuSForm: {
                    spuId: "",
                    specId: "",
                    options: []
                },
                rules: {},
                specList: [],
                inputVisible: false,
                inputValue: ''
            }
        },
        mounted: function () {
            let that = this;
            that.spuid = that.$route.query.spuId;
            axios.get("spec/list")
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data
                        console.info(that.specList);
                    }
                }).catch(err => {
            });
        },
        methods: {
            onSubmit: function () {
                axios.post("/spu/relateSpec", {
                    name: inputValue
                }).then(res => {
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
            },
            showInput: function () {
                let that = this;
                that.inputVisible = true;
                that.$nextTick(_ => {
                    that.$refs.optionInput.$refs.input.focus();
                });
            },
            addOption: function () {
                let that = this,
                    inputValue = that.inputValue;
                if (inputValue) {
                    that.spuSForm.options.push(inputValue);
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