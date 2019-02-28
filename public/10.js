(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
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
    // let uploadValidator = function (rule, value, callback) {
    //     let adForm = this.adForm;
    //     console.info(adForm);
    //     if (adForm.imageUrl.length <= 0) {
    //         callback(new Error('请上传广告图片'));
    //     }
    //     callback();
    // };
    return {
      adForm: {
        name: '',
        content: '',
        sortOrder: 1,
        state: "0",
        positionId: "",
        imageUrl: "",
        isJump: "0"
      },
      rules: {
        name: [{
          required: true,
          message: '请输入广告名称',
          trigger: 'blur'
        }],
        positionId: [{
          required: true,
          message: '请选择广告位置',
          trigger: 'change'
        }],
        imageList: [// {required: true, message: '请上传广告图片', trigger: 'change'}
        ]
      },
      positionList: [],
      uploadHeader: {},
      imageList: [],
      uploadData: {
        type: "ad",
        position: "banner"
      },
      type: "create"
    };
  },
  mounted: function mounted() {
    var that = this;
    that.uploadHeader = {
      'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
    };
    var type = that.$route.query.type;

    if (type === "modify") {
      console.info(type);
      that.type = type;
      var adId = that.$route.query.adId;
      that.adId = adId;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("/ad/detail?adId=" + adId).then(function (res) {
        if (res.data.code === 2000) {
          var data = res.data.data;
          that.adForm = {
            id: data.id,
            name: data.name,
            content: data.content,
            sortOrder: data.sort_order,
            state: "" + data.state,
            positionId: data.position_id,
            imageUrl: data.image_url
          };
        }
      }).catch(function (err) {});
    }

    axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("adPos/list").then(function (res) {
      that.positionList = res.data.data;
      console.info(that.positionList);
    });
  },
  methods: {
    onSubmit: function onSubmit() {
      var that = this;
      that.$refs["adForm"].validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("ad/create", that.adForm).then(function (res) {
            if (res.data.code === 2000) {
              _router__WEBPACK_IMPORTED_MODULE_1__["default"].push("ad-list");
            }
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    onUpdate: function onUpdate() {
      var that = this;
      that.$refs["adForm"].validate(function (valid) {
        if (valid) {
          axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("ad/update", that.adForm).then(function (res) {
            if (res.data.code === 2000) {
              _router__WEBPACK_IMPORTED_MODULE_1__["default"].push("ad-list");
            }
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    onUploadSuccess: function onUploadSuccess(response, file, fileList) {
      var that = this;

      if (response.code === 2000) {
        var adForm = that.adForm;
        adForm.imageUrl = response.data.filePath;
        that.adForm = adForm;
      }
    },
    onUploadFailed: function onUploadFailed(err, file, fileList) {},
    onUploadFileRemoved: function onUploadFileRemoved(file, fileList) {
      var that = this; // TODO 删除文件

      var adForm = that.adForm;
      adForm.imageUrl = "";
      that.adForm = adForm;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("编辑广告")])]
      ),
      _vm._v(" "),
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
                attrs: { span: 3, placeholder: "请输入广告名称" },
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
            { attrs: { label: "广告描述", prop: "content" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入广告描述" },
                model: {
                  value: _vm.adForm.content,
                  callback: function($$v) {
                    _vm.$set(_vm.adForm, "content", $$v)
                  },
                  expression: "adForm.content"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "广告位置", prop: "positionId" } },
            [
              _c(
                "el-select",
                {
                  attrs: { placeholder: "请选广告位置" },
                  model: {
                    value: _vm.adForm.positionId,
                    callback: function($$v) {
                      _vm.$set(_vm.adForm, "positionId", $$v)
                    },
                    expression: "adForm.positionId"
                  }
                },
                _vm._l(_vm.positionList, function(item) {
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
            { attrs: { label: "排序优先级", prop: "sortOrder" } },
            [
              _c("el-input", {
                model: {
                  value: _vm.adForm.sortOrder,
                  callback: function($$v) {
                    _vm.$set(_vm.adForm, "sortOrder", $$v)
                  },
                  expression: "adForm.sortOrder"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "添加图片", prop: "imageList" } },
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
          _c(
            "el-form-item",
            { attrs: { label: "是否启用", prop: "state" } },
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
          _vm.type === "create"
            ? _c(
                "el-button",
                { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
                [_vm._v("立即创建")]
              )
            : _c(
                "el-button",
                { attrs: { type: "primary" }, on: { click: _vm.onUpdate } },
                [_vm._v("立即修改")]
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

/***/ "./resources/js/views/pages/ad/AdAdd.vue":
/*!***********************************************!*\
  !*** ./resources/js/views/pages/ad/AdAdd.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdAdd.vue?vue&type=template&id=2417969c&scoped=true& */ "./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true&");
/* harmony import */ var _AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdAdd.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "2417969c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/ad/AdAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/ad/AdAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true&":
/*!******************************************************************************************!*\
  !*** ./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdAdd.vue?vue&type=template&id=2417969c&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/ad/AdAdd.vue?vue&type=template&id=2417969c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdAdd_vue_vue_type_template_id_2417969c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);