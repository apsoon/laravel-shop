<template>
    <div>
        <el-card class="box-card" shadow="never">
            <div slot="header" class="clearfix">
                <span>规格列表</span>
            </div>
            <div>
                <el-tag
                        v-for="spec in specList"
                        :key="spec.id"
                        :type="primary"
                        disable-transitions=true>
                    {{spec.name}}
                </el-tag>
                <el-input
                        class="input-new-tag"
                        v-if="inputVisible"
                        v-model="inputValue"
                        ref="saveTagInput"
                        size="small"
                        @keyup.enter.native="handleInputConfirm"
                        @blur="handleInputConfirm">
                </el-input>
                <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加规格</el-button>
            </div>
        </el-card>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpecList",
        data: function () {
            return {
                specList: []
            }
        },
        mounted: function () {
            let that = this;
            axios.get("/spec/list")
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data;
                    }
                })
                .catch(err => {
                })
        }
    }
</script>

<style scoped>
    .el-tag + .el-tag {
        margin-left: 10px;
    }

    .button-new-tag {
        margin-left: 10px;
        height: 32px;
        line-height: 30px;
        padding-top: 0;
        padding-bottom: 0;
    }

    .input-new-tag {
        width: 90px;
        margin-left: 10px;
        vertical-align: bottom;
    }
</style>