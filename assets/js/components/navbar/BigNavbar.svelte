<script>
    import { link } from 'svelte-routing';
    import links from '../../constants/links';
</script>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        {#each links as navLink}
            <li class="nav-item">
                <a href={navLink.url} class="nav-link" use:link>{navLink.text}</a>
            </li>
        {/each}
    </ul>
</nav>