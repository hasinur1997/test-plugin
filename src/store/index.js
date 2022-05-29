import { createStore } from 'vuex';
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

/**
 * Create store instance.
 */
const store = createStore( {
	state,
	getters,
	mutations,
	actions,
} );

export default store;
