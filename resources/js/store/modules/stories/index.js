import { getStories } from '../../api';

import { PAGINATION } from "./getters-types";

import {
    SET_STORIES,
    SET_LOAD,
    SET_PAGINATION,
} from './mutation-types';

import {
    FETCH_STORIES,
    LOAD_STORIES,
} from './action-types';

let state = {
    stories: [],
    load: false,
    pagination: null,
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
    }
};

const page = (link, text, className = '') => ({ link, text, className });

const makePagination = (pagination) => {
    if (pagination == null) return [];

    let pages = [];
    let { current_page, last_page } = pagination;
    let prev_page = current_page - 1;
    let next_page = current_page + 1;
    let prev_class = prev_page < 1 ? 'disabled' : '';
    let next_class = next_page > last_page ? 'disabled' : '';

    pages.push(page(prev_page, 'Anterior', prev_class));

    if (current_page - 3 >= 1) {
        pages.push(page(1, 1));
    }

    if (current_page - 3 > 1) {
        pages.push(page(current_page - 3, '...', 'disabled'));
    }

    if (current_page - 2 >= 1) {
        pages.push(page(current_page - 2, current_page - 2));
    }

    if (prev_page >= 1) {
        pages.push(page(prev_page, prev_page));
    }

    pages.push(page(current_page, current_page, 'disabled'));

    if (next_page <= last_page) {
        pages.push(page(next_page, next_page));
    }

    if (current_page + 2 <= last_page) {
        pages.push(page(current_page + 2, current_page + 2));
    }

    if (current_page + 3 < last_page) {
        pages.push(page(current_page + 3, '...', 'disabled'));
    }

    if (current_page + 3 <= last_page) {
        pages.push(page(last_page, last_page));
    }

    pages.push(page(next_page, 'Próximo', next_class));

    return {
        current_page: pagination.current_page,
        pages,
    };
};

let getters = {
    [PAGINATION]: ({ pagination }) => {
        return makePagination(pagination);
    }
};

let actions = {
    async [FETCH_STORIES] ({ commit }, page) {
        commit(SET_LOAD, true);

        let response = await getStories(page);

        commit(SET_PAGINATION, response);
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
    mutations,
    getters,
}

