<script>
    import dayjs from 'dayjs';
    import { RouterLink } from 'svelte-easyroute';

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
        <RouterLink to="/author/{id}/edit" class="btn btn-info">edit</RouterLink>
        <button class="btn btn-warning" on:click={() => deleteHandle(id)}>delete</button>
    </td>
</tr>