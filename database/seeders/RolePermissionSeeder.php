<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // ============================================
        // 1. TẠO ROLES
        // ============================================
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Quản trị viên',
            'description' => 'Có toàn quyền quản lý hệ thống'
        ]);

        $staff = Role::create([
            'name' => 'staff',
            'display_name' => 'Nhân viên',
            'description' => 'Quản lý đơn hàng và sản phẩm'
        ]);

        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Khách hàng',
            'description' => 'Người dùng mua hàng'
        ]);

        // ============================================
        // 2. TẠO PERMISSIONS
        // ============================================
        $permissions = [
            ['name' => 'dashboard.view', 'display_name' => 'Xem Dashboard', 'group_name' => 'dashboard'],
            ['name' => 'products.view', 'display_name' => 'Xem sản phẩm', 'group_name' => 'products'],
            ['name' => 'products.create', 'display_name' => 'Thêm sản phẩm', 'group_name' => 'products'],
            ['name' => 'products.edit', 'display_name' => 'Sửa sản phẩm', 'group_name' => 'products'],
            ['name' => 'products.delete', 'display_name' => 'Xóa sản phẩm', 'group_name' => 'products'],
            ['name' => 'orders.view', 'display_name' => 'Xem đơn hàng', 'group_name' => 'orders'],
            ['name' => 'orders.edit', 'display_name' => 'Sửa đơn hàng', 'group_name' => 'orders'],
        ];

        foreach ($permissions as $perm) {
            Permission::create($perm);
        }

        // ============================================
        // 3. ASSIGN PERMISSIONS TO ROLES
        // ============================================
        
        // Admin có tất cả quyền
        $admin->permissions()->attach(Permission::all());

        // Staff có quyền hạn chế
        $staff->permissions()->attach(Permission::whereIn('name', [
            'dashboard.view',
            'products.view',
            'orders.view',
            'orders.edit'
        ])->get());
    }
}
