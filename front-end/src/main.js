import { createApp } from 'vue';
import App from './App.vue';

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

import axios from 'axios';
import VueAxios from 'vue-axios';

import { createRouter, createWebHistory } from 'vue-router';

import DashboardUser from './components/DashboardUser';
import HomePage from './components/HomePage';
import LoginUser from './components/LoginUser';
import RegiterUser from './components/RegisterUser';


const routes = [
   { path: '/', component: HomePage, name: 'home-page' },
   { path: '/login', component: LoginUser, name: 'login' },
   { path: '/register', component: RegiterUser, name: 'resgiter'},
   { path: '/dashboard', component: DashboardUser, name: 'dashboard'},
 ]
 
 const router = createRouter({
   history: createWebHistory(),
   routes, // short for `routes: routes`
 })
 
 const app = createApp(App)
 app.use(VueAxios, axios)
 app.use(router)
 app.mount('#app')
