<template>
    <el-card shadow="never">
        <div slot="header" class="clearfix">
            <span>编辑产品</span>
        </div>
        <el-form ref="skuForm" :rules="rules" :model="skuForm" label-width="100px">
            <el-form-item label="产品名称" prop="name">
                <el-input v-model="skuForm.name" placeholder="请输入产品名称"/>
            </el-form-item>
            <el-form-item label="产品简述" prop="brief">
                <el-input v-model="skuForm.brief" placeholder="请输入产品简述"/>
            </el-form-item>
            <el-form-item label="产品原价" prop="originPrice">
                <el-input type="number" v-model="skuForm.originPrice" placeholder="请输入产品原价"/>
            </el-form-item>
            <el-form-item label="产品价格" prop="price">
                <el-input type="number" v-model="skuForm.price" placeholder="请输入产品价格"/>
            </el-form-item>
            <el-form-item label="产品数量" prop="number">
                <el-input type="number" v-model="skuForm.number" placeholder="请输入产品数量"/>
            </el-form-item>
            <template slot-slop="scope" v-for="spec in specList">
                <el-form-item :label="spec.name" prop="specOption">
                    <!--:rules="{validator: ruleSelect, trigger: 'blur'}">-->
                    <el-select placeholder="请选择" v-model="spec.option">
                        <el-option
                                v-for="option in spec.options"
                                :key="option.id"
                                :label="option.name"
                                :value="option.id">
                        </el-option>
                    </el-select>
                </el-form-item>
            </template>
            <el-form-item label="产品图片">
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
            <el-form-item label="是否上架" prop="state">
                <el-radio v-model="skuForm.state" label="0">暂不上架</el-radio>
                <el-radio v-model="skuForm.state" label="1">立即上架</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onCreate" v-if="type === 'create'">立即创建</el-button>
            <el-button type="primary" @click="onUpdate" v-else>修改</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SkuEdit",
        data: function () {
            return {
                skuId: "",
                skuForm: {
                    id: "",
                    spuId: "",
                    name: "",
                    brief: "",
                    options: [],
                    originPrice: "",
                    price: "",
                    number: "",
                    imageUrl: "",
                    state: "0",
                    token: "",
                    adminId: "",
                },
                rules: {
                    name: [
                        {required: true, message: '请输入产品名称', trigger: 'blur'},
                    ],
                    price: [
                        {required: true, message: '请输入产品价格', trigger: 'blur'},
                    ],
                    number: [
                        {required: true, message: '请输入产品数量', trigger: 'blur'},
                    ],
                    specOption: [
                        {}
                    ]
                },
                specList: [],
                imageList: [],
                uploadHeader: {},
                uploadData: {
                    type: "image",
                    position: "sku"
                },
                type: "create",
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId,
                type = that.$route.query.type,
                user = sessionStorage.getItem('user');
            that.type = type;
            user = JSON.parse(user);
            that.token = user.token;
            that.adminId = user.id;
            that.uploadHeader = {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            };
            that.spuId = spuId;
            that.skuForm.spuId = spuId;
            axios.get("/spu/specOptionList?spuId=" + spuId + "&adminId=" + that.adminId + "&token=" + that.token)
                .then(res => {
                    if (res.data.code === 2000) {
                        that.specList = res.data.data;
                    }
                }).catch(err => {
            });
            if (type === 'modify') {
                let skuId = that.$route.query.skuId;
                axios.get("/sku/detail?skuId=" + skuId + "&adminId=" + that.adminId + "&token=" + that.token)
                    .then(res => {
                        if (res.data.code === 2000) {
                            let data = res.data.data;
                            that.skuForm = {
                                id: data.id,
                                spuId: data.sku_id,
                                name: data.name,
                                brief: data.brief,
                                originPrice: data.origin_price,
                                price: data.price,
                                number: data.number,
                                state: "" + data.state
                            }
                        }
                    }).catch(err => {
                });
            }
        },
        methods: {
            onCreate: function () {
                let that = this;
                console.info("123");
                that.$refs.skuForm.validate((valid) => {
                    if (valid) {
                        let options = [],
                            specList = that.specList;
                        for (let spec of specList) {
                            options.push(spec.option);
                        }
                        that.skuForm.options = options;
                        that.skuForm.token = that.token;
                        that.skuForm.adminId = that.adminId;
                        axios.post("/sku/create", that.skuForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$router.push("/spu-detail?spuId=" + that.spuId + "&active=" + "sku");
                                }
                            }).catch(err => {
                        });
                    } else {
                        return false;
                    }
                });
            },
            onUpdate: function () {
                let that = this;
                that.$refs.skuForm.validate((valid) => {
                    if (valid) {
                        let options = [],
                            specList = that.specList;
                        for (let spec of specList) {
                            options.push(spec.option);
                        }
                        that.skuForm.options = options;
                        that.skuForm.token = that.token;
                        that.skuForm.adminId = that.adminId;
                        axios.post("/sku/update", that.skuForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$router.push("/spu/detail?spuId=" + that.spuId + "&active=" + "sku");
                                }
                            }).catch(err => {
                        });
                    } else {
                        return false;
                    }
                });
            },
            ruleSelect: function (rule, value, callback) {
            },
            onUploadSuccess: function (response, file, fileList) {
                let that = this;
                if (response.code === 2000) {
                    let skuForm = that.skuForm;
                    skuForm.imageUrl = response.data.filePath;
                    that.skuForm = skuForm;
                }
            },
            onUploadFailed: function (err, file, fileList) {
                // TODO 上传失败
            },
            onUploadFileRemoved: function (file, fileList) {
                let that = this;
                // TODO 删除文件
                let skuForm = that.skuForm;
                skuForm.logo = "";
                that.skuForm = skuForm;
            },
        }
    }
</script>

<style scoped>

</style>