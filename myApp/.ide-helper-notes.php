<?php

/**
 * Laravel IDE Helper Configuration
 * 
 * This file helps IDEs understand Laravel's magic methods and helper functions.
 * The warnings you see are false positives - Laravel provides these at runtime.
 * 
 * Common helpers that IDEs may not recognize:
 * - view() - Returns a view instance
 * - route() - Generates a URL for a named route
 * - redirect() - Creates a redirect response
 * - back() - Creates a redirect to the previous location
 * - old() - Retrieves old input data
 * - Auth facade - Handles authentication
 * - Hash facade - Handles password hashing
 * - Route facade - Defines routes
 * 
 * To eliminate these warnings, you can:
 * 1. Install Laravel IDE Helper: composer require --dev barryvdh/laravel-ide-helper
 * 2. Run: php artisan ide-helper:generate
 * 3. Configure your IDE to recognize Laravel patterns
 * 
 * Note: These warnings do not affect functionality.
 */
