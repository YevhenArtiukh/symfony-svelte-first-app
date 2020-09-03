<script>
    import {navigate} from 'svelte-routing';
    import {logoutUser} from '../stores/user';

    logoutUser();

    navigate('/login');
</script>