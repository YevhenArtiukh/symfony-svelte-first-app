<script>
    import dayjs from 'dayjs';
    import {link} from "svelte-routing";
    export let author;
    export let deleteHandle;
    const {id, name, surname, dateOfBirth} = author;
</script>

<tr>
    <td>{id}</td>
    <td>{name}</td>
    <td>{surname}</td>
    <td>{dayjs(dateOfBirth).format('DD-MM-YYYY')}</td>
    <td>
        <a href={`author/${id}/edit`} class="btn btn-info" use:link>edit</a>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>