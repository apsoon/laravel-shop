(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! wangeditor */ "./node_modules/wangeditor/release/wangEditor.js");
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(wangeditor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
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
  name: "SpuEdit",
  data: function data() {
    return {
      spuForm: {
        spuId: "",
        name: "",
        categoryId: "",
        brandId: "",
        detailHtml: "",
        detailText: "",
        state: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入商品名称',
          trigger: 'blur'
        }],
        categoryId: [{
          required: true,
          message: '请选择分类',
          trigger: 'blur'
        }]
      },
      categoryList: [],
      category: [],
      categoryProps: {
        value: 'id',
        children: 'children',
        label: 'name'
      },
      brandList: [],
      spuId: "",
      type: "create"
    };
  },
  mounted: function mounted() {
    var that = this; // wangEditor

    var editor = new wangeditor__WEBPACK_IMPORTED_MODULE_0___default.a(that.$refs.editor); //这个地方传入div元素的id 需要加#号

    editor.customConfig.onchange = function (html) {
      that.spuForm.detailHtml = html;
      that.spuForm.detailText = editor.txt.text();
    };

    editor.customConfig.zIndex = 100; // 设置 z-index

    editor.create(); // 生成编辑器
    //

    var type = that.$route.query.type;
    that.type = type;

    if (type === 'modify') {
      var spuId = that.$route.query.spuId;
      that.spuId = spuId;
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/spu/detail?spuId=" + spuId).then(function (res) {
        if (res.data.code === 2000) {
          var data = res.data.data;
          that.spuForm = {
            spuId: data.spu.id,
            name: data.spu.name,
            categoryId: data.spu.category_id,
            brandId: data.spu.brand_id,
            detailHtml: data.detail.html,
            detailText: data.detail.text,
            state: "" + data.spu.state
          };
          editor.txt.html(data.detail.html);
        }
      }).catch(function (err) {});
    }

    axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("category/treeList").then(function (res) {
      if (res.data.code === 2000) {
        that.categoryList = res.data.data;
      }
    }).catch(function (err) {});
    axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("brand/list").then(function (res) {
      if (res.data.code === 2000) {
        that.brandList = res.data.data;
      }
    }).catch(function (err) {});
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.spuForm.validate(function (valid) {
        if (valid) {
          if (that.type === 'modify') {
            axios__WEBPACK_IMPORTED_MODULE_1___default.a.post("/spu/update", that.spuForm).then(function (res) {
              if (res.data.code === 2000) {
                that.$message({
                  type: 'success',
                  message: '修改成功'
                });
                setTimeout(function () {
                  that.$router.push("/spu-list");
                }, 1000);
              }
            }).catch(function (err) {});
          } else {
            axios__WEBPACK_IMPORTED_MODULE_1___default.a.post("spu/create", that.spuForm).then(function (res) {
              if (res.data.code === 2000) {
                that.$message({
                  type: 'success',
                  message: '添加成功!'
                });
                setTimeout(function () {
                  that.$router.push("/spu-list");
                }, 1000);
              }
            }).catch(function (err) {});
          }
        } else {
          return false;
        }
      });
    },
    onCategoryChange: function onCategoryChange() {
      var that = this;
      if (that.category) that.spuForm.categoryId = that.category[that.category.length - 1];
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true& ***!
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
      _c(
        "div",
        { staticClass: "clearfix", attrs: { slot: "header" }, slot: "header" },
        [_c("span", [_vm._v("编辑商品")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "spuForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.spuForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "商品名称", prop: "name" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入商品名称" },
                model: {
                  value: _vm.spuForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.spuForm, "name", $$v)
                  },
                  expression: "spuForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "选择分类", prop: "categoryId" } },
            [
              _c("el-cascader", {
                attrs: {
                  "show-all-levels": false,
                  "expand-trigger": "hover",
                  options: _vm.categoryList,
                  props: _vm.categoryProps,
                  "change-on-select": false,
                  change: _vm.onCategoryChange(),
                  filterable: ""
                },
                model: {
                  value: _vm.category,
                  callback: function($$v) {
                    _vm.category = $$v
                  },
                  expression: "category"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "选择品牌" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选择" },
                  model: {
                    value: _vm.spuForm.brandId,
                    callback: function($$v) {
                      _vm.$set(_vm.spuForm, "brandId", $$v)
                    },
                    expression: "spuForm.brandId"
                  }
                },
                _vm._l(_vm.brandList, function(item) {
                  return _c("el-option", {
                    key: item.id,
                    attrs: { label: item.name, value: item.id }
                  })
                }),
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "商品描述", prop: "detailHtml" } },
            [
              _c("div", {
                ref: "editor",
                staticStyle: { "text-align": "left", width: "100%" }
              })
            ]
          ),
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
                    value: _vm.spuForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.spuForm, "state", $$v)
                    },
                    expression: "spuForm.state"
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
                    value: _vm.spuForm.state,
                    callback: function($$v) {
                      _vm.$set(_vm.spuForm, "state", $$v)
                    },
                    expression: "spuForm.state"
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
            [_vm._v("添加商品")]
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

/***/ "./resources/js/views/pages/goods/SpuEdit.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuEdit.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true& */ "./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true&");
/* harmony import */ var _SpuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SpuEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SpuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "f1a79262",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/SpuEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/SpuEdit.vue?vue&type=template&id=f1a79262&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SpuEdit_vue_vue_type_template_id_f1a79262_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);