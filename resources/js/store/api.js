export const getStories = (page) => {

    return axios.get(`/api/stories?page=${page}`)
        .then(
            (response) => response.data
        );
}
