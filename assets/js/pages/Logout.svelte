<script>
    import {logoutUser} from '../stores/user';

    export let router;

    logoutUser();

    router.push('/login');
</script>