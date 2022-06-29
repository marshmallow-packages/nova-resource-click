let mix = require('laravel-mix');
let path = require('path');

require('./mix');

mix.setPublicPath('dist').js('resources/js/tool.js', 'js').vue({ version: 3 }).nova('marshmallow/nova-sortable');

mix.alias({
  'laravel-nova': path.join(__dirname, 'vendor/laravel/nova/resources/js/mixins/packages.js'),
  '@': path.join(__dirname, 'resources/js/'),
});
