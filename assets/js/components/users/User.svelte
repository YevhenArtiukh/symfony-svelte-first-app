<script>
    import {link} from "svelte-routing";

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
        <a href={`user/${id}/edit`} class="btn btn-info" use:link>edit</a>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>
