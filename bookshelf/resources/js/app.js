require('./bootstrap');

window.Vue = require('vue'); //Vue.jsの読み込み

import VueRouter from 'vue-router'; // Vue Routerの読み込み
Vue.use(VueRouter); // Vue.jsで、Vue Routerを使うように設定

// vue-routerによるルーティング設定
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: require('./components/list.vue'), name: 'list' }, // ルートでアクセスしたら、List.vueを表示
        { path: '/create', component: require('./components/Form.vue'), name: 'create' }, // createにアクセスしたらForm.vueを表示
        { path: '/:id', component: require('./components/Detail.vue'), name: 'detail' }, // id番号でアクセスしたらDetail.vueを表示
    ]
});

// Vueのコンポーネント
Vue.component('navbar', require('./components/Navbar.vue')); //ページ上部にメニューバーを表示させたいので、Navbar.vueを登録

// Vue.jsの実行
const app = new Vue({
    router
}).$mount('#app');
