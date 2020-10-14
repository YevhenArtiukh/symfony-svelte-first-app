<script>
    import {fly, fade} from 'svelte/transition';
    import globalStore from "../globalStore";
    import {onMount, onDestroy} from "svelte";

    const handleClose = () => {
        globalStore.flashOff();
    }

    let timeout;
    onMount(() => {
        timeout = setTimeout(() => {
            globalStore.flashOff();
        }, 3000);
    });

    onDestroy(() => {
        clearTimeout(timeout);
    });
</script>

<div class="alert alert-success alert-dismissible fade show"
     class:alert-danger={$globalStore.flashType === 'error'}
     class:alert-success={$globalStore.flashType === 'success'} role="alert" transition:fly={{y: -200, duration: 1000}}>
    {$globalStore.flashMessage}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
