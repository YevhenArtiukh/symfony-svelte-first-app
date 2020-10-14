<script>
    import { RouterLink } from 'svelte-easyroute';
    import Authors from '../../components/authors/Authors.svelte';
</script>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <RouterLink to="/author/add" class="btn btn-primary">Create author</RouterLink>
        </li>
    </ul>
</div>

<Authors />