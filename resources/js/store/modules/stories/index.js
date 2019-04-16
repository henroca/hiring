import moment from "moment";
import { getStories, getStory } from '../../api';
import { PAGINATION, CURRENT_STORY } from "./getters-types";
import { makePagination } from './make-pagination';

import {
    SET_STORIES,
    SET_LOAD,
    SET_PAGINATION,
    SET_STORY,
    SET_ERROR,
} from './mutation-types';

import {
    FETCH_STORIES,
    FETCH_STORY,
    LOAD_STORIES,
    LOAD_STORY,
} from './action-types';

let state = {
    stories: [],
    load: false,
    pagination: null,
    current_story: null,
    error: false
};

let mutations = {
    [SET_STORIES] (state, stories) {
        state.stories = stories;
    },

    [SET_LOAD] (state, load) {
        state.load = load;
    },

    [SET_PAGINATION] (state, pagination) {
        state.pagination = pagination;
    },

    [SET_STORY] (state, story) {
        state.current_story = story;
    },

    [SET_ERROR] (state, error) {
        state.error = error;
    },
};

let getters = {
    [PAGINATION]: ({ pagination }) => {
        return makePagination(pagination);
    },

    [CURRENT_STORY]: ({ current_story }) => {
        if (current_story == null) return null;

        let time = moment.unix(current_story.time).fromNow();
        return {...current_story, time};
    },
};

let actions = {
    async [FETCH_STORIES] ({ commit }, page) {
        commit(SET_LOAD, true);

        let response = await getStories(page);

        commit(SET_PAGINATION, response);
        commit(SET_STORIES, response.data);
    },

    async [FETCH_STORY] ({ commit }, id) {
        commit(SET_LOAD, true);
        commit(SET_STORY, await getStory(id));
    },

    async [LOAD_STORIES] ({ dispatch, commit }, page) {
        dispatch(FETCH_STORIES, page)
            .then(() => {
                commit(SET_LOAD, false);
                commit(SET_ERROR, false);
            }).catch(() => {
                commit(SET_LOAD, false);
                commit(SET_ERROR, true);
            });
    },

    async [LOAD_STORY] ({ dispatch, commit }, id) {
        dispatch(FETCH_STORY, id)
            .then(() => {
                commit(SET_LOAD, false);
                commit(SET_ERROR, false);
            }).catch(() => {
                commit(SET_LOAD, false);
                commit(SET_ERROR, true);
            });
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
}

