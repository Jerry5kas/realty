<?php

if (!function_exists('can')) {
    /**
     * Check if the authenticated user has a specific permission
     */
    function can($permission)
    {
        return auth()->check() && auth()->user()->hasPermission($permission);
    }
}

if (!function_exists('hasRole')) {
    /**
     * Check if the authenticated user has a specific role
     */
    function hasRole($role)
    {
        return auth()->check() && auth()->user()->hasRole($role);
    }
}

if (!function_exists('hasAnyRole')) {
    /**
     * Check if the authenticated user has any of the given roles
     */
    function hasAnyRole($roles)
    {
        return auth()->check() && auth()->user()->hasAnyRole($roles);
    }
}
