<script>
    import { RouterLink } from 'svelte-easyroute';
    import Users from '../../components/users/Users.svelte';
    import globalStore from '../../globalStore';

    globalStore.pageTitle('Users List');
</script>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <RouterLink to="/user/add" class="btn btn-primary">Create user</RouterLink>
        </li>
    </ul>
</div>

<Users />