(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
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
  name: "AdminEdit",
  data: function data() {
    var _this = this;

    var validatePasswordConfirm = function validatePasswordConfirm(rule, value, callback) {
      if (value === '') {
        callback(new Error('请再次输入管理员密码'));
      } else if (value !== _this.adminForm.password) {
        callback(new Error('两次输入密码不一致!'));
      } else {
        callback();
      }
    };

    return {
      adminForm: {
        name: "",
        email: "",
        phone: "",
        password: "",
        confirm: ""
      },
      rules: {
        name: [{
          required: true,
          message: '请输入管理员名称',
          trigger: 'blur'
        }],
        email: [{
          required: true,
          message: '请输入管理员邮箱',
          trigger: 'blur'
        }],
        phone: [{
          required: true,
          message: '请输入管理员电话',
          trigger: 'blur'
        }],
        password: [{
          required: true,
          message: '请输入管理员密码',
          trigger: 'blur'
        }],
        confirm: [{
          validator: validatePasswordConfirm,
          trigger: 'blur'
        }]
      },
      password: "",
      confirm: "",
      type: "create"
    };
  },
  mounted: function mounted() {
    var that = this,
        type = that.$route.query.type;
    that.type = type;
  },
  methods: {
    onCreate: function onCreate() {
      var that = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post("admin/create", that.adminForm).then(function (res) {
        if (res.data.code === 2000) {
          that.$router.push("/admin-list");
        }
      }).catch(function (err) {});
    },
    onUpdate: function onUpdate() {}
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
        [_c("span", [_vm._v("编辑管理员")])]
      ),
      _vm._v(" "),
      _c(
        "el-form",
        {
          ref: "adminForm",
          attrs: {
            rules: _vm.rules,
            model: _vm.adminForm,
            "label-width": "100px"
          }
        },
        [
          _c(
            "el-form-item",
            { attrs: { prop: "name", label: "名称" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入管理员名称" },
                model: {
                  value: _vm.adminForm.name,
                  callback: function($$v) {
                    _vm.$set(_vm.adminForm, "name", $$v)
                  },
                  expression: "adminForm.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { prop: "email", label: "邮箱" } },
            [
              _c("el-input", {
                attrs: { type: "email", placeholder: "请输入管理员邮箱" },
                model: {
                  value: _vm.adminForm.email,
                  callback: function($$v) {
                    _vm.$set(_vm.adminForm, "email", $$v)
                  },
                  expression: "adminForm.email"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { prop: "phone", label: "手机" } },
            [
              _c("el-input", {
                attrs: { type: "tel", placeholder: "请输入管理员电话" },
                model: {
                  value: _vm.adminForm.phone,
                  callback: function($$v) {
                    _vm.$set(_vm.adminForm, "phone", $$v)
                  },
                  expression: "adminForm.phone"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { prop: "password", label: "密码" } },
            [
              _c("el-input", {
                attrs: {
                  type: "password",
                  placeholder: "请输入管理员密码",
                  "show-password": ""
                },
                model: {
                  value: _vm.adminForm.password,
                  callback: function($$v) {
                    _vm.$set(_vm.adminForm, "password", $$v)
                  },
                  expression: "adminForm.password"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { prop: "confirm", label: "确认密码" } },
            [
              _c("el-input", {
                attrs: {
                  type: "password",
                  placeholder: "请再次输入管理员密码",
                  "show-password": ""
                },
                model: {
                  value: _vm.adminForm.confirm,
                  callback: function($$v) {
                    _vm.$set(_vm.adminForm, "confirm", $$v)
                  },
                  expression: "adminForm.confirm"
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _vm.type === "create"
        ? _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onCreate } },
            [_vm._v("立即创建")]
          )
        : _c(
            "el-button",
            { attrs: { type: "primary" }, on: { click: _vm.onUpdate } },
            [_vm._v("修改")]
          )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/pages/permit/AdminEdit.vue":
/*!*******************************************************!*\
  !*** ./resources/js/views/pages/permit/AdminEdit.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true& */ "./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true&");
/* harmony import */ var _AdminEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdminEdit.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdminEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "8e7bf8e2",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/permit/AdminEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pages/permit/AdminEdit.vue?vue&type=template&id=8e7bf8e2&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminEdit_vue_vue_type_template_id_8e7bf8e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);