<script>
    import dayjs from "dayjs";
    import DatePicker from "svelte-calendar";
    import {onMount} from "svelte";
    import { RouterLink } from 'svelte-easyroute';
    import {getAuthor, editAuthor} from '../../api/authors';
    import globalStore from "../../globalStore";
    import Loading from '../../components/Loading.svelte';

    export let router;

    const id = router.currentRouteData.value.params.id;
    let isLoading = true;
    let name = "";
    let surname = "";
    let dateOfBirth = new Date();
    let isSubmit = false;

    $: isEmpty = !name || !surname;

    onMount(async () => {
        const author = await getAuthor(id);
        name = author.name;
        surname = author.surname;
        dateOfBirth = new Date(author.dateOfBirth);
        isLoading = false;
    })

    async function handleSubmit() {
        isSubmit = true;
        const response = await editAuthor(id, {name, surname, dateOfBirth});

        if (response) {
            router.push('/authors');
            globalStore.flashOn('success', 'Author edited');
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
                <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit}
                        disabled={isEmpty || isSubmit}>
                    {#if isSubmit}
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                    {:else}
                        Zapisz
                    {/if}
                </button>
                <RouterLink to="/authors" class="btn btn-secondary">Powrót</RouterLink>
            </form>
        {/if}
    </div>
</div>

