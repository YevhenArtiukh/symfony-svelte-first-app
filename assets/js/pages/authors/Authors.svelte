<script>
    import {link} from 'svelte-routing';
    import Authors from '../../components/authors/Authors.svelte';

    let title = 'Authors list';
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href="/author/add" class="btn btn-primary" use:link>Create author</a>
        </li>
    </ul>
</div>

<Authors />