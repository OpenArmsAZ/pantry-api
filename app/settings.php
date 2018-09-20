<?php
/**
 * Application Settings
 */
return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => (getenv('ENVIRONMENT') === "development") ? true : false,
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header,
    ],
];
