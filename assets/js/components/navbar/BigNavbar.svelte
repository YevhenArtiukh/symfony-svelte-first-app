<script>
    import { RouterLink } from 'svelte-easyroute';
</script>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <li>
            <RouterLink to='/' class="nav-link">dashboard</RouterLink>
        </li>
        <li>
            <RouterLink to='/users' class="nav-link">users</RouterLink>
        </li>
        <li>
            <RouterLink to='/authors' class="nav-link">authors</RouterLink>
        </li>
        <li>
            <RouterLink to='/books' class="nav-link">books</RouterLink>
        </li>
        <li>
            <RouterLink to='/logout' class="nav-link">logout</RouterLink>
        </li>
    </ul>
</nav>
