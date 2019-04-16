<template>
    <div class="col-12 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">{{ story.title }}</div>
            <div class="card-body">
                <router-link :to="`/story/${story.id}`" class="btn btn-primary btn-block">
                    See
                </router-link>
                <span class="float-left">by: {{ story.by }}</span>
                <span class="float-right">{{ story.time }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        props: ['story'],
        mounted() {
            let time = this.story.time;
            this.story.time = moment.unix(time).fromNow();
        }
    }
</script>
