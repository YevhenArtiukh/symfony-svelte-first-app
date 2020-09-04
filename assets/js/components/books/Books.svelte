<script>
    import {onMount} from 'svelte';
    import getBooks from '../../api/books/list';
    import deleteBook from '../../api/books/delete';
    import Book from './Book.svelte';
    // import getUsers from '../../api/users/list';
    // import deleteUser from '../../api/users/delete';
    // import User from "./User.svelte";
    import globalStore from '../../globalStore';
    import Loading from '../Loading.svelte';
    import {navigate} from "svelte-routing";

    let books = [];
    let isLoading = true;

    onMount(async () => {
        books = await getBooks();
        isLoading = false;
    })

    async function deleteHandle(id) {
        let res = await deleteBook(id);
        if (res) {
            books = books.filter(book => book.id !== id);
            globalStore.toggleItem("alert", true, "Book deleted");
        } else {
            globalStore.toggleItem("alert", true, "Error!", true);
        }
    }
</script>

<div class="card">
    <div class="card-header text-center">
        Books list
    </div>
    <div class="card-body">
        {#if isLoading}
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