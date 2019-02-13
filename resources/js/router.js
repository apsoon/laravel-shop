/* jshint esversion: 6 */

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            name: "index",
            path: '/',
            component: resolve => void(require(['./components/pages/Index.vue'], resolve))
        },

        // =============================  商品  ===============================
        {
            name: "CategoryList",
            path: "/category-list",
            component: resolve => void (require(['./components/pages/goods/CategoryList.vue'], resolve))
        },
        {
            name: "CategoryAdd",
            path: "/category-add",
            component: resolve => void (require(['./components/pages/goods/CategoryAdd.vue'], resolve))
        },
        {
            name: "BrandList",
            path: "/brand-list",
            component: resolve => void (require(['./components/pages/goods/BrandList.vue'], resolve))
        },
        {
            name: "BrandAdd",
            path: "/brand-add",
            component: resolve => void (require(['./components/pages/goods/BrandAdd.vue'], resolve))
        },
        {
            name: "AttrList",
            path: "/attr-list",
            component: resolve => void (require(['./components/pages/goods/AttrList.vue'], resolve))
        },
        {
            name: "AttrAdd",
            path: "/Attr-add",
            component: resolve => void (require(['./components/pages/goods/AttrAdd.vue'], resolve))
        },


        // =============================  优惠券  ===============================
        {
            name: "CouponList",
            path: "/coupon-list",
            component: resolve => void (require(['./components/pages/coupon/CouponList.vue'], resolve))
        },
        {
            name: "CouponAdd",
            path: "/coupon-add",
            component: resolve => void (require(['./components/pages/coupon/CouponAdd.vue'], resolve))
        },

        // =============================  广告  ===============================
        {
            name: "AdList",
            path: '/ad-list',
            component: resolve => void(require(['./components/pages/ad/AdList.vue'], resolve))
        },
        {
            name: "AdAdd",
            path: '/ad-add',
            component: resolve => void(require(['./components/pages/ad/AdAdd.vue'], resolve))
        }
    ]
})