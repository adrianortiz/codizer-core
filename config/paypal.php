<?php
return array(
    // set your paypal credential
    'client_id' => 'AX3IjOjERT-hP7jdniLk9mpL0Y1otnt4HghfG3or-tZM4iBMbdKsjDnknqkDWLbVR2MYtZ2WFQWw7uec',
    'secret' => 'EDPzA_Kg_grigb-yNSRIjHqWN5J1i80zXztv4ijEERsmWj5yulgKJ-7FHnW05DwTo-sPOYkEyrkAWcdj',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);