<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class MenuHelper
{
    public static function Menu($user)
    {
        // Mengambil role dari user yang diberikan
        $user_role = DB::table('model_has_roles')->where('model_id', $user['id'])->get();

        $roles = [];
        foreach ($user_role as $role) {
            $roles[] = $role->role_id;
        }

        $menu_roles = DB::table('role_has_menus')->whereIn('role_id', $roles)->get();
        $array_menu_roles = [];
        foreach ($menu_roles as $value) {
            $array_menu_roles[] = $value->menu_id;
        }

        // Mengambil menus beserta submenus
        $menus = Menu::where('parent_id', 0)
            ->with('submenus', function ($query) use ($array_menu_roles) {
                $query->whereIn('id', $array_menu_roles);
                $query->with('submenus', function ($query) use ($array_menu_roles) {
                    $query->whereIn('id', $array_menu_roles);
                });
            })
            ->whereIn('id', $array_menu_roles)
            ->get();

        return $menus; // Menyimpan dalam bentuk koleksi objek
    } 

}
