<template>
    <div>
        <el-form ref="adForm" :rules="rules" :model="adForm" label-width="100px">
            <el-form-item label="广告名称" prop="name">
                <el-col :span="5">
                    <el-input v-model="adForm.name" :span="3" placeholder="请输入广告名称"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="广告描述" prop="content">
                <el-col :span="5">
                    <el-input v-model="adForm.content" placeholder="请输入广告描述"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="广告位置" prop="positionId">
                <el-col :span="5">
                    <el-select v-model="adForm.positionId" placeholder="请选广告位置">
                        <el-option v-for="item in positionList"
                                   :key="item.id"
                                   :label="item.name"
                                   :value="item.id">
                        </el-option>
                    </el-select>
                </el-col>
            </el-form-item>
            <el-form-item label="排序" prop="sortOrder">
                <el-col :span="5">
                    <el-input v-model="adForm.sortOrder"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="添加图片" prop="imageList">
                <el-upload
                        class="upload-demo"
                        action="/upload/image"
                        :headers="uploadHeader"
                        :on-success="onUploadSuccess"
                        :on-error="onUploadFailed"
                        :on-remove="onUploadFileRemoved"
                        :limit="1"
                        :data="uploadData"
                        :file-list="imageList"
                        list-type="picture">
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="adForm.state" label="0">禁用</el-radio>
                <el-radio v-model="adForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "AdAdd",
        data: function () {
            // let uploadValidator = function (rule, value, callback) {
            //     let adForm = this.adForm;
            //     console.info(adForm);
            //     if (adForm.imageUrl.length <= 0) {
            //         callback(new Error('请上传广告图片'));
            //     }
            //     callback();
            // };
            return {
                adForm: {
                    name: '',
                    content: '',
                    sortOrder: 1,
                    state: "0",
                    positionId: "",
                    imageUrl: ""
                },
                rules: {
                    name: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'},
                        // {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                    positionId: [
                        {required: true, message: '请选择广告位置', trigger: 'change'}
                    ],
                    imageList: [
                        // {required: true, message: '请上传广告图片', trigger: 'change'}
                    ]
                },
                positionList: [],
                uploadHeader: {},
                imageList: [],
                uploadData: {
                    type: "ad",
                    position: "banner"
                }
            }
        },
        mounted: function () {
            let that = this;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
            axios.get("adPos/list").then(res => {
                that.positionList = res.data.data;
                console.info(that.positionList);
            });
        },
        methods: {
            onSubmit() {
                let that = this;
                that.$refs["adForm"].validate((valid) => {
                    if (valid) {
                        axios.post("ad/create", that.adForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    router.push("ad-list");
                                }
                            });

                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            onUploadSuccess: function (response, file, fileList) {
                let that = this;
                if (response.code === 2000) {
                    let adForm = that.adForm;
                    adForm.imageUrl = response.data.filePath;
                    that.adForm = adForm;
                }
            },
            onUploadFailed: function (err, file, fileList) {

            },
            onUploadFileRemoved: function (file, fileList) {
                let that = this;
                // TODO 删除文件
                let adForm = that.adForm;
                adForm.imageUrl = "";
                that.adForm = adForm;
            },

        },

    }
</script>

<style scoped>

</style>