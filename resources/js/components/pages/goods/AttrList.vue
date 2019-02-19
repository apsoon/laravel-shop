<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link to="/attr-group-add">
                <el-button type="primary" size="medium">添加属性组</el-button>
            </router-link>
            <router-link to="/attr-add">
                <el-button type="primary" size="medium">添加属性</el-button>
            </router-link>
        </div>
    </el-card>

</template>

<script>
    export default {
        name: "AttrList"
    }
</script>

<style scoped>

</style>