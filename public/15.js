(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js& ***!
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "SkuEdit",
  data: function data() {
    return {
      skuId: "",
      skuForm: {
        spuId: "",
        name: "",
        brief: "",
        options: [],
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
        }],
        specOption: [{}]
      },
      specList: []
    };
  },
  mounted: function mounted() {
    var that = this,
        spuId = that.$route.query.spuId,
        type = that.$route.query.type;
    that.spuId = spuId;
    that.skuForm.spuId = spuId;
    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/spu/specOptionList?spuId=" + spuId).then(function (res) {
      if (res.data.code === 2000) {
        that.specList = res.data.data;
      }
    }).catch(function (err) {});

    if (type === 'modify') {
      var skuId = that.$route.query.skuId;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/sku/detail?skuId=" + skuId).then(function (res) {
        if (res.data.code === 2000) {
          var data = res.data.data;
          that.skuForm = {
            spuId: data.sku_id,
            name: data.name,
            brief: data.brief,
            originPrice: data.origin_price,
            price: data.price,
            number: data.number,
            state: "" + data.state
          };
        }
      }).catch(function (err) {});
    }
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.skuForm.validate(function (valid) {
        if (valid) {
          var options = [],
              specList = that.specList;
          var _iteratorNormalCompletion = true;
          var _didIteratorError = false;
          var _iteratorError = undefined;

          try {
            for (var _iterator = specList[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
              var spec = _step.value;
              options.push(spec.option);
            }
          } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
          } finally {
            try {
              if (!_iteratorNormalCompletion && _iterator.return != null) {
                _iterator.return();
              }
            } finally {
              if (_didIteratorError) {
                throw _iteratorError;
              }
            }
          }

          that.skuForm.options = options;
          console.info(that.skuForm);
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/sku/create", that.skuForm).then(function (res) {
            if (res.data.code === 2000) {
              // message
              that.$router.push("/spu/detail?spuId=", that.spuId + "&active=" + "sku");
            }
          }).catch(function (err) {});
        } else {
          return false;
        }
      });
    },
    ruleSelect: function ruleSelect(rule, value, callback) {
      if (!value) {
        return callback(new Error('请选择'));
      }

      callback();
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true& ***!
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
            { attrs: { label: "产品名称", prop: "brief" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入产品简述" },
                model: {
                  value: _vm.skuForm.brief,
                  callback: function($$v) {
                    _vm.$set(_vm.skuForm, "brief", $$v)
                  },
                  expression: "skuForm.brief"
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
          _vm._l(_vm.specList, function(spec) {
            return [
              _c(
                "el-form-item",
                {
                  attrs: {
                    label: spec.name,
                    prop: "specOption",
                    rules: { validator: _vm.ruleSelect, trigger: "blur" }
                  }
                },
                [
                  _c(
                    "el-select",
                    {
                      attrs: { placeholder: "请选择" },
                      model: {
                        value: spec.option,
                        callback: function($$v) {
                          _vm.$set(spec, "option", $$v)
                        },
                        expression: "spec.option"
                      }
                    },
                    _vm._l(spec.options, function(option) {
                      return _c("el-option", {
                        key: option.id,
                        attrs: { label: option.name, value: option.id }
                      })
                    }),
                    1
                  )
                ],
                1
              )
            ]
          }),
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
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/pages/goods/SkuEdit.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/pages/goods/SkuEdit.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true& */ "./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true&");
/* harmony import */ var _SkuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SkuEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SkuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7c85fd98",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/SkuEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SkuEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SkuEdit.vue?vue&type=template&id=7c85fd98&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SkuEdit_vue_vue_type_template_id_7c85fd98_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);