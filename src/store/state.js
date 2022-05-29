/**
 * States
 */
const state = {
	/**
	 * Table headers
	 */
	tableHeaders: [],

	/**
	 * Table rows
	 */
	tableRows: [],

	/**
	 * Graph data
	 */
	graphData: {},

	/**
	 * Settings data
	 */
	settings: {
		numrows: '',
		humandate: '',
		emails: [],
	},

	/**
	 * Global loaders
	 */
	loading: false,

	/**
	 * Notices
	 */
	notice: {
		errors: [],
		update: '',
	},
};

export default state;
