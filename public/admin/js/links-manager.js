(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var LinksManager = function LinksManager() {
  var urls_input = $('input[name=urls]');
  var form = $('form.links-manager');
  var urls_data = urls_input.val();
  var data = JSON.parse(urls_data || '{}');

  var createButton = function createButton() {
    var a = '<a href="#"> <i class="fa fa-link"></i> enlace </a>';
    a = $(a);
    return a;
  };

  var syncJson = function syncJson(json_field, data) {
    var json = JSON.stringify(data);
    urls_input.val(json);
  };

  var update = function update(key, value) {
    data[key] = value;
  };

  var addUrlInput = function addUrlInput(item) {
    var img = $(item).find('img');
    var dataset = img.data();
    var input = $('<input type="url" placeholder="http://" />').css('width', '100%');
    var key = dataset.value;
    var value = data[key];
    input.val(value);

    input.on('change', function (e) {
      update(key, input.val());
      syncJson(urls_input, data);
    });

    img.after(input);
  };

  form.find('.imageThumbnail').each(function (i, item) {
    addUrlInput(item);
  });

  form.on('DOMNodeRemoved', function (event) {
    var item = $(event.target);
    if (item.is('.imageThumbnail')) {
      var img = item.find('img');
      var key = img.data().value;
      if (key) {
        data[key] = undefined;
      }
      syncJson(urls_input, data);
    }
  });

  form.on('DOMNodeInserted', function (event) {
    var item = $(event.target);
    if (item.is('.imageThumbnail')) {
      addUrlInput(item);
    }
  });
};

$(document).ready(function () {
  new LinksManager();
});

exports.default = LinksManager;

},{}]},{},[1]);

//# sourceMappingURL=links-manager.js.map
