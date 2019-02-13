(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "BrandAdd",
  data: function data() {
    return {
      brandForm: {
        name: "",
        describe: "",
        region: "",
        logo: "",
        state: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }]
      }
    };
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.brandForm.validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("brand/create", that.brandForm).then(function (res) {
            if (res.data.code === 2000) {
              that.$message({
                type: 'success',
                message: '添加成功!'
              });
              setTimeout(function () {
                that.$router.push("brand-list");
              }, 1000);
            }
          });
        } else {
          return false;
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "el-form",
        {
          ref: "brandForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.brandForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "品牌名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "name", $$v)
                  },
                  expression: "brandForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "品牌描述", prop: "describe" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.describe,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "describe", $$v)
                  },
                  expression: "brandForm.describe"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "所属地区", prop: "region" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.brandForm.region,
                  callback: function($$v) {
                    _vm.$set(_vm.brandForm, "region", $$v)
                  },
                  expression: "brandForm.region"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "品牌LOGO" } },
            [
              _c(
                "el-upload",
                {
                  staticClass: "upload-demo",
                  attrs: {
                    action: "",
                    "on-preview": _vm.handlePreview,
                    "on-remove": _vm.handleRemove,
                    "before-remove": _vm.beforeRemove,
                    limit: 1,
                    "file-list": _vm.fileList
                  }
                },
                [
                  _c(
                    "el-button",
                    { attrs: { size: "small", type: "primary" } },
                    [_vm._v("点击上传")]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "el-upload__tip",
                      attrs: { slot: "tip" },
                      slot: "tip"
                    },
                    [_vm._v("只能上传jpg/png文件，且不超过500kb")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "是否启用", prop: "state" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.brandForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.brandForm, "state", $$v)
                    },
                    expression: "brandForm.state"
                  }
                },
                [_vm._v("禁用")]
              ),
              _vm._v(" "),
              _c(
                "el-radio",
                {
                  attrs: { label: "1" },
                  model: {
                    value: _vm.brandForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.brandForm, "state", $$v)
                    },
                    expression: "brandForm.state"
                  }
                },
                [_vm._v("启用")]
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

/***/ "./resources/js/components/pages/goods/BrandAdd.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/pages/goods/BrandAdd.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true& */ "./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true&");
/* harmony import */ var _BrandAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BrandAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BrandAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "8de41c6e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/goods/BrandAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./BrandAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/goods/BrandAdd.vue?vue&type=template&id=8de41c6e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BrandAdd_vue_vue_type_template_id_8de41c6e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);