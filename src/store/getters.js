/**
 * Gettters
 */
const getters = {
	/**
	 *Get table headers.
	 *
	 * @param  {Object} state
     *
	 * @return {Array} Table columns.
	 */
	columns( state ) {
		return state.tableHeaders;
	},

	/**
	 * Get table rows.
	 *
	 * @param  {Object} state
	 *
	 * @return {Array} Table rows.
	 */
	data( state ) {
		return state.tableRows;
	},

	/**
	 * Get graph data.
	 *
	 * @param  {Object} state
     *
	 * @return {Object} Graph data.
	 */
	graphData( state ) {
		return state.graphData;
	},

	/**
	 * Get settings.
	 *
	 * @param  {Object} state
     *
	 * @return {Object} Settings data.
	 */
	settings( state ) {
		return state.settings;
	},

	/**
	 * Get number of rows.
	 *
	 * @param  {Object} state
	 *
	 * @return {bigint} Toatal number of rows.
	 */
	perPage( state ) {
		return state.settings.numrows;
	},

	/**
	 * Get humandate status.
	 *
	 * @param  {Object} state
	 *
	 * @return {string} Human date or timestamp status.
	 */
	humanDate( state ) {
		return state.settings.humandate;
	},

	/**
	 * Get emails
	 *
	 * @param  {Object} state
	 *
	 * @return {Array} Settings emails.
	 */
	emails( state ) {
		return state.settings.emails;
	},

	/**
	 * Get loading
	 *
	 * @param  {Object} state
     *
	 * @return {Object} Loading status.
	 */
	loading( state ) {
		return state.loading;
	},

	/**
	 * Get notices.
	 *
	 * @param  {Object} state
	 *
	 * @return {Object} Notice messages.
	 */
	notice( state ) {
		return state.notice;
	},
};

export default getters;
