import { getStories } from '../../api';

import {
    SET_STORIES,
    SET_LOAD,
} from './mutation-types';

import {
    FETCH_STORIES,
    LOAD_STORIES,
} from './action-types';

let state = {
    stories: [],
    load: false,
};

let mutations = {
    [SET_STORIES] (state, stories) {
        state.stories = stories;
    },

    [SET_LOAD] (state, load) {
        state.load = load;
    },
};

let actions = {
    async [FETCH_STORIES] ({ commit }, page) {
        commit(SET_LOAD, true);

        let response = await getStories(page);

        commit(SET_STORIES, response.data);
    },

    async [LOAD_STORIES] ({ dispatch, commit }, page) {
        dispatch(FETCH_STORIES, page).then(() => commit(SET_LOAD, false));
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

