<script>
    import createUser from '../../api/users/create';
    import globalStore from '../../globalStore';

    import {link, navigate} from 'svelte-routing';

    let title = "User add";
    let name = "";
    let surname = "";
    let email = "";
    let password = "";
    let isSubmit = false;

    $: isEmpty = !name || !surname || !email || !password;

    async function handleSubmit() {
        isSubmit = true;
        let user = await createUser({name, surname, email, password});

        if (user) {
            navigate('/users')
            globalStore.toggleItem("alert", true, "User created");
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
                    <label for="name">Name</label>
                    <input type="text" id="name" bind:value={name} class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" bind:value={surname} class="form-control">
                </div>
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
                    Dodaj
                {/if}
            </button>
            <a href="/users" class="btn btn-secondary" use:link>Powrót</a>
        </form>
    </div>
</div>