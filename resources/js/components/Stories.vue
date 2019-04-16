<template>
    <div class="row justify-content-center">
        <spinner
            v-if="load"
            :animation-duration="1000"
            :size="60"
            :color="'#ff1d5e'"
        />
        <div v-if="!load" class="col-md-10">
            <div class="row justify-content-center">
                <h1 class="mb-5 col-12">
                    Hacker News
                    <small class="text-muted">Stories</small>
                </h1>
                <pagination />
                <div class="row">
                    <story v-for="story in stories" :key="story.id" :story="story" />
                </div>
                <pagination />
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import { LOAD_STORIES } from '../store/modules/stories/action-types';

    export default {
        computed: mapState({
            stories: state => state.stories.stories,
            load: state => state.stories.load,
        }),

        mounted() {
            const page = this.$route.params.page || 1;
            this.$store.dispatch(`stories/${LOAD_STORIES}`, page);
        },

        beforeRouteUpdate (to, from, next) {
            const page = to.params.page || 1;
            this.$store.dispatch(`stories/${LOAD_STORIES}`, page);
            next();
        }
    }
</script>
