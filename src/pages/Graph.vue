<template>
    <div>
        <button 
            class="button button-primary refresh-button"
            @click="refreshData"
        >
            {{ __( 'Refresh', 'wp-miusage' ) }}
        </button>
        <Bar
            :chart-options="chartOptions"
            :chart-data="chartData"
            :chart-id="chartId"
            :dataset-id-key="datasetIdKey"
            :plugins="plugins"
            :css-classes="cssClasses"
            :styles="styles"
            :width="200"
            :height="200"
        />
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register( Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale );

import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'Graph',
    components: {
        Bar
    },

    data() {
        return {
            /**
             * Chart options
             * 
             * @type Object
             */
            chartOptions: {
                responsive: true,
            },
        }
    },

    /**
     * Local methods
     */
    methods: {
        /**
         * Get store methods
         */
        ...mapActions([
            'getData'
        ]),

        /**
         * Refresh data.
         */
        refreshData(){
            this.getData(true);
        }
    },

    /**
     * Computed properties
     */
    computed: {
        /**
         * Get store data
         */
        ...mapGetters([
            'graphData'
        ]),

        /**
         * Get graph labels.
         * 
         * @return array
         */
        labels() {
            const items = Object.values( this.graphData );

            return items.map( item => item.date );
        },

        /**
         * Get graph data set.
         * 
         * @return array
         */
        dataSet() {
            const items = Object.values( this.graphData );

            return items.map( item => item.value );
        },

        /**
         * Get chart data.
         * 
         * @returns Object
         */
        chartData() {
            return {
                labels: this.labels,
                datasets: [
                    {
                        label: __( 'Color', 'wp-miusage' ),
                        backgroundColor: '#f87979',
                        data: this.dataSet,
                    }
                ]
            }
        }
    },

    /**
     * Initialize when component loaded.
     */
    created() {
        this.getData();
    }
}
</script>

<style scoped>
    .refresh-button {
        right: 40px;
        position: absolute;
        margin-top: 20px;
        margin-bottom: 20px;
        top: 2px;
    }
</style>