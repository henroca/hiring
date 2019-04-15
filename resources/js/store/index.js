import Vuex, { Store } from 'vuex';
import stories from './modules/stories';


Vue.use(Vuex);

export default new Store({
    modules: {
        stories
    },
});
