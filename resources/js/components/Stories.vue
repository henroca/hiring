<template>
    <div class="row justify-content-center">
        <spinner
            v-if="load"
            :animation-duration="1000"
            :size="60"
            :color="'#ff1d5e'"
        />
        <div
            class="col-md-10 mb-4"
            v-for="story in stories"
            :key="story"
        >
            <div class="card">
                <div class="card-header">História {{ story }}</div>
                <div class="card-body">
                    {{ story }}
                </div>
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
            this.$store.dispatch(`stories/${LOAD_STORIES}`);
        }
    }
</script>
