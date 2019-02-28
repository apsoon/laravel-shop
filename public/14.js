(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../router */ "./resources/js/router.js");
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
  name: "CategoryEdit",
  data: function data() {
    return {
      categoryForm: {
        id: "",
        name: "",
        parentId: 0,
        sortOrder: 0,
        imageUrl: "",
        isRecom: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入商品名称',
          trigger: 'blur'
        }]
      },
      parentId: 0,
      parentName: "",
      uploadHeader: {},
      imageList: [],
      uploadData: {
        type: "logo",
        position: "category"
      },
      type: "crate",
      categoryId: ""
    };
  },
  mounted: function mounted() {
    var that = this,
        type = that.$route.query.type;
    that.type = type;

    if (type === "create") {
      that.parentId = that.$route.query.parentId;
      that.parentName = that.$route.query.parentName;
    } else {
      var categoryId = that.$route.query.categoryId;
      that.categoryId = categoryId;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/category/detail?id=" + categoryId).then(function (res) {
        if (res.data.code === 2000) {
          var data = res.data.data;
          that.categoryForm = {
            id: data.id,
            name: data.name,
            parentId: data.parent_id,
            sortOrder: data.sort_order,
            imageUrl: data.image_url
          };
        }
      }).catch(function (err) {});
    }

    that.uploadHeader = {
      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
    };
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs.categoryForm.validate(function (valid) {
        if (valid) {
          if (that.type === "create") {
            that.categoryForm.parentId = that.parentId;
            axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("category/create", that.categoryForm).then(function (res) {
              if (res.data.code === 2000) {
                _router__WEBPACK_IMPORTED_MODULE_1__["default"].push("/category-list");
              }
            }).catch(function (err) {});
          } else {
            axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("/category/update", that.categoryForm).then(function (res) {
              if (res.data.code === 2000) {
                _router__WEBPACK_IMPORTED_MODULE_1__["default"].push("/category-list");
              }
            }).catch(function (err) {});
          }
        }
      });
    },
    handleTreeClick: function handleTreeClick(data, checked, node) {
      var that = this;
      console.info("data = ", data, ", checked = ", checked, ", node = ", node);

      if (checked) {
        this.$refs.treeCategory.setCheckedNodes([]);
        this.$refs.treeCategory.setCheckedNodes([data]);
      }
    },
    onUploadSuccess: function onUploadSuccess(response, file, fileList) {
      var that = this;

      if (response.code === 2000) {
        var categoryForm = that.categoryForm;
        categoryForm.imageUrl = response.data.filePath;
        that.categoryForm = categoryForm;
      }
    },
    onUploadFailed: function onUploadFailed(err, file, fileList) {// TODO 上传失败
    },
    onUploadFileRemoved: function onUploadFileRemoved(file, fileList) {
      var that = this; // TODO 删除文件

      var categoryForm = that.categoryForm;
      categoryForm.imageUrl = "";
      that.categoryForm = categoryForm;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("分类编辑")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "categoryForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.categoryForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { label: "分类名称", prop: "name" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.categoryForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.categoryForm, "name", $$v)
                  },
                  expression: "categoryForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c("el-form-item", { attrs: { label: "上级分类" } }, [
            _c("label", [_vm._v(_vm._s(_vm.parentName))])
          ]),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "排序优先级", prop: "sortOrder" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.categoryForm.sortOrder,
                  callback: function($$v) {
                    _vm.$set(_vm.categoryForm, "sortOrder", $$v)
                  },
                  expression: "categoryForm.sortOrder"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _vm.parentId === "0"
            ? _c(
                "el-form-item",
                { attrs: { label: "首页热推", prop: "isRecom" } },
                [
                  _c(
                    "el-radio",
                    {
                      attrs: { label: "0" },
                      model: {
                        value: _vm.categoryForm.isRecom,
                        callback: function($$v) {
                          _vm.$set(_vm.categoryForm, "isRecom", $$v)
                        },
                        expression: "categoryForm.isRecom"
                      }
                    },
                    [_vm._v("否")]
                  ),
                  _vm._v(" "),
                  _c(
                    "el-radio",
                    {
                      attrs: { label: "1" },
                      model: {
                        value: _vm.categoryForm.isRecom,
                        callback: function($$v) {
                          _vm.$set(_vm.categoryForm, "isRecom", $$v)
                        },
                        expression: "categoryForm.isRecom"
                      }
                    },
                    [_vm._v("是")]
                  )
                ],
                1
              )
            : _vm._e(),
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
                    action: "/upload/image",
                    headers: _vm.uploadHeader,
                    "on-success": _vm.onUploadSuccess,
                    "on-error": _vm.onUploadFailed,
                    "on-remove": _vm.onUploadFileRemoved,
                    limit: 1,
                    data: _vm.uploadData,
                    "file-list": _vm.imageList,
                    "list-type": "picture-card"
                  }
                },
                [
                  _c("i", { staticClass: "el-icon-plus" }),
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
                ]
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.type === "create"
            ? _c(
                "el-button",
                {
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.onSubmit("create")
                    }
                  }
                },
                [_vm._v("立即创建")]
              )
            : _c(
                "el-button",
                {
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.onSubmit("update")
                    }
                  }
                },
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

/***/ "./resources/js/views/pages/goods/CategoryEdit.vue":
/*!*********************************************************!*\
  !*** ./resources/js/views/pages/goods/CategoryEdit.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true& */ "./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true&");
/* harmony import */ var _CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CategoryEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1ec2caea",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/goods/CategoryEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/goods/CategoryEdit.vue?vue&type=template&id=1ec2caea&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_1ec2caea_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);