export const getStories = (page) => (
    axios.get(`/api/stories?page=${page}`)
        .then(
            (response) => response.data
        )
);

export const getStory = (id) => (
    axios.get(`/api/stories/${id}`)
        .then(
            (response) => response.data
        )
);

export const getStoriesReload = (page) => (
    axios.get(`/api/stories/reload?page=${page}`)
        .then(
            (response) => response.data
        )
);
