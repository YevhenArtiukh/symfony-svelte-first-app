<script>
    import DatePicker from "svelte-calendar";
    import dayjs from 'dayjs';
    import { RouterLink } from 'svelte-easyroute';
    import {addAuthor} from '../../api/authors';
    import globalStore from '../../globalStore';

    export let router;
    let name = '';
    let surname = '';
    let dateOfBirth = new Date();
    let isSubmit = false;

    $: isEmpty = !name || !surname;

    async function handleSubmit() {
        isSubmit = true;
        let response = await addAuthor({name, surname, dateOfBirth});

        if(response) {
            router.push('/authors');
            globalStore.flashOn('success', 'Author created');
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
                    <label for="">Date of Birth</label>
                    <div>
                        <DatePicker format={date => dayjs(date).format('DD-MM-YYYY')} bind:selected={dateOfBirth}/>
                    </div>
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
            <RouterLink to="/authors" class="btn btn-secondary">Powrót</RouterLink>
        </form>
    </div>
</div>

