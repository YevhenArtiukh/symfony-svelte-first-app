<script>
    import {onMount} from 'svelte';
    import getUser from '../../api/users/user';
    import {link, navigate} from 'svelte-routing';
    import editUser from "../../api/users/edit";
    import globalStore from '../../globalStore';
    import Loading from '../../components/Loading.svelte';

    export let id;
    let title = "User edit";

    let isLoading = true;
    let name = "";
    let surname = "";
    let email = "";
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
        let res = await editUser(id, {name, surname, email})

        if (res) {
            navigate('/users')
            globalStore.toggleItem("alert", true, "User edited");
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
                <a href="/users" class="btn btn-secondary" use:link>Powrót</a>
            </form>
        {/if}
    </div>
</div>