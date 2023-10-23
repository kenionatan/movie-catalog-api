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
/******/ })()
;