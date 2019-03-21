<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>编辑广告</span>
        </div>
        <el-form ref="adForm" :rules="rules" :model="adForm" label-width="100px">
            <el-form-item label="广告名称" prop="name">
                <el-input v-model="adForm.name" :span="3" placeholder="请输入广告名称"/>
            </el-form-item>
            <el-form-item label="广告描述" prop="content">
                <el-input v-model="adForm.content" placeholder="请输入广告描述"/>
            </el-form-item>
            <el-form-item label="广告位置" prop="positionId">
                <el-select v-model="adForm.positionId" placeholder="请选广告位置">
                    <el-option v-for="item in positionList"
                               :key="item.id"
                               :label="item.name"
                               :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="排序优先级" prop="sortOrder">
                <el-input v-model="adForm.sortOrder" placeholder="请输入广告排序优先级"/>
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
                        list-type="picture-card">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="跳转类型" prop="linkType">
                <el-radio v-model="adForm.linkType" label="0">不设置跳转</el-radio>
                <el-radio v-model="adForm.linkType" label="1">跳转商品页</el-radio>
            </el-form-item>
            <el-form-item label="商品编号" prop="skuId" v-if="adForm.linkType === '1'">
                <el-input v-model="adForm.skuId" placeholder="请输入商品编号"/>
            </el-form-item>
            <el-form-item label="是否启用" prop="state">
                <el-radio v-model="adForm.state" label="0">禁用</el-radio>
                <el-radio v-model="adForm.state" label="1">启用</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit" v-if="type==='create'">立即创建</el-button>
            <el-button type="primary" @click="onUpdate" v-else>立即修改</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";
    import router from "../../../router";

    export default {
        name: "AdEdit",
        data: function () {
            return {
                adForm: {
                    name: '',
                    content: '',
                    sortOrder: 1,
                    state: "0",
                    positionId: "",
                    imageUrl: "",
                    linkType: "0",
                    skuId: "0",
                    token: "",
                    adminId: ""
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
                },
                type: "create"
            }
        },
        mounted: function () {
            let that = this,
                user = sessionStorage.getItem('user');
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
            let type = that.$route.query.type;
            if (type === "modify") {
                console.info(type);
                that.type = type;
                let adId = that.$route.query.adId;
                that.adId = adId;
                axios.get("/ad/detail?adId=" + adId + "&admin_id=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.adForm = {
                                id: data.id,
                                name: data.name,
                                content: data.content,
                                sortOrder: data.sort_order,
                                state: "" + data.state,
                                positionId: data.position_id,
                                imageUrl: data.image_url,
                                linkType: "" + data.link_type,
                                skuId: data.sku_id
                            }
                        }
                    })
                    .catch(err => {

                    });
            }
            axios.get("adPos/list" + "&admin_id=" + that.adminId + "&token=" + that.token).then(res => {
                that.positionList = res.data.data;
                console.info(that.positionList);
            });
        },
        methods: {
            onSubmit() {
                let that = this;
                that.$refs["adForm"].validate((valid) => {
                    if (valid) {
                        that.adForm.token = that.token;
                        that.adForm.adminId = that.adminId;
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
            onUpdate: function () {
                let that = this;
                that.$refs["adForm"].validate((valid) => {
                    if (valid) {
                        that.adForm.token = that.token;
                        that.adForm.adminId = that.adminId;
                        axios.post("ad/update", that.adForm)
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