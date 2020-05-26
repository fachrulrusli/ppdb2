<?php namespace App\Consyst;

use Closure;

class ConsystMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if a user is logged in.

        if (!$user = $request->user())
        {
            return $next($request);
        }

        // Get the current route.
        $route = $request->route();

        // Get the current route actions.
        $actions = $route->getAction();
        //dd(isset($actions['permissions']));
        //dd($actions['permissons']);
        // Check if we have any permissions to check the user has.

        if (!$permissions = isset($actions['permissions']) ? $actions['permissions'] : null)
        {
            // No permissions to check, allow access.
            return $next($request);
        }

        // Fetch all of the matching user permissions.
        $userPermissions = array_flatten($user->akses()->whereIn('slug', (array) $permissions)->get()->toArray(), 'slug');

        // Turn the permissions we require into an array.
        $permissions = (array) $permissions;

        // Check if we require all permissions, or just one.
        if (isset($actions['permissions_require_all']))
        {
            // If user has EVERY permission required.
            if (count($permissions) == count($userPermissions))
            {
                // Access is granted.
                return $next($request);
            }
        } else {
            // If the user has the permission.
            if (count($userPermissions) >= 1)
            {
                // Access is granted and the rest of the permissions are ignored.
                return $next($request);
            }
        }

        // If we reach this far, the user does not have the required permissions.
        return abort(401,"unauthorize");

    }

}
