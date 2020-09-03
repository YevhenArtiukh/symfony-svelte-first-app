<script>
    import {onMount} from 'svelte';
    import getAuthors from '../../api/authors/list';
    import Loading from '../Loading.svelte';
    import Author from './Author.svelte';
    import deleteAuthor from '../../api/authors/delete';
    import globalStore from "../../globalStore";

    let authors = [];
    let isLoading = true;

    onMount(async () => {
        authors = await getAuthors();
        isLoading = false;
    });

    async function deleteHandle(id) {
        let response = await deleteAuthor(id);

        if (response) {
            authors = authors.filter(author => author.id !== id);
            globalStore.toggleItem("alert", true, "Author deleted");
        } else {
            globalStore.toggleItem("alert", true, "Error!", true);
        }
    }
</script>

<div class="card">
    <div class="card-header text-center">
        Authors list
    </div>
    <div class="card-body">
        {#if isLoading}
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