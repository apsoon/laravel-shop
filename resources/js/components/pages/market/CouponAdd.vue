<template>
    <el-card>
        <div slot="header" class="clearfix">
            <span>添加优惠券</span>
        </div>
        <el-form ref="couponForm" :rules="rules" :model="couponForm" label-width="100px">
            <el-form-item label="优惠券名称" prop="name">
                <el-input v-model="couponForm.name" placeholder="请输入优惠券名称"/>
            </el-form-item>
            <el-form-item label="优惠券编号" prop="name">
                <el-input v-model="couponForm.sn" placeholder="请输入优惠券编号"/>
            </el-form-item>
            <el-form-item label="使用说明" prop="number">
                <el-input type="textarea" rows="4" v-model="couponForm.number" placeholder="请输入优惠券使用说明"/>
            </el-form-item>
            <el-form-item label="发放总量" prop="number">
                <el-input v-model="couponForm.number" placeholder="请输入优惠券发放数量"/>
            </el-form-item>
            <el-form-item label="生效时间" prop="number">
                <el-input v-model="couponForm.number" placeholder="请输入优惠券使用说明"/>
            </el-form-item>
            <el-form-item label="过期时间" prop="number">
                <el-input v-model="couponForm.number" placeholder="请输入优惠券使用说明"/>
            </el-form-item>
            <el-form-item label="发放类型" prop="number">

            </el-form-item>
<el-button ></el-button>
        </el-form>
    </el-card>
</template>

<script>
    export default {
        name: "CouponAdd",
        data: function () {
            return {
                couponForm: {
                    name: "",
                    sn: "",
                    number: "",
                    value: "",
                    desc: ""
                }
            }
        }
    }
</script>

<style scoped>

</style>