<?php
    class Base
    {
        private static $requestUri;
        public static $routeProccessed = false;

        /**
         * Routes a get request and executes the routed function.
         *
         * @param string $route
         * @param function $function
         */
        public static function get($route, $function)
        {
            // Check if the request method type
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'get') {
                static::processRoute($route, $function);
            }
        }

        /**
         * Routes a post request and executes the routed function.
         *
         * @param string $route
         * @param function $function
         */
        public static function post($route, $function)
        {
            // Check the request method type
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                static::processRoute($route, $function);
            }
        }

        /**
         * Determines the base URI of the app.
         *
         * @return string
         */
        public static function baseUri($segments = null)
        {
            return str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) . ($segments ? trim($segments, '/') : '');
        }

        /**
         * Porcesses the route.
         *
         * @access private
         */
        private static function processRoute($route, $function)
        {
            if (static::$routeProccessed) {
                return;
            }

            // Check if the request is empty
            if (static::requestUri() == '') {
                static::$requestUri = '/';
            }

            // Match the route
            if (preg_match("#^{$route}$#", static::requestUri(), $matches)) {
                unset($matches[0]);
                call_user_func_array($function, $matches);
                static::$routeProccessed = true;
            }
        }

        /**
         * Determines the requested URL.
         *
         * @return string
         * @access private
         */
        public static function requestUri()
        {
            // Check ff this is the first time getting the request uri
            if (static::$requestUri === null) {
                // Check if there is a PATH_INFO variable
                // Note: some servers seem to have trouble with getenv()
                $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
                if (trim($path, '/') != '' && $path != "/index.php") {
                    return static::$requestUri = $path;
                }

                // Check if ORIG_PATH_INFO exists
                $path = str_replace($_SERVER['SCRIPT_NAME'], '', (isset($_SERVER['ORIG_PATH_INFO'])) ? $_SERVER['ORIG_PATH_INFO'] : @getenv('ORIG_PATH_INFO'));
                if (trim($path, '/') != '' && $path != "/index.php") {
                    return static::$requestUri = $path;
                }

                // Check for ?uri=x/y/z
                if (isset($_REQUEST['url'])) {
                    return static::$requestUri = $_REQUEST['url'];
                }

                // Check the _GET variable
                if (is_array($_GET) && count($_GET) == 1 && trim(key($_GET), '/') != '') {
                    return static::$requestUri = key($_GET);
                }

                // Check for QUERY_STRING
                $path = (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');
                if (trim($path, '/') != '') {
                    return static::$requestUri = $path;
                }

                // Check for requestUri
                $path = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);
                if (trim($path, '/') != '' && $path != "/index.php") {
                    return static::$requestUri = str_replace(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '', $path);
                }

                // I dont know what else to try, screw it..
                return static::$requestUri = '';
            }

            return static::$requestUri;
        }
    }