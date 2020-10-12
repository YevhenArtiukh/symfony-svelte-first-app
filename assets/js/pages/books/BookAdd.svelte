<script>
    import createBook from '../../api/books/create';
    import getAuthors from '../../api/authors/list';
    import globalStore from '../../globalStore';
    import Select from 'svelte-select';
    import {link, navigate} from 'svelte-routing';
    import {onMount} from "svelte";
    import Loading from '../../components/Loading.svelte';

    let title = "Book add";
    let name = "";
    let count = null;
    let items = [];
    let authors = undefined;
    let isSubmit = false;
    let isLoading = true;

    $: isEmpty = !name || !count || !authors;

    onMount(async () => {
        const response = await getAuthors();
        items = response.map((author) => ({value: author.id, label:author.surname+' '+author.name}));
        isLoading = false;
    })

    async function handleSubmit() {
        const book = await createBook({
            name,
            count,
            authors: authors.map((author) => (author.value))
        });

        if(book) {
            navigate('/books')
            globalStore.flashOn('success','Book created');
        } else {
            globalStore.flashOn('error','Error !!!');
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
            <Loading />
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
                        Dodaj
                    {/if}
                </button>
                <a href="/books" class="btn btn-secondary" use:link>Powrót</a>
            </form>
        {/if}
    </div>
</div>