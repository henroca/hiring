<template>
    <div class="row justify-content-center">
        <div v-if="!load" class="col-10">
            <button v-on:click="back" class="btn btn-primary btn-lg">&laquo; back</button>
        </div>
        <spinner
            v-if="load"
            :animation-duration="1000"
            :size="60"
            :color="'#ff1d5e'"
        />
        <div v-if="story && !load" class="col-10">
            <div class="panel">
                <div class="panel-header clearfix">
                    <h3 class="float-left">{{ story.title }}</h3>
                    <a
                        v-if="story.url"
                        :href="story.url"
                        target="_blank"
                        class="btn btn-primary float-right"
                    >
                        See Story
                    </a>
                </div>
                <div class="panel-body">
                    <p v-if="story.url"><strong>font</strong>: {{ story.url | host }}</p>
                    <p><strong>time</strong>: {{ story.time }}</p>
                    <div v-if="story.text" v-html="story.text" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { LOAD_STORY } from '../store/modules/stories/action-types';
    import { CURRENT_STORY } from '../store/modules/stories/getters-types';
    import { mapState, mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({story: `stories/${CURRENT_STORY}`}),
            ...mapState({ load: state => state.stories.load,}),
        },

        mounted() {
            const id = this.$route.params.id;
            this.$store.dispatch(`stories/${LOAD_STORY}`, id);
        },

        methods: {
            back: function (event) {
                this.$router.go(-1);
            }
        }
    }
</script>
