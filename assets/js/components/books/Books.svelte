<script>
    import {onMount} from 'svelte';
    import {getBooks, deleteBook} from '../../api/books';
    import globalStore from '../../globalStore';
    import Book from './Book.svelte';
    import Loading from '../Loading.svelte';

    let books;
    onMount(async () => {
        books = await getBooks();
    })

    async function deleteHandle(id) {
        const response = await deleteBook(id);
        if (response) {
            books = books.filter(book => book.id !== id);
            globalStore.flashOn('success', 'Book deleted');
        } else {
            globalStore.flashOn('error', 'Error !!!');
        }
    }
</script>

<div class="card">
    <div class="card-header text-center">
        {$globalStore.pageTitle}
    </div>
    <div class="card-body">
        {#if !books}
            <Loading />
        {:else}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>count</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                {#each books as book (book.id)}
                    <Book {book} {deleteHandle} />
                {/each}
                </tbody>
            </table>
        {/if}
    </div>
</div>