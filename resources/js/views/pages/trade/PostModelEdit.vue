<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>邮费模版编辑</span>
        </div>
        <el-form ref="postModelForm" :rules="rules" model="postModelForm" label-width="120px">
            <el-form-item prop="name" label="运费模版名称">
                <el-input v-model="postModelForm.name" placeholder="请输入运费模版名称"/>
            </el-form-item>
            <el-form-item prop="remark" label="模版备注">
                <el-input v-model="postModelForm.remark" placeholder="请输入模板备注"/>
            </el-form-item>
            <el-form-item label="计费类型" prop="feeType">
                <el-radio v-model="postModelForm.feeType" label="1">按件计费</el-radio>
                <el-radio v-model="postModelForm.feeType" label="2">按重量计费</el-radio>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    export default {
        name: "PostTacticEdit",
        data: function () {
            return {
                postModelForm: {
                    name: "",
                    remark: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入运费模版名称', trigger: 'blur'}
                    ]
                },
                token: "",
                adminId: ""
            }
        }
    }
</script>

<style scoped>

</style>