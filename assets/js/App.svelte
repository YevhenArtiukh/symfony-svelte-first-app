<script>
    import { onMount } from 'svelte';

    import Index from './pages/Index.svelte';
    import Login from './pages/Login.svelte';
    import Logout from './pages/Logout.svelte';
    import NotFound from './pages/NotFound.svelte';

    // users CRUD
    import Users from './pages/users/Users.svelte';
    import UserAdd from './pages/users/UserAdd.svelte';
    import UserEdit from './pages/users/UserEdit.svelte';

    // authors
    import Authors from './pages/authors/Authors.svelte';
    import AuthorAdd from './pages/authors/AuthorAdd.svelte';
    import AuthorEdit from './pages/authors/AuthorEdit.svelte';

    // books
    import Books from './pages/books/Books.svelte';
    import BookAdd from './pages/books/BookAdd.svelte';
    import BookEdit from './pages/books/BookEdit.svelte';

    // router
    import {navigate, Router, Route, Link} from 'svelte-routing';

    //components
    import Navbar from './components/navbar/Navbar.svelte';
    import Alert from './components/Alert.svelte';

    import globalStore from './globalStore';
    import axios from 'axios';
    import {getToken, getRefreshToken, logoutUser} from './stores/user';
    import {refreshToken} from './api/auth';

    // onMount(() => {
    // });
    $: user = $globalStore.auth;

    onMount(() => {
        if(!$globalStore.auth)
            navigate('/login')
    });

    axios.interceptors.response.use((response) => {
        return response;
    }, async (error) => {
        if (error.response.status === 401) {
            if(getRefreshToken()) {
                await refreshToken(getRefreshToken())
                error.config.headers['Authorization'] = 'Bearer ' + getToken();
                error.config.baseURL = undefined;
                return axios.request(error.config);
            } else {
                logoutUser();
                navigate('/login')
            }
        }
    })
</script>

<Router>
    {#if user}
        <Navbar />
    {/if}
    <div class="container">
        {#if $globalStore.alert}
            <Alert />
        {/if}

        <Route path="login" component="{Login}" />

        {#if user}
            <Route path="/" component={Index}/>
            <Route path="logout" component="{Logout}" />

            <Route path="users" component="{Users}" />
            <Route path="user/add" component="{UserAdd}" />
            <Route path="user/:id/edit" component="{UserEdit}" />

            <Route path="authors" component="{Authors}" />
            <Route path="author/add" component="{AuthorAdd}" />
            <Route path="author/:id/edit" component="{AuthorEdit}" />

            <Route path="books" component="{Books}" />
            <Route path="book/add" component="{BookAdd}" />
            <Route path="book/:id/edit" component="{BookEdit}" />
        {/if}
        <Route component="{NotFound}" />
    </div>
</Router>

