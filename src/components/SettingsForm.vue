<template>
    <div class="form">
        <div id="message" class="updated notice is-dismissible" v-if="notice.update">
			<p><strong>{{ notice.update }}</strong></p>
        </div>

        <div class="notice notice-error" v-if="Object.keys( errors ).length > 0">
            <ul>
                <li v-for="(value, name, index) in errors" :key="index">
                    {{ value }}
                </li>
            </ul>
        </div>
    
        <form action="" @submit.prevent="saveSettings">
            <table class="form-table">
                <tr>
                    <th>
                        <label for="numrows">{{ __( 'Number of rows', 'wp-miusage' ) }}</label>
                    </th>
                    <td>
                        <input 
                            type="number" 
                            id="numrows" 
                            class="regular-text" 
                            v-model="settings.numrows"
                            @keyup="resetErrors"
                        />
                        <p class="description">{{ __( 'Please enter number of rows from (1 to 5)', 'wp-miusage' ) }}</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="humandate">{{ __( 'Human Date', 'wp-miusage' ) }}</label>
                    </th>
                    <td>
                        <label for="humandate-yes" class="miusage-label">
                            <input 
                                type="radio" 
                                id="humandate-yes" 
                                v-model="settings.humandate"
                                value="yes"
                            >
                            {{ __( 'Yes', 'wp-miusage' ) }}

                        </label>
                        <label for="humandate-no" class="miusage-label">
                            <input 
                                type="radio" 
                                id="humandate-no" 
                                class="regular-text" 
                                v-model="settings.humandate"
                                value="no"
                            >
                            {{ __( 'No', 'wp-miusage' ) }}
                        </label>
                    </td>
                </tr>
                <template v-if="settings.emails.length == 0">
                    <tr>
                        <th>
                            <label for="">{{ __( 'Email', 'wp-miusage' ) }}</label>
                        </th>
                        <td>
                            <button class="button button-default" @click.prevent="addEmail">{{ __( 'Add email', 'wp-miusage' ) }}</button>
                            <p class="help">{{ __( 'You can add maximum of 5 email address.', 'wp-miusage' ) }}</p>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="(email, index) in settings.emails" :key="index">
                        <th v-if="index == 0">
                            <label for="email">{{ __( 'Email', 'wp-miusage' ) }}</label>
                        </th>
                        <th v-else></th>
                        <td>
                            <input
                                type="email"
                                class="regular-text"
                                id="email"
                                v-model="settings.emails[index]"
                                :placeholder="__( 'Enter email address', 'wp-miusage' )"
                                @keyup="resetErrors"
                            >
                            <span
                                class="dashicons dashicons-remove miusage-icon remove"
                                @click="removeEmail(index)"
                            >
                            </span>
                            <span
                                class="dashicons dashicons-plus-alt miusage-icon add"
                                v-if="index == settings.emails.length - 1 && settings.emails.length < 5"
                                @click="addEmail"
                            ></span>
                        </td>
                    </tr>
                </template>
            </table>
            <button class="button button-primary">
                {{ __( 'Update Settings', 'wp-miusage' ) }}
            </button>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'SettingsForm',
   
    data() {
        return {
           errors: {},
        }
    },

    /**
     * Local methods
     */
    methods: {
        /**
         * Actions
         */
        ...mapActions([
            'setEmail',
            'resetEmail',
            'getSettings',
            'updateSettings',
            'notice',
        ]),

        /**
         * Add new email.
         * 
         * @return void
         */
        addEmail() {
            if ( this.settings.emails.length >= 5 ) {
                return;
            }

            // Set email using actions.
            this.setEmail();
        },

        /**
         * Remove email.
         * 
         * @return void
         */
        removeEmail( index ) {
            this.resetEmail( index );
        },

        /**
         * Save settings
         * 
         * @returns void
         */
        saveSettings() {

            /**
             * Validate numrows.
             */
            if ( this.settings.numrows < 1 || this.settings.numrows > 5 ) {
                if ( ! this.errors.hasOwnProperty( 'numrows' ) ) {
                    this.errors.numrows = __( 'Number of rows should be 1 to 5', 'wp-miusage' );
                }
            }

            /**
             * Validate emails.
             */
            this.settings.emails.map(email => {
                if ( ! this.validateEmail( email )  ) {
                    if ( ! this.errors.hasOwnProperty( 'email' ) ) {
                        this.errors.email =  __( 'Please enter valid email address', 'wp-miusage' );
                    }
                }
            })

            /**
             * Update settings if no errorsors.
             */
            if ( Object.keys( this.errors ).length === 0 ) {
                console.log("Okay");
                this.updateSettings();
            }
        },

        /**
         * Validate emails.
         */
        validateEmail( email ) {
            return String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
        },

        /**
         * Reset errorsors when change value.
         * 
         * @returns void
         */
        resetErrors(e) {
            if ( this.errors.hasOwnProperty(e.target.id) ) {
                delete this.errors[e.target.id];
            }
            
        }
    },

    /**
     * Computed properties
     */
    computed: {
        ...mapGetters([
            'settings',
            'notice'
        ])
    },

    created() {
        this.getSettings();
    }
}
</script>

<style scoped>
    .miusage-icon {
        line-height: 38px;
        cursor: pointer;
    }
    .miusage-icon.remove {
        color: #f87979;
    }
    .miusage-label {
        margin-right: 10px;
    }
</style>