<template>
    <div id="app">
        <header class="mb-5">
            <nav class="navbar navbar-dark bg-dark">
                <router-link class="navbar-brand" to="/">Home</router-link>
            </nav>
        </header>
        <section id="content" class="container">
            <router-view></router-view>
        </section>
    </div>
</template>

<script>
    export default {}
</script>
