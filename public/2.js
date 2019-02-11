(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/ad/AdAdd.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  name: "AdAdd"
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
        { ref: "form", attrs: { model: _vm.form, "label-width": "80px" } },
        [
          _c(
            "el-form-item",
            { attrs: { label: "活动名称" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.form.name,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "name", $$v)
                  },
                  expression: "form.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "活动区域" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择活动区域" },
                  model: {
                    value: _vm.form.region,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "region", $$v)
                    },
                    expression: "form.region"
                  }
                },
                [
                  _c("el-option", {
                    attrs: { label: "区域一", value: "shanghai" }
                  }),
                  _vm._v(" "),
                  _c("el-option", {
                    attrs: { label: "区域二", value: "beijing" }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "活动时间" } },
            [
              _c(
                "el-col",
                { attrs: { span: 11 } },
                [
                  _c("el-date-picker", {
                    staticStyle: { width: "100%" },
                    attrs: { type: "date", placeholder: "选择日期" },
                    model: {
                      value: _vm.form.date1,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "date1", $$v)
                      },
                      expression: "form.date1"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("el-col", { staticClass: "line", attrs: { span: 2 } }, [
                _vm._v("-")
              ]),
              _vm._v(" "),
              _c(
                "el-col",
                { attrs: { span: 11 } },
                [
                  _c("el-time-picker", {
                    staticStyle: { width: "100%" },
                    attrs: { type: "fixed-time", placeholder: "选择时间" },
                    model: {
                      value: _vm.form.date2,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "date2", $$v)
                      },
                      expression: "form.date2"
                    }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "即时配送" } },
            [
              _c("el-switch", {
                model: {
                  value: _vm.form.delivery,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "delivery", $$v)
                  },
                  expression: "form.delivery"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "活动性质" } },
            [
              _c(
                "el-checkbox-group",
                {
                  model: {
                    value: _vm.form.type,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "type", $$v)
                    },
                    expression: "form.type"
                  }
                },
                [
                  _c("el-checkbox", {
                    attrs: { label: "美食/餐厅线上活动", name: "type" }
                  }),
                  _vm._v(" "),
                  _c("el-checkbox", {
                    attrs: { label: "地推活动", name: "type" }
                  }),
                  _vm._v(" "),
                  _c("el-checkbox", {
                    attrs: { label: "线下主题活动", name: "type" }
                  }),
                  _vm._v(" "),
                  _c("el-checkbox", {
                    attrs: { label: "单纯品牌曝光", name: "type" }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "特殊资源" } },
            [
              _c(
                "el-radio-group",
                {
                  model: {
                    value: _vm.form.resource,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "resource", $$v)
                    },
                    expression: "form.resource"
                  }
                },
                [
                  _c("el-radio", { attrs: { label: "线上品牌商赞助" } }),
                  _vm._v(" "),
                  _c("el-radio", { attrs: { label: "线下场地免费" } })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "活动形式" } },
            [
              _c("el-input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.form.desc,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "desc", $$v)
                  },
                  expression: "form.desc"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            [
              _c(
                "el-button",
                { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
                [_vm._v("立即创建")]
              ),
              _vm._v(" "),
              _c("el-button", [_vm._v("取消")])
            ],
            1
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