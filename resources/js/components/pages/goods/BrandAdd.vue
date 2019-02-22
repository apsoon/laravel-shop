<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>品牌</span>
        </div>
        <el-form ref="brandForm" :rules="rules" :model="brandForm" label-width="100px">
            <el-form-item label="品牌名称" prop="name">
                <el-input v-model="brandForm.name"></el-input>
            </el-form-item>
            <el-form-item label="品牌描述" prop="describe">
                <el-input v-model="brandForm.describe"></el-input>
            </el-form-item>
            <el-form-item label="所属地区" prop="region">
                <el-input v-model="brandForm.region"></el-input>
            </el-form-item>
            <el-form-item label="品牌LOGO">
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
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="brandForm.state" label="0">禁用</el-radio>
                <el-radio v-model="brandForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onCreate" v-if="type === 'create'">立即创建</el-button>
            <el-button type="primary" @click="onUpdate" v-else>修改</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BrandAdd",
        data: function () {
            return {
                brandForm: {
                    name: "",
                    describe: "",
                    region: "",
                    logo: "",
                    state: "0"
                },
                rules: {
                    name: [
                        {required: true, message: '请输入广告名称', trigger: 'blur'}
                    ]
                },
                uploadHeader: {},
                imageList: [],
                uploadData: {
                    type: "logo",
                    position: "brand"
                },
                brandId: "",
                type: "create",
                // logoUrl:""
            }
        },
        mounted: function () {
            let that = this;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
            let type = that.$route.query.type;
            if (type === "modify") {
                let brandId = that.$route.query.brandId;
                that.brandId = brandId;
                that.type = "modify";
                axios.get("/brand/detail?brandId=" + brandId)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.brandForm = {
                                id: data.id,
                                name: data.name,
                                describe: data.describe,
                                region: data.region,
                                logo: data.logo,
                                state: "" + data.state
                            };
                        }
                    })
                    .catch(err => {
                    });
            }
        },
        methods: {
            onCreate: function () {
                let that = this;
                that.$refs.brandForm.validate((valid) => {
                    if (valid) {
                        axios.post("brand/create", that.brandForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$message({
                                        type: 'success',
                                        message: '添加成功!'
                                    });
                                    setTimeout(() => {
                                        that.$router.push("brand-list");
                                    }, 1000);
                                }
                            });

                    } else {
                        return false;
                    }
                });
            },
            onUpdate: function () {
                let that = this;
                that.$refs.brandForm.validate((valid) => {
                    if (valid) {
                        axios.post("/brand/update", that.brandForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$message({
                                        type: 'success',
                                        message: '更新成功!'
                                    });
                                    setTimeout(() => {
                                        that.$router.push("brand-list");
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
                    let brandForm = that.brandForm;
                    brandForm.logo = response.data.filePath;
                    that.brandForm = brandForm;
                }
            },
            onUploadFailed: function (err, file, fileList) {
                // TODO 上传失败
            },
            onUploadFileRemoved: function (file, fileList) {
                let that = this;
                // TODO 删除文件
                let brandForm = that.brandForm;
                brandForm.logo = "";
                that.brandForm = brandForm;
            },
        }
    }
</script>

<style scoped>

</style>