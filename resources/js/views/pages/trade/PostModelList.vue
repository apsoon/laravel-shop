<template>
    <el-card>
        <div slot="header" class="clearfix">
            <router-link :to="{path: 'post-model-edit', query: {type: 'create'}}">
                <el-button type="primary" size="medium">添加新模版</el-button>
            </router-link>
        </div>
    </el-card>
</template>

<script>
    export default {
        name: "PostModelList"
    }
</script>

<style scoped>

</style>