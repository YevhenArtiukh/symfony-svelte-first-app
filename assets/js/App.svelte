<script>
    import { onMount } from 'svelte';

    import Login from './pages/Login.svelte';

    // users CRUD
    import Users from './pages/users/Users.svelte';
    import UserAdd from './pages/users/UserAdd.svelte';
    import UserEdit from './pages/users/UserEdit.svelte';

    // router
    import {navigate, Router, Route, Link} from 'svelte-routing';

    //components
    import Navbar from './components/navbar/Navbar.svelte';

    import Alert from './components/Alert.svelte';

    import globalStore from './globalStore';
    import axios from 'axios';
    import {logoutUser} from './stores/user';
    onMount(() => {
        // console.log(`Hello, Symfony + Svelte!`);
    });

    axios.interceptors.response.use((response) => {
        return response;
    }, (error) => {
        if (error.response.status === 401) {
            logoutUser();
            navigate('/')
        }
    })
</script>


<Router>
    <Navbar />
    <div class="container">
        {#if $globalStore.alert}
            <Alert />
        {/if}
        <Route path="/login" component="{Login}" />
        <Route path="/users" component="{Users}" />
        <Route path="/user/add" component="{UserAdd}" />
        <Route path="/user/:id/edit" component="{UserEdit}" />
    </div>
</Router>

