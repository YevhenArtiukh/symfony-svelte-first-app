<script>
    import { onMount } from 'svelte';

    //components
    import Navbar from './components/navbar/Navbar.svelte';
    import Flash from './components/Flash.svelte';

    import globalStore from './globalStore';
    import axios from 'axios';
    import {refreshToken} from './api/auth';

    import { EasyrouteProvider, RouterOutlet, RouterLink } from 'svelte-easyroute';
    export let router;

    $: user = $globalStore.auth;

    onMount(() => {
        if(!$globalStore.auth) {
            router.push('/login');
        }
    });

    axios.interceptors.response.use((response) => {
        return response;
    }, async (error) => {
        if (error.response.status === 401) {
            if(globalStore.getRefreshToken()) {
                await refreshToken(globalStore.getRefreshToken())
                error.config.headers['Authorization'] = 'Bearer ' + globalStore.getToken();
                error.config.baseURL = undefined;
                return axios.request(error.config);
            } else {
                globalStore.logout();
                router.push('/login');
            }
        }
    });
</script>

<svelte:head>
    <title>{$globalStore.pageTitle}</title>
</svelte:head>

<EasyrouteProvider {router}>
    {#if user}
        <Navbar />
    {/if}
    <div class="container">
        {#if $globalStore.flash}
            <Flash />
        {/if}
        <RouterOutlet />
    </div>
</EasyrouteProvider>
