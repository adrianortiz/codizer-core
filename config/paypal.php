<?php
return array(
    // set your paypal credential
    'client_id' => 'ASVMwCw-bqN5jN4zKfYD7QIwdQ6d1yY9W4VgTNUYuShl6IwsLVgUn1OU6GD38az0ZDeIbw12oBnxBDqz',
    'secret' => 'EIAc0mG-h3NYC5WWsMEjcTMC7bPNR5FygwdWdngblFR7XBm4D9TImpZIwdSdcOXsZS2WbT6vnikte_qC',

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