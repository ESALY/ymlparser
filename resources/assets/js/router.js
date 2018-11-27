import Home from './components/Home';
import Dialogs from './components/Dialogs';

const routes = [
    { path: '/mobile', component: Home},
    { path: '/mobile/dialogs', component: Dialogs}
    //{ path: '/mobile/dialogs:foo', name: 'newLocation', component: Dialogs}
];

import VueRouter from 'vue-router';

//this.$router.push({name: 'newLocation', params: { foo: "bar"}});
//this.$router.push({path: '/newLocation/bar'});

export default new VueRouter({
    routes,
    mode: 'history'
})