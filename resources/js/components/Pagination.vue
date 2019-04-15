<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li
                v-for="page in pagination.pages"
                :key="page.link + page.text"
                :class="'page-item ' + page.className"
            >
                <router-link class="page-link" :to="`/stories/${page.link}`">
                    {{ page.text }}
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { PAGINATION } from "../store/modules/stories/getters-types";

    export default {
        computed: {
            ...mapGetters({pagination: `stories/${PAGINATION}`}),
        },
    }
</script>
