<script>
    import { onMount } from 'svelte';

    import Users from './pages/users/Users.svelte';
    import UserAdd from './pages/users/UserAdd.svelte';
    import UserEdit from './pages/users/UserEdit.svelte';

    // router
    import {Router, Route, Link} from 'svelte-routing';

    //components
    import Navbar from './components/navbar/Navbar.svelte';

    import Alert from './components/Alert.svelte';

    import globalStore from './globalStore';

    onMount(() => {
        // console.log(`Hello, Symfony + Svelte!`);
    });
</script>

<Router>
    <Navbar />
    <div class="container">
        {#if $globalStore.alert}
            <Alert />
        {/if}
        <Route path="/users" component="{Users}" />
        <Route path="/user/add" component="{UserAdd}" />
        <Route path="/user/:id/edit" component="{UserEdit}" />
    </div>
</Router>

