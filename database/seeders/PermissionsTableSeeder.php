<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'content_access',
            ],
            [
                'id'    => 18,
                'title' => 'tag_create',
            ],
            [
                'id'    => 19,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 20,
                'title' => 'tag_show',
            ],
            [
                'id'    => 21,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 22,
                'title' => 'tag_access',
            ],
            [
                'id'    => 23,
                'title' => 'review_create',
            ],
            [
                'id'    => 24,
                'title' => 'review_edit',
            ],
            [
                'id'    => 25,
                'title' => 'review_show',
            ],
            [
                'id'    => 26,
                'title' => 'review_delete',
            ],
            [
                'id'    => 27,
                'title' => 'review_access',
            ],
            [
                'id'    => 28,
                'title' => 'recommendation_create',
            ],
            [
                'id'    => 29,
                'title' => 'recommendation_edit',
            ],
            [
                'id'    => 30,
                'title' => 'recommendation_show',
            ],
            [
                'id'    => 31,
                'title' => 'recommendation_delete',
            ],
            [
                'id'    => 32,
                'title' => 'recommendation_access',
            ],
            [
                'id'    => 33,
                'title' => 'brand_create',
            ],
            [
                'id'    => 34,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 35,
                'title' => 'brand_show',
            ],
            [
                'id'    => 36,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 37,
                'title' => 'brand_access',
            ],
            [
                'id'    => 38,
                'title' => 'museum_access',
            ],
            [
                'id'    => 39,
                'title' => 'order_ticket_create',
            ],
            [
                'id'    => 40,
                'title' => 'order_ticket_edit',
            ],
            [
                'id'    => 41,
                'title' => 'order_ticket_show',
            ],
            [
                'id'    => 42,
                'title' => 'order_ticket_delete',
            ],
            [
                'id'    => 43,
                'title' => 'order_ticket_access',
            ],
            [
                'id'    => 44,
                'title' => 'event_create',
            ],
            [
                'id'    => 45,
                'title' => 'event_edit',
            ],
            [
                'id'    => 46,
                'title' => 'event_show',
            ],
            [
                'id'    => 47,
                'title' => 'event_delete',
            ],
            [
                'id'    => 48,
                'title' => 'event_access',
            ],
            [
                'id'    => 49,
                'title' => 'barang_create',
            ],
            [
                'id'    => 50,
                'title' => 'barang_edit',
            ],
            [
                'id'    => 51,
                'title' => 'barang_show',
            ],
            [
                'id'    => 52,
                'title' => 'barang_delete',
            ],
            [
                'id'    => 53,
                'title' => 'barang_access',
            ],
            [
                'id'    => 54,
                'title' => 'submission_link_create',
            ],
            [
                'id'    => 55,
                'title' => 'submission_link_edit',
            ],
            [
                'id'    => 56,
                'title' => 'submission_link_show',
            ],
            [
                'id'    => 57,
                'title' => 'submission_link_delete',
            ],
            [
                'id'    => 58,
                'title' => 'submission_link_access',
            ],
            [
                'id'    => 59,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 60,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 61,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
