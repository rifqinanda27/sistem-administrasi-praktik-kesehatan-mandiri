

-- ==================Table: menus================== 

INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('1', 'Menu Manajemen', '#', '', '', '0', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('2', 'Dashboard', 'home', 'fas fa-home', '', '1', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('3', 'Manajemen Pengguna', '#', 'fas fa-users-cog', '', '1', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('4', 'Kelola Pengguna', 'manage-user', '', '', '3', '1');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('5', 'Kelola Role', 'manage-role', '', '', '3', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('6', 'Kelola Menu', 'manage-menu', '', '', '3', '3');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('7', 'Backup Server', '#', '', '', '0', '2');
INSERT INTO `menus` (`id`, `nama_menu`, `url`, `icon`, `id_html`, `parent_id`, `urutan`) VALUES ('8', 'Backup Database', 'dbbackup', 'fas fa-database', '', '7', '1');


-- ==================Table: migrations================== 

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2024_01_01_234158_create_menus_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2024_02_02_053619_create_permission_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2024_02_03_232722_create_role_has_menus_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2024_02_03_235312_add_menu_id_on_permission', '1');


-- ==================Table: model_has_roles================== 

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('1', 'App\\Models\\User', '1');


-- ==================Table: permissions================== 

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('1', 'create_user', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('2', 'read_user', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('3', 'update_user', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('4', 'delete_user', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '4');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('5', 'create_role', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('6', 'read_role', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('7', 'update_role', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('8', 'delete_role', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '5');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('9', 'create_menu', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('10', 'read_menu', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('11', 'update_menu', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('12', 'delete_menu', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '6');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `menu_id`) VALUES ('13', 'backup_database', 'web', '2025-04-15 20:08:39', '2025-04-15 20:08:39', '8');


-- ==================Table: role_has_menus================== 

INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('1', '1', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('2', '2', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('3', '3', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('4', '4', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('5', '5', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('6', '6', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('7', '7', '1');
INSERT INTO `role_has_menus` (`id`, `menu_id`, `role_id`) VALUES ('8', '8', '1');


-- ==================Table: role_has_permissions================== 

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('2', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('3', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('4', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('5', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('7', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('8', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('11', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('13', '1');


-- ==================Table: roles================== 

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'superadmin', 'web', '2025-04-15 20:08:41', '2025-04-15 20:08:41');


-- ==================Table: users================== 

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Super Admin', 'superadmin@gmail.com', '2025-04-15 20:08:41', '$2y$10$.KLeYpAQPkV143M88ALDY.H./0ejk0Z0kANkC7RG6C3Hut8aRxkmu', '0BMElJZQnO', '2025-04-15 20:08:41', '2025-04-15 20:08:41');
