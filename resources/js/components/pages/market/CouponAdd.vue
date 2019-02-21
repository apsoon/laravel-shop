<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加优惠券</span>
        </div>
        <el-form ref="couponForm" :rules="rules" :model="couponForm" label-width="100px">
            <el-form-item label="优惠券名称" prop="name">
                <el-input v-model="couponForm.name" placeholder="请输入优惠券名称"/>
            </el-form-item>
            <el-form-item label="优惠券编号" prop="sn">
                <el-input v-model="couponForm.sn" placeholder="请输入优惠券编号"/>
            </el-form-item>
            <el-form-item label="使用说明" prop="describe">
                <el-input type="textarea" rows="4" v-model="couponForm.describe" placeholder="请输入优惠券使用说明"/>
            </el-form-item>
            <el-form-item label="发放总量" prop="number">
                <el-input type="number" v-model="couponForm.number" placeholder="请输入优惠券发放数量"/>
            </el-form-item>
            <el-form-item label="有效期">
                <el-date-picker
                        v-model="effectDate"
                        unlink-panels
                        type="daterange"
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期">
                </el-date-picker>
            </el-form-item>
            <el-form-item label="面值" prop="value">
                <el-input type="number" v-model="couponForm.value" placeholder="请输入优惠券使用说明"/>
            </el-form-item>
            <el-form-item label="发放类型" prop="sendType">
                <el-radio v-model="couponForm.sendType" label="1">用户领取</el-radio>
                <el-radio v-model="couponForm.sendType" label="2">后台发放</el-radio>
                <el-radio v-model="couponForm.sendType" label="3">优惠券号领取</el-radio>
            </el-form-item>
            <el-form-item label="是否生效" prop="state">
                <el-radio v-model="couponForm.state" label="0">暂不生效</el-radio>
                <el-radio v-model="couponForm.state" label="1">立即生效</el-radio>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">添加优惠券</el-button>
        </el-form>
    </el-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "CouponAdd",
        data: function () {
            return {
                couponForm: {
                    name: "",
                    sn: "",
                    number: "",
                    value: "",
                    effectStart: "",
                    effectEnd: "",
                    describe: "",
                    sendType: "1",
                    state: "0"
                },
                rules: {
                    name: [
                        {required: true, message: '请输入优惠券名称', trigger: 'blur'}
                    ],
                    sn: [
                        {required: true, message: '请输入优惠券编号', trigger: 'blur'}
                    ],
                    value: [
                        {required: true, message: '请输入优惠券面值', trigger: 'blur'}
                    ]
                },
                effectDate: []
            }
        },
        mounted: function () {

        },
        methods: {
            onSubmit: function () {
                let that = this;
                that.$refs.couponForm.validate((valid) => {
                    if (valid) {
                        if (that.effectDate) {
                            that.couponForm.effectStart = that.effectDate[0].getTime();
                            that.couponForm.effectEnd = that.effectDate[1].getTime();
                        }
                        console.info(that.couponForm);
                        axios.post("/coupon/create", that.couponForm)
                            .then(res => {
                                if (res.data.code === 2000) {
                                    that.$router.push("/coupon-list");
                                }
                            })
                            .catch(err => {

                            });
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>