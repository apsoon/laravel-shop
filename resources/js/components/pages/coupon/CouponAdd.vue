<template>
    <div>
        123
        <el-form ref="couponForm" :rules="rules" :model="couponForm" label-width="100px">
            <el-form-item label-width="优惠券名称" prop="name">
                <el-col span="5">
                    <el-input class="form-control" id="goods-name" name="name" placeholder="请输入优惠券名称"/>
                </el-col>
            </el-form-item>
            <!--<div class="form-group">-->
            <!--<label>简要描述</label>-->
            <!--<input class="form-control" id="goods-brief" name="brief" placeholder="请输入简要描述">-->
            <!--</div>-->
            <!--<div class="form-group">-->
            <!--<label>选择分类<b class="text-red">*</b></label>-->
            <!--<label>-->
            <!--<select class="form-control select2-container" id="category-id" name="category_id">-->
            <!--<option value="0">未选择</option>-->
            <!--@foreach($categoryList as $category)-->
            <!--<option value="{{$category->id}}">{{$category->name}}</option>-->
            <!--@endforeach-->
            <!--</select>-->
            <!--</label>-->
            <!--</div>-->
            <!--<div class="form-group">-->
            <!--<label>选择品牌<b class="text-red">*</b></label>-->
            <!--<label>-->
            <!--<select class="form-control select2-container" id="brand-id" name="brand_id">-->
            <!--<option value="0">未选择</option>-->
            <!--@foreach($brandList as $brand)-->
            <!--<option value="{{$brand->id}}">{{$brand->name}}</option>-->
            <!--@endforeach-->
            <!--</select>-->
            <!--</label>-->
            <!--</div>-->
            <!--<div class="form-group">-->
            <!--<label>添加图片<b class="text-red">*</b></label>-->
            <!--<input class="file" type="file" id="logo" accept="image/gif, image/png, image/jpeg, image/jpg"-->
            <!--name="cover">-->
            <!--<p class="help-block">图片大小120px*60px 小于5M</p>-->
            <!--</div>-->
            <!--<div class="form-group">-->
            <!--<label>商品描述<b class="text-red">*</b></label>-->
            <!--<div id="editor">-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="box-footer">-->
            <!--<button type="button" id="goods-submit" class="btn btn-primary">提交</button>-->
            <!--</div>-->
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "CouponAdd",
        data: function () {
            return {
                couponForm: {
                    name: ""
                }
            }
        }
    }
</script>

<style scoped>

</style>