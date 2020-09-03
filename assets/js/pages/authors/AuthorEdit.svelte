<script>
    import dayjs from "dayjs";
    import DatePicker from "svelte-calendar";
    import {onMount} from "svelte";
    import {link, navigate} from "svelte-routing";
    import Loading from '../../components/Loading.svelte';
    import getAuthor from '../../api/authors/author';
    import editAuthor from '../../api/authors/edit';
    import globalStore from "../../globalStore";

    export let id;
    let title = "Author edit";
    let isLoading = true;
    let name = "";
    let surname = "";
    let dateOfBirth = new Date();
    let isSubmit = false;

    $: isEmpty = !name || !surname;

    onMount(async () => {
        const user = await getAuthor(id);
        name = user.name;
        surname = user.surname;
        dateOfBirth = new Date(user.dateOfBirth);
        isLoading = false;
    })

    async function handleSubmit() {
        isSubmit = true;

        let response = await editAuthor(id, {name, surname, dateOfBirth});

        if (response) {
            navigate('/authors')
            globalStore.toggleItem("alert", true, "Author edited");
        } else {
            globalStore.toggleItem("alert", true, "Error !!!", true);
        }
        isSubmit = false;
    }

</script>


<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="card">
    <div class="card-header text-center">
        {title}
    </div>
    <div class="card-body">
        {#if isLoading}
            <Loading/>
        {:else}
            <form on:submit|preventDefault={handleSubmit}>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" id="name" bind:value={name} class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Surname</label>
                        <input type="text" id="surname" bind:value={surname} class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Date of Birth</label>
                        <div>
                            <DatePicker format={date => dayjs(date).format('DD-MM-YYYY')} bind:selected={dateOfBirth}/>
                        </div>
                    </div>
                </div>
                {#if isEmpty}
                    <p class="text-danger">please fill out all form fields</p>
                {/if}
                <button type="submit" class="btn btn-primary" class:disabled={isEmpty || isSubmit}
                        disabled={isEmpty || isSubmit}>
                    {#if isSubmit}
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
                    {:else}
                        Zapisz
                    {/if}
                </button>
                <a href="/authors" class="btn btn-secondary" use:link>Powrót</a>
            </form>
        {/if}
    </div>
</div>

