import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import Volstore from './modules/volFeatue'
export default createStore({
modules: {
    Volstore
},
plugins: [createPersistedState()],
})
