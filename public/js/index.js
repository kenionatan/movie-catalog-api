/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
$(function () {
  $.ajax({
    url: '/api/movie/get',
    type: 'GET',
    dataType: 'json',
    success: function success(data) {
      $('.movie-content').html(JSON.stringify(data));
    }
  });
});
$('#register_user').on('submit', function (e) {
  e.preventDefault();
  var formData = {
    name: $('#name').val(),
    email: $('#email').val(),
    password: $('#password').val()
  };
  $.ajax({
    url: '/api/user/register',
    type: 'POST',
    data: formData,
    dataType: 'json',
    success: function success(response) {
      $('#registerModal').hide();
    },
    error: function error(xhr, status, _error) {
      // Handle errors, such as validation errors or registration failure
    }
  });
});
/******/ })()
;