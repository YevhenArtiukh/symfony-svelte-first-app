<script>
    import globalStore from '../globalStore';

    export let router;

    globalStore.logout();
    router.push('/login');
</script>