<script>
    import { RouterLink } from 'svelte-easyroute';
    import Books from '../../components/books/Books.svelte';
</script>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <RouterLink to="/book/add" class="btn btn-primary">Create book</RouterLink>
        </li>
    </ul>
</div>

<Books />