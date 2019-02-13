<template>
    <div>
        <el-form ref="specForm" :rules="rules" :model="specForm" label-width="100px">
            <el-form-item label="规格名称" prop="name">
                <el-input v-model="specForm.name"></el-input>
            </el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "SpecAdd",
        data: function () {
            return {
                specForm: {
                    name: ""
                }
            }
        }
    }
</script>

<style scoped>

</style>