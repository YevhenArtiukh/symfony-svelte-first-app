<script>
    import {onMount} from 'svelte';
    import {getUsers, deleteUser} from '../../api/users';
    import globalStore from '../../globalStore';
    import User from "./User.svelte";
    import Loading from "../Loading.svelte";

    let users;
    onMount(async () => {
        users = await getUsers();
    })

    async function deleteHandle(id) {
        let res = await deleteUser(id);
        if (res) {
            users = users.filter(user => user.id !== id);
            globalStore.flashOn('success', 'User deleted');
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
        {#if !users}
            <Loading/>
        {:else}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>surname</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                {#each users as user (user.id)}
                    <User {user} {deleteHandle} />
                {/each}
                </tbody>
            </table>
        {/if}
    </div>
</div>