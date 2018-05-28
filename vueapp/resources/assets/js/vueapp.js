/**
 * Created by puppylpy on 2018/5/27.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';

// Telling vue to use the router package, so it can access all the functionalities of the
// router and interpret the route we are about to create
Vue.use(VueRouter);

import App from './components/App';
import Welcome from './components/Welcome';
import Page from './components/Page';

// Defines the routes our application is going to have. Through the application, the routes
// definitions will not be changed, so we have to make them constant.
const router = new VueRouter({
    // this is the mode we want the router to use in managing the navigation of the application.
    // The default mode is hash mode which uses the URL hash to simulate a full URL so that the
    // page won’t be reloaded when the URL changes. The other is history mode, which leverages
    // the history.pushState API to achieve URL navigation without a page reload.
    mode: 'history',
    // the routes we would like our application to have.
    routes: [
        {
            // the url to access this route
            path: '/home',
            // The name we would like to give this route (useful when navigating in-component)
            name: 'welcome',
            // the component we want loaded when this route is visited.
            component: Welcome,
            // we are passing props to the component as we mount them
            props: {title: "This is the SPA home"}
        },
        {
            path: '/spa-page',
            name: 'page',
            component: Page,
            props: {
                title: "This is the SPA second page",
                author: {
                    name: "Fisayo Afolayan",
                    role: "Software Director",
                    code: "Always Keep it clean"
                }
            }
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    router
});