<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="col-12 text-center">
            <small>© <a target="_blank" href="https://www.x4iiiis.com">x4iiiis</a> {{ year }}</small>
            <br>
            <small>All rights reserved.</small>
        </div>
    </nav>
</template>

<script>
export default {
    mounted() {
        this.year = new Date().getFullYear();
    },
    data() {
        return {
            year: null,
        }
    }
}
</script>

<style scoped>
a {
    text-decoration: none;
    color: inherit;
}
</style>