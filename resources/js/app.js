require('./bootstrap');

import Vue from 'vue';
/*
*/
import PostsIndex from './vue/postsIndex';
import PostsShow from './vue/postsShow';
import PostsCreate from './vue/postsCreate';

import CategoriesIndex from './vue/categoriesIndex';
import CategoriesShow from './vue/categoriesShow';
import CategoriesCreate from './vue/categoriesCreate';

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect);

const app = new Vue({
    el: '#app',
    components: {
        PostsIndex,
        PostsShow,
        PostsCreate,

        CategoriesIndex,
        CategoriesShow,
        CategoriesCreate
    }
});
