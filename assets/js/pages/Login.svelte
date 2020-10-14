<script>
    import {onMount} from 'svelte';
    import {loginUser} from '../api/auth';
    import globalStore from "../globalStore";

    export let router;

    let email = '';
    let password = '';
    let isSubmit = false;

    $: isEmpty = !email || !password;

    onMount(() => {
        if($globalStore.auth)
            router.push('/');
    })

    async function handleSubmit() {
        isSubmit = true;

        await loginUser({email, password})
            .then(() => router.push('/'))
            .catch(() => globalStore.flashOn('error', 'Error !!!'));

        isSubmit = false;
    }
</script>

<svelte:head>
    <style>
        body {
            height: 100vh;
            padding: 0;
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
        }
    </style>
</svelte:head>

<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-auto">
        <div class="card card-signin">
            <div class="card-header text-center">
                {$globalStore.pageTitle}
            </div>
            <div class="card-body">
                <form class="form-signin" on:submit|preventDefault={handleSubmit}>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" bind:value={email} class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" bind:value={password} class="form-control">
                    </div>

                    {#if isEmpty}
                        <p class="text-danger">please fill out all form fields</p>
                    {/if}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit} disabled={isEmpty || isSubmit}>
                            {#if isSubmit}
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                            {:else}
                                Login
                            {/if}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
