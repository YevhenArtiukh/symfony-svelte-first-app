<script>
    import {fly, fade} from 'svelte/transition';
    import globalStore from "../globalStore";
    import {onMount, onDestroy} from "svelte";

    const handleClose = () => {
        globalStore.toggleItem('alert', false)
    }

    let timeout;
    onMount(() => {
        timeout = setTimeout(() => {
            globalStore.toggleItem('alert', false)
        }, 3000);
    });

    onDestroy(() => {
        clearTimeout(timeout);
    });
</script>

<div class="alert alert-success alert-dismissible fade show"
     class:alert-danger={$globalStore.alertDanger}
     class:alert-success={!$globalStore.alertDanger} role="alert" transition:fly={{y: -200, duration: 1000}}>
    {$globalStore.alertText}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
