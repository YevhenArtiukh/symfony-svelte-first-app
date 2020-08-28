<script>
    import login from '../api/login';
    import {navigate} from "svelte-routing";
    import globalStore from "../globalStore";

    let title = 'Login';

    let email = '';
    let password = '';
    let isSubmit = false;

    $: isEmpty = !email || !password;

    async function handleSubmit() {
        isSubmit = true;

        let user = await login({email, password});

        if(user) {
            navigate('/');
        } else {
            globalStore.toggleItem("alert", true, "Error !!!", true);
        }

        isSubmit = false;
    }
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="card">
    <div class="card-header text-center">
        {title}
    </div>
    <div class="card-body">
        <form on:submit|preventDefault={handleSubmit}>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" bind:value={email} class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" id="password" bind:value={password} class="form-control">
                </div>
            </div>
            {#if isEmpty}
                <p class="text-danger">please fill out all form fields</p>
            {/if}
            <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit} disabled={isEmpty || isSubmit}>
                {#if isSubmit}
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                {:else}
                    Login
                {/if}
            </button>
        </form>
    </div>
</div>