export const getStories = () => {

    return axios.get('/api/stories')
        .then(
            (response) => response.data
        );
}
