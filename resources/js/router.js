/* jshint esversion: 6 */

import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './views/layouts/Home.vue';
// ===============================  登录  ===============================
import Login from './views/pages/auth/Login.vue';
// ===============================  首页  ===============================
import Index from './views/pages/Index.vue';
// ===============================  商品管理  ===============================
import SpuList from './views/pages/goods/SpuList.vue';
import SpuDetail from './views/pages/goods/SpuDetail.vue';
import SpuEdit from './views/pages/goods/SpuEdit.vue';
import SpuSpecEdit from './views/pages/goods/SpuSpecEdit.vue';
import SpuBannerAdd from './views/pages/goods/SpuBannerAdd.vue';
import SpuSpecOption from './views/pages/goods/SpuSpecOption.vue';
import SkuEdit from './views/pages/goods/SkuEdit.vue';
import CategoryList from './views/pages/goods/CategoryList.vue';
import CategoryEdit from './views/pages/goods/CategoryEdit.vue';
import BrandEdit from './views/pages/goods/BrandEdit.vue';
import BrandList from './views/pages/goods/BrandList.vue';
import AttrList from './views/pages/goods/AttrList.vue';
import AttrGroupAdd from './views/pages/goods/AttrGroupAdd.vue';
import SpuAttrEdit from './views/pages/goods/SpuAttrEdit.vue';
import AttrAdd from './views/pages/goods/AttrAdd.vue';
import SpecList from './views/pages/goods/SpecList.vue';
// ===============================  交易管理  ===============================
import OrderList from './views/pages/trade/OrderList.vue';
import OrderDetail from './views/pages/trade/OrderDetail.vue';
import CommentList from './views/pages/trade/CommentList.vue';
import PostModelList from './views/pages/trade/PostModelList.vue';
import PostModelEdit from './views/pages/trade/PostModelEdit.vue';
import AfterSaleList from './views/pages/trade/AfterSaleList.vue';
// ===============================  营销管理 =============================== 
import CouponList from './views/pages/market/CouponList.vue';
import CouponAdd from './views/pages/market/CouponAdd.vue';
// ===============================  用户管理  ===============================
import UserList from './views/pages/user/UserList.vue';
import AddrList from './views/pages/user/AddrList.vue';
// ===============================  广告管理  ===============================
import AdList from './views/pages/ad/AdList.vue';
import AdEdit from './views/pages/ad/AdEdit.vue';
// ===============================  权限管理  ===============================
import AdminList from './views/pages/permit/AdminList.vue';
import AdminEdit from './views/pages/permit/AdminEdit.vue';
// =============================== 设置  ===============================
import ShopSet from './views/pages/settings/ShopSet.vue';

Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [

        {name: 'Login', path: '/login', component: Login, hidden: true},
        {
            path: '/',
            component: Home,
            name: '首页',
            iconCls: 'el-icon-menu',
            leaf: true, // 只有一个节点
            children: [
                {name: '首页', path: '/index', component: Index},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '商品管理',
            iconCls: 'el-icon-goods',//图标样式class
            children: [
                {name: '商品列表', path: '/spu-list', component: SpuList},
                {name: 'SpuDetail', path: '/spu-detail', component: SpuDetail, hidden: true},
                {name: 'SpuEdit', path: '/spu-Edit', component: SpuEdit, hidden: true},
                {name: 'SpuSpecEdit', path: '/spu-spec-Edit', component: SpuSpecEdit, hidden: true},
                {name: 'SpuBannerAdd', path: '/spu-banner-add', component: SpuBannerAdd, hidden: true},
                {name: 'SpuSpecOption', path: '/spu-spec-option', component: SpuSpecOption, hidden: true},
                {name: 'SkuEdit', path: '/sku-edit', component: SkuEdit, hidden: true},
                {name: '分类列表', path: '/category-list', component: CategoryList},
                {name: 'CategoryEdit', path: '/category-edit', component: CategoryEdit, hidden: true},
                {name: '品牌列表', path: '/brand-list', component: BrandList},
                {name: 'BrandEdit', path: '/brand-edit', component: BrandEdit, hidden: true},
                {name: '属性列表', path: '/attr-list', component: AttrList},
                {name: 'AttrGroupAdd', path: '/attr-group-add', component: AttrGroupAdd, hidden: true},
                {name: 'SpuAttrEdit', path: '/spu-attr-edit', component: SpuAttrEdit, hidden: true},
                {name: 'AttrAdd', path: '/attr-add', component: AttrAdd, hidden: true},
                {name: '规格列表', path: '/spec-list', component: SpecList},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '交易管理',
            iconCls: 'el-icon-sold-out',//图标样式class
            children: [
                {name: '订单列表', path: '/order-list', component: OrderList},
                {name: 'OrderDetail', path: '/order-detail', component: OrderDetail, hidden: true},
                {name: '评论列表', path: '/comment-list', component: CommentList},
                {name: '邮费模版', path: '/post-model-list', component: PostModelList},
                {name: 'PostModelEdit', path: '/post-model-edit', component: PostModelEdit, hidden: true},
                {name: '售后列表', path: '/after-sale-list', component: AfterSaleList},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '营销管理',
            iconCls: 'el-icon-share',//图标样式class
            children: [
                {name: '优惠券列表', path: '/coupon-list', component: CouponList},
                {name: 'CouponAdd', path: '/coupon-add', component: CouponAdd, hidden: true},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '用户管理',
            iconCls: 'el-icon-tickets',//图标样式class
            children: [
                {name: '用户列表', path: '/user-list', component: UserList},
                {name: '地址列表', path: '/addr-list', component: AddrList},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '广告管理',
            iconCls: 'el-icon-picture-outline',//图标样式class
            children: [
                {name: '广告列表', path: '/ad-list', component: AdList},
                {name: 'AdEdit', path: '/ad-edit', component: AdEdit, hidden: true},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '权限管理',
            iconCls: 'el-icon-circle-check-outline',//图标样式class
            children: [
                {name: '管理员列表', path: '/admin-list', component: AdminList},
                {name: 'AdminEdit', path: '/admin-edit', component: AdminEdit, hidden: true},
            ]
        },
        {
            path: '/',
            component: Home,
            name: '商店设置',
            iconCls: 'el-icon-setting',
            leaf: true,//只有一个节点
            children: [
                {name: '商店设置', path: '/shop-set', component: ShopSet},
            ]
        },
    ]
})