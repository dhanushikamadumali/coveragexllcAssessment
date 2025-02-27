<?php

return [
    'paths' => ['api/*'], // Enable CORS for API routes
    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, etc.)
    'allowed_origins' => ['*'], // Allow requests from your Vue frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Set to true if using cookies or authentication
];

