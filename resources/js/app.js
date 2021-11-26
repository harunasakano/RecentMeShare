/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import { createApp } from "vue/dist/vue.esm-bundler.js";

import router from "./router/index";
import Vuex from "./store/index";
import App from "./App.vue";
import VueClipboard from "vue-clipboard2";

const app = createApp(App);
app.use(router);
app.use(Vuex);
app.use(VueClipboard);
app.mount("#app");
app.component("App");
