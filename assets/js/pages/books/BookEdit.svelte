<script>
    import {onMount} from 'svelte';
    import { RouterLink } from 'svelte-easyroute';
    import {getBook, editBook} from '../../api/books';
    import {getAuthors} from '../../api/authors';
    import globalStore from '../../globalStore';
    import Loading from '../../components/Loading.svelte';
    import Select from "svelte-select";

    export let router;

    const id = router.currentRouteData.value.params.id;
    let isLoading = true;
    let name = "";
    let count = 0;
    let items = [];
    let authors = [];
    let selectAuthors = undefined;
    let isSubmit = false;

    $: isEmpty = !name || !count;

    onMount(async () => {
        const response = await getAuthors();
        items = response.map((author) => ({value: author.id, label: author.surname+' '+author.name}));
        const book = await getBook(id);
        name = book.name;
        count = book.count;
        authors = book.authors.map((author) => ({value: author.id, label: author.surname+' '+author.name}));
        isLoading = false;
    });

    async function handleSubmit() {
        isSubmit = true;
        const response = await editBook(id, {name, count, authors: authors.map((author) => (author.value))});

        if (response) {
            router.push('/books');
            globalStore.flashOn('success', 'Book edited');
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
                        <label for="name">Title</label>
                        <input type="text" id="name" bind:value={name} class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="count">count</label>
                        <input type="number" id="count" bind:value={count} class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Authors</label>
                        <Select {items} bind:selectedValue={authors} isMulti={true} />
                    </div>
                </div>
                {#if isEmpty}
                    <p class="text-danger">please fill out all form fields</p>
                {/if}
                <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit} disabled={isEmpty || isSubmit}>
                    {#if isSubmit}
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                    {:else}
                        Zapisz
                    {/if}
                </button>
                <RouterLink to="/books" class="btn btn-secondary">Powrót</RouterLink>
            </form>
        {/if}
    </div>
</div>