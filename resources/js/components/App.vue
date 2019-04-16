<template>
    <div id="app">
        <header class="mb-5">
            <nav class="navbar navbar-dark bg-dark">
                <router-link class="navbar-brand" to="/">Hacker News</router-link>
            </nav>
        </header>
        <section id="content" class="container">
            <router-view></router-view>
        </section>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        computed: mapState({
            error: state => state.stories.error,
        }),
        watch: {
            error: function (error) {
                if (error) {
                    this.$router.replace('/error');
                }
            }
        },
    }
</script>
