<script>
    import {onMount} from 'svelte';
    import {getAuthors, deleteAuthor} from '../../api/authors';
    import globalStore from "../../globalStore";
    import Loading from '../Loading.svelte';
    import Author from './Author.svelte';

    let authors;
    onMount(async () => {
        authors = await getAuthors();
    });

    async function deleteHandle(id) {
        const response = await deleteAuthor(id);

        if (response) {
            authors = authors.filter(author => author.id !== id);
            globalStore.flashOn('success', 'Author deleted');
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
        {#if !authors}
            <Loading/>
        {:else}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>surname</th>
                    <th>birth</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                {#each authors as author (author.id)}
                    <Author {author} {deleteHandle}/>
                {/each}
                </tbody>
            </table>
        {/if}
    </div>
</div>