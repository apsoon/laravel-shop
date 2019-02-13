<template>
    <el-card>
        <div slot="header">
            <span>创建产品</span>
        </div>
        <el-form ref="skuForm" :rules="rules" :model="skuForm" label-width="100px">
            <el-form-item label="产品名称" prop="name">
                <el-input v-model="skuForm.name" placeholder="请输入产品名称"></el-input>
            </el-form-item>
            <el-form-item label="产品原价" prop="originPrice">
                <el-input type="number" v-model="skuForm.originPrice" placeholder="请输入产品原价"></el-input>
            </el-form-item>
            <el-form-item label="产品价格" prop="price">
                <el-input type="number" v-model="skuForm.price" placeholder="请输入产品价格"></el-input>
            </el-form-item>
            <el-form-item label="产品数量" prop="number">
                <el-input type="number" v-model="skuForm.number" placeholder="请输入产品数量"></el-input>
            </el-form-item>
            <el-form-item label="是否上架" prop="state">
                <el-radio v-model="skuForm.state" label="0">暂不上架</el-radio>
                <el-radio v-model="skuForm.state" label="1">立即上架</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "SkuAdd",
        data: function () {
            return {
                skuId: "",
                skuForm: {
                    spuId: "",
                    name: "",
                    originPrice: "",
                    price: "",
                    number: "",
                    state: "0",
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
                    ]
                }
            }
        },
        mounted: function () {
            let that = this,
                spuId = that.$route.query.spuId;
            that.spuId = spuId;
            that.skuForm.spuId = spuId;
        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.skuForm.validate((valid) => {
                    if (valid) {
                        axios.post("/sku/create", that.skuForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    // message
                                    that.$router.push("/spu/detail");
                                }
                            })
                            .catch(err => {

                            })
                    } else {
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>