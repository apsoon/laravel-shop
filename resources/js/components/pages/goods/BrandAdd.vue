<template>
    <div>
        <el-form ref="brandForm" :rules="rules" :model="brandForm" label-width="100px">
            <el-form-item label="广告名称" prop="name">
                <el-input v-model="brandForm.name"></el-input>
            </el-form-item>
            <el-form-item label="广告描述" prop="content">
                <el-input v-model="brandForm.content"></el-input>
            </el-form-item>
            <el-form-item label="广告位置" prop="positionId">
                <el-select v-model="brandForm.positionId" placeholder="请选广告位置">
                    <el-option v-for="item in positionList"
                               :key="item.id"
                               :label="item.name"
                               :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="排序" prop="sortOrder">
                <el-input v-model="brandForm.sortOrder"></el-input>
            </el-form-item>
            <el-form-item label="添加图片">
                <el-upload
                        class="upload-demo"
                        action=""
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :before-remove="beforeRemove"
                        :limit="1"
                        :file-list="fileList">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="brandForm.state" label="0">禁用</el-radio>
                <el-radio v-model="brandForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "BrandAdd",
        data: function () {
            return {
                brandForm: {
                    name: ""
                },
            }
        }
    }
</script>

<style scoped>

</style>