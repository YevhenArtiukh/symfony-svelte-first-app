<script>
    import { RouterLink } from 'svelte-easyroute';

    export let deleteHandle;
    export let user;
    const {id, name, surname, email} = user;
</script>

<tr>
    <td>{id}</td>
    <td>{name}</td>
    <td>{surname}</td>
    <td>{email}</td>
    <td>
        <RouterLink to="/user/{id}/edit" class="btn btn-info">edit</RouterLink>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>
