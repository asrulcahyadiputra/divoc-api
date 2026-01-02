<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use App\Models\RoleHasMenu;
    use App\Models\Menu;

    class CheckPermission
    {
        public function handle(Request $request, Closure $next, string $menuPrefix, string $action)
        {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            $allowedActions = ['read', 'create', 'update', 'delete'];

            if (!in_array($action, $allowedActions)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid permission action',
                ], 400);
            }

            $menuCacheKey = "menu:prefix:{$menuPrefix}";

            $menu = cache()->rememberForever($menuCacheKey, function () use ($menuPrefix) {
                return Menu::select('id', 'prefix')->where('prefix', $menuPrefix)->first();
            });

            if (!$menu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu tidak ditemukan',
                ], 403);
            }

            $cacheKey = "perm:{$user->kode_lokasi}:{$user->role_id}:{$menuPrefix}:{$action}";

            $hasAccess = cache()->remember($cacheKey, now()->addHours(24), function () use ($user, $menu, $action) {
                return RoleHasMenu::where('kode_lokasi', $user->kode_lokasi)
                    ->where('role_id', $user->role_id)
                    ->where('menu_id', $menu->id)
                    ->where("can_{$action}", 1)
                    ->exists();
            });


            if (!$hasAccess) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses',
                ], 403);
            }

            return $next($request);
        }
    }
