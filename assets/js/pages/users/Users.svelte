<script>
    import {link} from "svelte-routing";
    import Users from '../../components/users/Users.svelte';

    let title = "Users list";
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href='/user/add' class="btn btn-primary" use:link>Create user</a>
        </li>
    </ul>
</div>

<Users />