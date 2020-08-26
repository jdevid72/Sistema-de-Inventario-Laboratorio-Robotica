<template>

</template>

<script>
    export default {
        name: "Logout",
        created() {
            User.logout();
            Toast.fire({
                icon: 'success',
                title: 'Se Acaba de Cerra Session con Exito'

            });
            this.$router.push({name: 'login'})
        }
    }
</script>

<style scoped>

</style>
