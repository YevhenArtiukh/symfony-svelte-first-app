<script>
    import {link} from "svelte-routing";
    import Books from '../../components/books/Books.svelte';

    let title = "Books list";
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="mt-4 mb-4">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href="/book/add" class="btn btn-primary" use:link>Create user</a>
        </li>
    </ul>
</div>

<Books />