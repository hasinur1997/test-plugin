<template>
    <div class="">
        <list-table
            :columns="columns"
            :rows="rows"
            :total-items="totalItems"
            :total-pages="totalPage"
            :per-page="perPage"
            :current-page="currentPage"
            @pagination="goToPage"
        >
        </list-table>

        <div v-if="emails">
            <h2>{{ __( 'Settings emails', 'wp-miusage' ) }}</h2>
            <ul>
                <li v-for="(email, index) in emails" :key="index">
                    {{ email }}
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
import ListTable from 'vue-wp-list-table';
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';


export default {
    name: 'Table',
    components: {
        ListTable
    },

    /**
     * Loacal data
     * 
     * @return object
     */
    data() {
        return {
            currentPage: 1,
        }
    },

    /**
     * Local methods
     */
    methods: {
        ...mapActions([
            'getData',
            'getSettings'
        ]),

        /**
         * Goto next page or specific page
         * 
         * @return void
         */
        goToPage( page ) {
            this.currentPage = page;
            this.getData();
        },
    },

    /**
     * Computed properties.
     */
    computed: {
        /**
         * Getters
         */
        ...mapGetters([
            'columns',
            'data',
            'perPage',
            'emails',
        ]),

        /**
         * Rows
         */
        rows() {
            const startIndex = ( this.currentPage - 1 ) * this.perPage;
            const countItems = this.currentPage * this.perPage;

            return this.data.slice( startIndex, countItems );       
        },

        /**
         * Get total number of items.
         * 
         * @return integer
         */
        totalItems() {
            return this.data.length;
        },

        /**
         *  Get the total number of page.
         * 
         * @return integer
         */
        totalPage() {
            return Math.ceil( this.totalItems / this.perPage );
        },
    },

    /**
     * Initialize when component loaded.
     */
    created() {
        /**
         * Set all rows when initialize.
         */
        this.getSettings();
        this.getData();  
    },
}
</script>