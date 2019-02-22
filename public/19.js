(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[19],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "CouponAdd",
  data: function data() {
    return {
      couponForm: {
        name: "",
        sn: "",
        isNumberLimit: "0",
        number: "",
        isUsageLimit: "0",
        usageValue: "",
        discountType: "1",
        value: "",
        discount: "",
        effectStart: "",
        effectEnd: "",
        describe: "",
        sendType: "1",
        password: "",
        state: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入优惠券名称',
          trigger: 'blur'
        }],
        sn: [{
          required: true,
          message: '请输入优惠券编号',
          trigger: 'blur'
        }],
        value: [{
          required: true,
          message: '请输入优惠券面值',
          trigger: 'blur'
        }]
      },
      effectDate: []
    };
  },
  mounted: function mounted() {},
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.couponForm.validate(function (valid) {
        if (valid) {
          if (that.effectDate) {
            that.couponForm.effectStart = that.effectDate[0].getTime();
            that.couponForm.effectEnd = that.effectDate[1].getTime();
          }

          console.info(that.couponForm);
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/coupon/create", that.couponForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$router.push("/coupon-list");
            }
          }).catch(function (err) {});
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "el-card",
    [
      _c(
        "div",
        { staticClass: "clearfix", attrs: { slot: "header" }, slot: "header" },
        [_c("span", [_vm._v("优惠券编辑")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "couponForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.couponForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "优惠券名称", prop: "name" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入优惠券名称" },
                model: {
                  value: _vm.couponForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.couponForm, "name", $$v)
                  },
                  expression: "couponForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "使用说明", prop: "describe" } },
            [
              _c("el-input", {
                attrs: {
                  type: "textarea",
                  rows: "4",
                  placeholder: "请输入优惠券使用说明"
                },
                model: {
                  value: _vm.couponForm.describe,
                  callback: function($$v) {
                    _vm.$set(_vm.couponForm, "describe", $$v)
                  },
                  expression: "couponForm.describe"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "数量限制", prop: "isNumberLimit" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.couponForm.isNumberLimit,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "isNumberLimit", $$v)
                    },
                    expression: "couponForm.isNumberLimit"
                  }
                },
                [_vm._v("不限制")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.couponForm.isNumberLimit,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "isNumberLimit", $$v)
                    },
                    expression: "couponForm.isNumberLimit"
                  }
                },
                [_vm._v("限制")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.couponForm.isNumberLimit === "1"
            ? _c(
                "el-form-item",
                { attrs: { label: "发放总量", prop: "number" } },
                [
                  _c("el-input", {
                    attrs: {
                      type: "number",
                      placeholder: "请输入优惠券发放数量"
                    },
                    model: {
                      value: _vm.couponForm.number,
                      callback: function($$v) {
                        _vm.$set(_vm.couponForm, "number", $$v)
                      },
                      expression: "couponForm.number"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "使用条件限制", prop: "isUsageLimit" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.couponForm.isUsageLimit,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "isUsageLimit", $$v)
                    },
                    expression: "couponForm.isUsageLimit"
                  }
                },
                [_vm._v("不限制")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.couponForm.isUsageLimit,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "isUsageLimit", $$v)
                    },
                    expression: "couponForm.isUsageLimit"
                  }
                },
                [_vm._v("设置最低消费金额")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.couponForm.isUsageLimit === "1"
            ? _c(
                "el-form-item",
                { attrs: { label: "最低消费金额", prop: "usage.usageValue" } },
                [
                  _c("el-input", {
                    attrs: {
                      type: "number",
                      placeholder: "请输入最低消费金额"
                    },
                    model: {
                      value: _vm.couponForm.usageValue,
                      callback: function($$v) {
                        _vm.$set(_vm.couponForm, "usageValue", $$v)
                      },
                      expression: "couponForm.usageValue"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "减免类型", prop: "isUsageLimit" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.couponForm.discountType,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "discountType", $$v)
                    },
                    expression: "couponForm.discountType"
                  }
                },
                [_vm._v("金额减免")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "2" },
                  model: {
                    value: _vm.couponForm.discountType,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "discountType", $$v)
                    },
                    expression: "couponForm.discountType"
                  }
                },
                [_vm._v("设置折扣")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.couponForm.discountType === "1"
            ? _c(
                "el-form-item",
                { attrs: { label: "减免金额", prop: "usage_number" } },
                [
                  _c("el-input", {
                    attrs: { type: "number", placeholder: "请输入减免金额" },
                    model: {
                      value: _vm.couponForm.value,
                      callback: function($$v) {
                        _vm.$set(_vm.couponForm, "value", $$v)
                      },
                      expression: "couponForm.value"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.couponForm.discountType === "2"
            ? _c(
                "el-form-item",
                { attrs: { label: "折扣数", prop: "usage_number" } },
                [
                  _c("el-input", {
                    attrs: { type: "number", placeholder: "请输入折扣数" },
                    model: {
                      value: _vm.couponForm.discount,
                      callback: function($$v) {
                        _vm.$set(_vm.couponForm, "discount", $$v)
                      },
                      expression: "couponForm.discount"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "有效期" } },
            [
              _c("el-date-picker", {
                attrs: {
                  "unlink-panels": "",
                  type: "daterange",
                  "range-separator": "至",
                  "start-placeholder": "开始日期",
                  "end-placeholder": "结束日期"
                },
                model: {
                  value: _vm.effectDate,
                  callback: function($$v) {
                    _vm.effectDate = $$v
                  },
                  expression: "effectDate"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "发放类型", prop: "sendType" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.couponForm.sendType,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "sendType", $$v)
                    },
                    expression: "couponForm.sendType"
                  }
                },
                [_vm._v("用户领取")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "2" },
                  model: {
                    value: _vm.couponForm.sendType,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "sendType", $$v)
                    },
                    expression: "couponForm.sendType"
                  }
                },
                [_vm._v("后台发放")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "3" },
                  model: {
                    value: _vm.couponForm.sendType,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "sendType", $$v)
                    },
                    expression: "couponForm.sendType"
                  }
                },
                [_vm._v("口令领取")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.couponForm.sendType === "3"
            ? _c(
                "el-form-item",
                { attrs: { label: "口令", prop: "" } },
                [
                  _c("el-input", {
                    attrs: { placeholder: "请输入领取口令" },
                    model: {
                      value: _vm.couponForm.password,
                      callback: function($$v) {
                        _vm.$set(_vm.couponForm, "password", $$v)
                      },
                      expression: "couponForm.password"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "是否生效", prop: "state" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.couponForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "state", $$v)
                    },
                    expression: "couponForm.state"
                  }
                },
                [_vm._v("暂不生效")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.couponForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.couponForm, "state", $$v)
                    },
                    expression: "couponForm.state"
                  }
                },
                [_vm._v("立即生效")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
            [_vm._v("添加优惠券")]
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/pages/market/CouponAdd.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/pages/market/CouponAdd.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CouponAdd.vue?vue&type=template&id=76e149de&scoped=true& */ "./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true&");
/* harmony import */ var _CouponAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CouponAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CouponAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "76e149de",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/market/CouponAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CouponAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CouponAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/market/CouponAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CouponAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CouponAdd.vue?vue&type=template&id=76e149de&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/market/CouponAdd.vue?vue&type=template&id=76e149de&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CouponAdd_vue_vue_type_template_id_76e149de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);