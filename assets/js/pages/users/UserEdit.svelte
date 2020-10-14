<script>
    import { RouterLink } from "svelte-easyroute";
    import {onMount} from 'svelte';
    import {getUser, editUser} from '../../api/users';
    import globalStore from '../../globalStore';
    import Loading from '../../components/Loading.svelte';

    export let router;

    let id = router.currentRouteData.value.params.id;
    let name = "";
    let surname = "";
    let email = "";
    let isLoading = true;
    let isSubmit = false;

    $: isEmpty = !name || !surname || !email;

    onMount(async () => {
        const user = await getUser(id);
        name = user.name;
        surname = user.surname;
        email = user.email;
        isLoading = false;
    });

    async function handleSubmit() {
        isSubmit = true;
        const response = await editUser(id, {name, surname, email})

        if (response) {
            router.push('/users');
            globalStore.flashOn('success', 'User edited');
        } else {
            globalStore.flashOn('error', 'Error !!!');
        }
        isSubmit = false;
    }
</script>

<div class="card">
    <div class="card-header text-center">
        {$globalStore.pageTitle}
    </div>
    <div class="card-body">
        {#if isLoading}
            <Loading/>
        {:else}
            <form on:submit|preventDefault={handleSubmit}>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">name</label>
                        <input type="text" id="name" bind:value={name} class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">surname</label>
                        <input type="text" id="surname" bind:value={surname} class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" id="email" bind:value={email} class="form-control">
                </div>
                {#if isEmpty}
                    <p class="text-danger">please fill out all form fields</p>
                {/if}
                <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit}
                        disabled={isEmpty || isSubmit}>
                    {#if isSubmit}
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                    {:else}
                        Zapisz
                    {/if}
                </button>
                <RouterLink to="/users" class="btn btn-secondary">Powrót</RouterLink>
            </form>
        {/if}
    </div>
</div>