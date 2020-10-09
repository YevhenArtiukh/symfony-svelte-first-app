<script>
    import {link} from 'svelte-routing';
    export let book;
    export let deleteHandle;

    const {id, name, authors, count, users} = book;
</script>

<tr>
    <td>{id}</td>
    <td>{name}</td>
    <td>{count}</td>
    <td>
        <a href={`book/${id}/edit`} class="btn btn-info" use:link>edit</a>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>