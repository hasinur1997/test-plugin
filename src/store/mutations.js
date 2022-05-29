/**
 * Mutations
 */
const mutations = {
	/**
	 * Set table headers.
	 *
	 * @param  {Object}  state
	 * @param  {Array}   headers
	 */
	setTableHeader: ( state, headers ) => {
		state.tableHeaders = headers;
	},

	/**
	 * Set table rows.
	 *
	 * @param  {Object} state
	 * @param  {Array}  rows
	 */
	setTableRows: ( state, rows ) => {
		state.tableRows = rows;
	},

	/**
	 * Set graph data.
	 *
	 * @param  {Object} state
	 * @param  {Array}  data
	 */
	setGraphData: ( state, data ) => {
		state.graphData = data;
	},

	/**
	 * Set settings
	 *
	 * @param  {Object}   state
	 * @param  {Array}    settings
	 */
	setSettings: ( state, settings ) => {
		state.settings = settings;
	},

	/**
	 * Set email.
	 *
	 * @param  {Object} state
	 */
	setEmail( state ) {
		state.settings.emails.push( '' );
	},

	/**
	 * Remove email.
	 *
	 * @param  {Object}  state
	 * @param  {bigint} index
	 */
	removeEmail( state, index ) {
		state.settings.emails.splice( index, 1 );
	},

	/**
	 * Set loaders.
	 *
	 * @param  {Object} state
	 * @param  {boolean}   status
	 */
	setLoaders( state, status ) {
		state.loading = status;
	},

	/**
	 * Set notices.
	 *
	 * @param  {Object}  state
	 * @param  {string}  message
	 */
	setErrorNotice( state, message ) {
		state.errors.push( message );
	},

	/**
	 * Set update notice.
	 *
	 * @param  {Object}  state
	 * @param  {string}  message
	 */
	setUpdateNotice( state, message ) {
		state.notice.update = message;
	},
};

export default mutations;
