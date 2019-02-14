(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "SkuAdd",
  data: function data() {
    return {
      skuId: "",
      skuForm: {
        spuId: "",
        name: "",
        originPrice: "",
        price: "",
        number: "",
        state: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入产品名称',
          trigger: 'blur'
        }],
        price: [{
          required: true,
          message: '请输入产品价格',
          trigger: 'blur'
        }],
        number: [{
          required: true,
          message: '请输入产品数量',
          trigger: 'blur'
        }]
      },
      specList: []
    };
  },
  mounted: function mounted() {
    var that = this,
        spuId = that.$route.query.spuId;
    that.spuId = spuId;
    that.skuForm.spuId = spuId;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("spu/specList?spuId=" + spuId).then(function (res) {
      if (res.data.code === 2000) {
        that.specList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.skuForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/sku/create", that.skuForm).then(function (res) {
            if (res.data.code === 2000) {
              // message
              that.$router.push("/spu/detail");
            }
          }).catch(function (err) {});
        } else {
          return false;
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
      _c("div", { attrs: { slot: "header" }, slot: "header" }, [
        _c("span", [_vm._v("创建产品")])
      ]),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "skuForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.skuForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "产品名称", prop: "name" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入产品名称" },
                model: {
                  value: _vm.skuForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.skuForm, "name", $$v)
                  },
                  expression: "skuForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "产品原价", prop: "originPrice" } },
            [
              _c("el-input", {
                attrs: { type: "number", placeholder: "请输入产品原价" },
                model: {
                  value: _vm.skuForm.originPrice,
                  callback: function($$v) {
                    _vm.$set(_vm.skuForm, "originPrice", $$v)
                  },
                  expression: "skuForm.originPrice"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "产品价格", prop: "price" } },
            [
              _c("el-input", {
                attrs: { type: "number", placeholder: "请输入产品价格" },
                model: {
                  value: _vm.skuForm.price,
                  callback: function($$v) {
                    _vm.$set(_vm.skuForm, "price", $$v)
                  },
                  expression: "skuForm.price"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "产品数量", prop: "number" } },
            [
              _c("el-input", {
                attrs: { type: "number", placeholder: "请输入产品数量" },
                model: {
                  value: _vm.skuForm.number,
                  callback: function($$v) {
                    _vm.$set(_vm.skuForm, "number", $$v)
                  },
                  expression: "skuForm.number"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "是否上架", prop: "state" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.skuForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.skuForm, "state", $$v)
                    },
                    expression: "skuForm.state"
                  }
                },
                [_vm._v("暂不上架")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.skuForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.skuForm, "state", $$v)
                    },
                    expression: "skuForm.state"
                  }
                },
                [_vm._v("立即上架")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
            [_vm._v("立即创建")]
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

/***/ "./resources/js/components/pages/goods/SkuAdd.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/pages/goods/SkuAdd.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SkuAdd.vue?vue&type=template&id=5536359a&scoped=true& */ "./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true&");
/* harmony import */ var _SkuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SkuAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SkuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5536359a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/SkuAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SkuAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SkuAdd.vue?vue&type=template&id=5536359a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/SkuAdd.vue?vue&type=template&id=5536359a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuAdd_vue_vue_type_template_id_5536359a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);