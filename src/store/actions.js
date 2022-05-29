import axios from 'axios';
import moment from 'moment';

/**
 * Actions
 */
const actions = {
	/**
	 * Get data from remote api.
	 *
	 * @param  {Object} commit
	 * @param  {Object} state
	 * @param  {boolean} refresh
	 */
	getData( { commit, state }, refresh = false ) {
		/**
		 * Show loaders
		 */
		commit( 'setLoaders', true );

		/**
		 * Prepare params.
		 */
		const params = {
			action: 'miusage_table_data',
			_ajax_nonce: miusage.nonce,
		};

		if ( refresh ) {
			params.refresh = 'yes';
		}

		/**
		 * Send ajax request.
		 */
		axios.get( miusage.ajaxUrl, { params } )
			.then( ( res ) => {
				const headers = res.data.data.table.data.headers;
				let data = res.data.data.table.data.rows;
				const graph = res.data.data.graph;
				const columns = {};

				/**
				 * Set column headers
				 */
				headers.map( ( item ) => {
					const key = item.toLowerCase();
					columns[ key ] = {
						label: __( item, 'wp-miusage' ),
					};
				} );

				/**
				 * Set human readable.
				 */
				if ( 'yes' == state.settings.humandate ) {
					data = data.map( ( row ) => {
						console.log( row.date );
						const dt = moment( row.date * 1000 );
						row.date = moment( dt, 'YYMMDD' ).fromNow();

						return row;
					} );
				}

				/**
				 * Set date for graph data.
				 */
				for ( const key in graph ) {
					graph[ key ].date = moment( graph[ key ].date ).format( 'DD-MM-YYYY' );
				}

				/**
				 * Set states
				 */
				commit( 'setTableHeader', columns );
				commit( 'setTableRows', data );
				commit( 'setGraphData', graph );

				/**
				 * Hide loaders.
				 */
				commit( 'setLoaders', false );
			} )
			.catch( ( error ) => {
				console.log( error );
			} );
	},

	/**
	 * Get settings.
	 *
	 * @param  {Object} param0
	 */
	getSettings( { commit } ) {
		/**
		 * Show loaders.
		 */
		commit( 'setLoaders', true );

		/**
		 * Send ajax request.
		 */
		axios.get( miusage.ajaxUrl, {
			params: {
				action: 'miusage_get_settings',
				_ajax_nonce: miusage.nonce,
			},
		} )
			.then( ( res ) => {
				// console.log(res)
				commit( 'setSettings', res.data );

				/**
				 * Hide loaders.
				 */
				commit( 'setLoaders', false );
			} )
			.catch( ( error ) => {

			} );
	},

	/**
	 * Update settings.
	 *
	 * @param  {Object} commit
	 * @param  {Object} state
	 */
	updateSettings( { commit, state } ) {
		/**
		 * Show loaders;
		 */
		commit( 'setLoaders', true );

		/**
		 * Prepare form data.
		 */
		const form_data = new FormData;
		form_data.append( 'action', 'miusage_update_settings' );
		form_data.append( '_ajax_nonce', miusage.nonce );
		form_data.append( 'numrows', state.settings.numrows );
		form_data.append( 'humandate', state.settings.humandate );

		state.settings.emails.map( ( email ) => {
			form_data.append( 'emails[]', email );
		} );

		/**
		 * Send ajax request.
		 */
		axios.post( miusage.ajaxUrl, form_data )
			.then( ( res ) => {
				/**
				 * Hide loaders.
				 */
				commit( 'setLoaders', false );

				/**
				 * Set update notice.
				 */
				commit( 'setUpdateNotice', __( 'Settings updated.', 'wp-miusage' ) );
			} )
			.catch( ( error ) => {

			} );
	},

	/**
	 * Set email.
	 *
	 * @param  {Object} commit
	 */
	setEmail( { commit } ) {
		commit( 'setEmail' );
	},

	/**
	 * Reset email.
	 *
	 * @param  {Object} param0
	 * @param  {bigint} index
	 */
	resetEmail( { commit }, index ) {
		commit( 'removeEmail', index );
	},
};

export default actions;
