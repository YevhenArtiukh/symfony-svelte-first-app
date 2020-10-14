<script>
    import { RouterLink } from 'svelte-easyroute';

    export let book;
    export let deleteHandle;

    const {id, name, authors, count, users} = book;
</script>

<tr>
    <td>{id}</td>
    <td>{name}</td>
    <td>{count}</td>
    <td>
        <RouterLink to="/book/{id}/edit" class="btn btn-info">edit</RouterLink>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>