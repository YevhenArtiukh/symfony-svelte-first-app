import Router from "svelte-easyroute";
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
            component: Index
        },
        {
            path: "/login",
            component: Login,
            beforeEnter: (to, from, next) => {
                next();
            }
        },
        {
            path: "/logout",
            component: Logout,
            beforeEnter: (to, from, next) => {
                next();
            }
        },
        {
            path: "/users",
            component: Users,
        },
        {
            path: "/user/add",
            component: UserAdd,
        },
        {
            path: "/user/:id/edit",
            component: UserEdit,
        },
        {
            path: "/authors",
            component: Authors,
        },
        {
            path: "/author/add",
            component: AuthorAdd,
        },
        {
            path: "/author/:id/edit",
            component: AuthorEdit,
        },
        {
            path: "/books",
            component: Books,
        },
        {
            path: "/book/add",
            component: BookAdd,
        },
        {
            path: "/book/:id/edit",
            component: BookEdit,
        },
        // {
        //     path: "*",
        //     component: NotFound,
        //     name: "Not found"
        // },
    ]
});

export default router;