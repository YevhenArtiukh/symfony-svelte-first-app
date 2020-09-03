<script>
    import {onMount} from 'svelte';
    import getUsers from '../../api/users/list';
    import deleteUser from '../../api/users/delete';
    import User from "./User.svelte";
    import globalStore from '../../globalStore';
    import Loading from '../Loading.svelte';
    import {navigate} from "svelte-routing";

    let users = [];
    let isLoading = true;

    onMount(async () => {
        users = await getUsers();
        isLoading = false;
    })

   async function deleteHandle(id) {
        let res = await deleteUser(id);
        if (res) {
            users = users.filter(user => user.id !== id);
            globalStore.toggleItem("alert", true, "User deleted");
        } else {
            globalStore.toggleItem("alert", true, "Error!", true);
        }
    }
</script>

<div class="card">
    <div class="card-header text-center">
        Users list
    </div>
    <div class="card-body">
        {#if isLoading}
            <Loading />
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