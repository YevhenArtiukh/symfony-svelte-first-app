import Router from "svelte-easyroute";
import globalStore from './globalStore';
import Index from './pages/Index.svelte';
import Login from './pages/Login.svelte';
import Logout from './pages/Logout.svelte';
import NotFound from './pages/NotFound.svelte';

import Users from './pages/users/Users.svelte';
import UserAdd from './pages/users/UserAdd.svelte';
import UserEdit from './pages/users/UserEdit.svelte';

import Authors from './pages/authors/Authors.svelte';
import AuthorAdd from './pages/authors/AuthorAdd.svelte';
import AuthorEdit from './pages/authors/AuthorEdit.svelte';

import Books from './pages/books/Books.svelte';
import BookAdd from './pages/books/BookAdd.svelte';
import BookEdit from './pages/books/BookEdit.svelte';

const router = new Router({
    mode: "history",
    routes: [
        {
            path: "/",
            component: () => import('./pages/Index.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Dashboard');
                next();
            }
        },
        {
            path: "/login",
            meta: {
                layout: 'login'
            },
            component: () => import('./pages/Login.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Login Page');
                next();
            }
        },
        {
            path: "/logout",
            component: () => import('./pages/Logout.svelte'),
            beforeEnter: (to, from, next) => {
                next();
            }
        },
        {
            path: "/users",
            component: () => import('./pages/users/Users.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Users List');
                next();
            }
        },
        {
            path: "/user/add",
            component: () => import('./pages/users/UserAdd.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Create User');
                next();
            }
        },
        {
            path: "/user/:id/edit",
            component: () => import('./pages/users/UserEdit.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Edit User');
                next();
            }
        },
        {
            path: "/authors",
            component: () => import('./pages/authors/Authors.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Authors');
                next();
            }
        },
        {
            path: "/author/add",
            component: () => import('./pages/authors/AuthorAdd.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Author Add');
                next();
            }
        },
        {
            path: "/author/:id/edit",
            component: () => import('./pages/authors/AuthorEdit.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Author Edit');
                next();
            }
        },
        {
            path: "/books",
            component: () => import('./pages/books/Books.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Books');
                next();
            }
        },
        {
            path: "/book/add",
            component: () => import('./pages/books/BookAdd.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Book Add');
                next();
            }
        },
        {
            path: "/book/:id/edit",
            component: () => import('./pages/books/BookEdit.svelte'),
            beforeEnter: (to, from, next) => {
                globalStore.pageTitle('Book Edit');
                next();
            }
        },
        {
            path: "/(.*)",
            component: () => import('./pages/NotFound.svelte'),
            name: "Not found"
        },
    ]
});

export default router;