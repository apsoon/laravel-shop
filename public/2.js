(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "AdAdd",
  data: function data() {
    return {
      adForm: {
        name: '',
        desc: '',
        sort_order: 1,
        state: "0",
        position: ""
      },
      rules: {
        name: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }, {
          min: 3,
          max: 5,
          message: '长度在 3 到 5 个字符',
          trigger: 'blur'
        }]
      }
    };
  },
  mounted: function mounted() {
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("adPosition/list").then(function (res) {});
  },
  methods: {
    onSubmit: function onSubmit() {
      var _this = this;

      this.$refs["adForm"].validate(function (valid) {
        if (valid) {
          console.info(_this.adForm);
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("ad/create").then(function (res) {
            console.info(res);
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
          ref: "adForm",
          attrs: { rules: _vm.rules, model: _vm.adForm, "label-width": "100px" }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "广告名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.adForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.adForm, "name", $$v)
                  },
                  expression: "adForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "广告描述" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.adForm.desc,
                  callback: function($$v) {
                    _vm.$set(_vm.adForm, "desc", $$v)
                  },
                  expression: "adForm.desc"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "广告位置" } },
            [
              _c(
                "el-dropdown",
                [
                  _c(
                    "el-button",
                    { attrs: { type: "primary", size: "small" } },
                    [
                      _vm._v("\n                    请选择"),
                      _c("i", {
                        staticClass: "el-icon-arrow-down el-icon--right"
                      })
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "el-dropdown-menu",
                    { attrs: { slot: "dropdown" }, slot: "dropdown" },
                    [
                      _c(
                        "el-dropdown-item",
                        {
                          model: {
                            value: _vm.adForm.position,
                            callback: function($$v) {
                              _vm.$set(_vm.adForm, "position", $$v)
                            },
                            expression: "adForm.position"
                          }
                        },
                        [_vm._v("黄金糕")]
                      ),
                      _vm._v(" "),
                      _c("el-dropdown-item", [_vm._v("狮子头")]),
                      _vm._v(" "),
                      _c("el-dropdown-item", [_vm._v("螺蛳粉")]),
                      _vm._v(" "),
                      _c("el-dropdown-item", [_vm._v("双皮奶")]),
                      _vm._v(" "),
                      _c("el-dropdown-item", [_vm._v("蚵仔煎")])
                    ],
                    1
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
            { attrs: { label: "排序" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.adForm.sort_order,
                  callback: function($$v) {
                    _vm.$set(_vm.adForm, "sort_order", $$v)
                  },
                  expression: "adForm.sort_order"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "添加图片" } },
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
            { attrs: { label: "是否启用" } },
            [
              _c(
                "el-radio",
                {
                  attrs: { label: "0" },
                  model: {
                    value: _vm.adForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.adForm, "state", $$v)
                    },
                    expression: "adForm.state"
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
                    value: _vm.adForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.adForm, "state", $$v)
                    },
                    expression: "adForm.state"
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

/***/ "./resources/js/components/pages/ad/AdAdd.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/pages/ad/AdAdd.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdAdd.vue?vue&type=template&id=04377ee8&scoped=true& */ "./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true&");
/* harmony import */ var _AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdAdd.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "04377ee8",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/ad/AdAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdAdd.vue?vue&type=template&id=04377ee8&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/ad/AdAdd.vue?vue&type=template&id=04377ee8&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_04377ee8_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);