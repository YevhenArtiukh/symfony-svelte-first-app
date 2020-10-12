<script>
    import {onMount} from 'svelte';
    import getAuthors from '../../api/authors/list';
    import getBook from '../../api/books/book';
    import {link, navigate} from 'svelte-routing';
    import editBook from '../../api/books/edit'
    import globalStore from '../../globalStore';
    import Loading from '../../components/Loading.svelte';
    import Select from "svelte-select";

    export let id;
    let title = 'Book edit';

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
        let res = await editBook(id, {name, count, authors: authors.map((author) => (author.value))});

        if (res) {
            navigate('/books');
            globalStore.toggleItem("alert", true, "Book edited");
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
                <a href="/books" class="btn btn-secondary" use:link>Powrót</a>
            </form>
        {/if}
    </div>
</div>