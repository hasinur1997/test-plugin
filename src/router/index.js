import { createRouter, createWebHashHistory } from 'vue-router';
import Graph from '../pages/Graph.vue';
import Table from '../pages/Table.vue';
import Settings from '../pages/Settings.vue';

/**
 * Routes.
 *
 * @type array
 */
const routes = [
	{
		path: '/',
		component: Table,
	},
	{
		path: '/graph',
		component: Graph,
	},
	{
		path: '/settings',
		component: Settings,
	},
];

/**
 * Router instance.
 */
export default createRouter( {
	routes,
	history: createWebHashHistory(),
	linkActiveClass: 'miusage-nav-tab-active',
} );
