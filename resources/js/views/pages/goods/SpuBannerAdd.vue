<template>
    <el-card class="card">
        <div slot="header" class="clearfix">
            <span>Banner编辑</span>
        </div>
        <el-form ref="spuBannerForm" :model="spuBannerForm" label-width="100px">
            <el-form-item label="图片">
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
                        list-type="picture-card">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="排序优先级" prop="sortOrder">
                <el-input v-model="spuBannerForm.sortOrder"></el-input>
            </el-form-item>
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="spuBannerForm.state" label="0">禁用</el-radio>
                <el-radio v-model="spuBannerForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onCreate">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SpuBannerAdd",
        data: function () {
            return {
                spuBannerForm: {
                    spuId: "",
                    sortOrder: 0,
                    imageUrl: "",
                    state: "0"
                },
                rules: {},
                spuId: "",
                uploadHeader: {},
                imageList: [],
                uploadData: {
                    type: "spu",
                    position: "banner"
                },
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
            that.spuBannerForm.spuId = spuId;
            that.spuId = spuId;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
        },
        methods: {
            onCreate: function () {
                let that = this;
                that.$refs.spuBannerForm.validate((valid) => {
                    if (valid) {
                        axios.post("spu/create-banner", that.spuBannerForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$message({
                                        type: 'success',
                                        message: '添加成功!'
                                    });
                                    setTimeout(() => {
                                        that.$router.push("/spu/detail?spuId=" + that.spuId + "&active=" + "banner");
                                    }, 1000);
                                }
                            });

                    } else {
                        return false;
                    }
                });
            },
            onUploadSuccess: function (response, file, fileList) {
                let that = this;
                if (response.code === 2000) {
                    that.spuBannerForm.imageUrl = response.data.filePath;
                }
            },
            onUploadFailed: function (err, file, fileList) {
                // TODO 上传失败
            },
            onUploadFileRemoved: function (file, fileList) {
                let that = this;
                // TODO 删除文件
                that.spuBannerForm.imageUrl = "";
            },
        }
    }
</script>

<style scoped>

</style>