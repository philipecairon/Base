<?php

    /**
     * Shortcut to the Nanite::get() method.
     *
     * @param string $route
     * @param function $function
     */
    function get($route, $function)
    {
        Base::get($route, $function);
    }

    /**
     * Shortcut to the Nanite::post() method.
     *
     * @param string $route
     * @param function $function
     */
    function post($route, $function)
    {
        Base::post($route, $function);
    }
