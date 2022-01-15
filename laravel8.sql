/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : laravel8

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2022-01-15 09:30:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `name_cn` varchar(255) DEFAULT NULL COMMENT 'Ó¢ÎÄÃû³Æ',
  `parent_id` int(11) DEFAULT '0' COMMENT '¸¸ÀàID',
  `author` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `created_at` (`created_at`),
  KEY `author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='²úÆ··ÖÀà';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Women\'s Fashion', '女人服装', '0', 'admin', '2022-01-12 09:41:16', '2022-01-12 09:41:16');
INSERT INTO `category` VALUES ('2', 'Men\'s Fashion', '男人服装', '0', 'admin', '2022-01-12 09:41:30', '2022-01-12 09:41:30');
INSERT INTO `category` VALUES ('3', 'Phones & Telecommunications', '手机&电子产品', '0', 'admin', '2022-01-12 09:42:13', '2022-01-12 09:42:13');
INSERT INTO `category` VALUES ('4', 'Toys , Kids & Babies', '玩具,小孩&婴儿', '0', 'admin', '2022-01-12 09:42:54', '2022-01-12 09:42:54');
INSERT INTO `category` VALUES ('5', 'Women\'s Fashion', '女装流行风格', '1', 'admin', '2022-01-12 09:43:44', '2022-01-12 09:43:44');
INSERT INTO `category` VALUES ('6', 'Bottoms', '打底裤', '1', 'admin', '2022-01-12 09:44:26', '2022-01-12 09:44:26');
INSERT INTO `category` VALUES ('7', 'Women\'s Underwear', '女人内衣', '1', 'admin', '2022-01-12 09:45:06', '2022-01-12 09:45:06');
INSERT INTO `category` VALUES ('8', 'Outerwear & Jackets', '外套和夹克', '2', 'admin', '2022-01-12 09:46:10', '2022-01-12 09:46:10');
INSERT INTO `category` VALUES ('9', 'Accessories', '休闲装', '2', 'admin', '2022-01-12 09:47:01', '2022-01-12 09:47:01');
INSERT INTO `category` VALUES ('10', 'Underwear & Loungewear', '内衣睡衣', '2', 'admin', '2022-01-12 09:47:38', '2022-01-12 09:47:38');
INSERT INTO `category` VALUES ('11', 'Mobile Phones', '手机', '3', 'admin', '2022-01-12 09:48:09', '2022-01-12 09:48:09');
INSERT INTO `category` VALUES ('12', 'Mobile Phone Accessories', '手机配件', '3', 'admin', '2022-01-12 09:48:37', '2022-01-12 09:48:37');
INSERT INTO `category` VALUES ('13', 'For Girls', '女孩产品', '4', 'admin', '2022-01-12 09:49:21', '2022-01-12 09:49:21');
INSERT INTO `category` VALUES ('14', 'For Boys', '男孩产品', '4', 'admin', '2022-01-12 09:49:48', '2022-01-12 09:49:48');
INSERT INTO `category` VALUES ('16', 'Inner0', '国产手机', '11', 'admin', '2022-01-13 01:19:05', '2022-01-14 04:02:33');

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('5', '2022_01_08_084527_create_permission_tables', '2');
INSERT INTO `migrations` VALUES ('6', '2022_01_14_072552_create_category_table', '0');
INSERT INTO `migrations` VALUES ('7', '2022_01_14_072552_create_failed_jobs_table', '0');
INSERT INTO `migrations` VALUES ('8', '2022_01_14_072552_create_model_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('9', '2022_01_14_072552_create_model_has_roles_table', '0');
INSERT INTO `migrations` VALUES ('10', '2022_01_14_072552_create_password_resets_table', '0');
INSERT INTO `migrations` VALUES ('11', '2022_01_14_072552_create_permissions_table', '0');
INSERT INTO `migrations` VALUES ('12', '2022_01_14_072552_create_personal_access_tokens_table', '0');
INSERT INTO `migrations` VALUES ('13', '2022_01_14_072552_create_products_table', '0');
INSERT INTO `migrations` VALUES ('14', '2022_01_14_072552_create_role_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('15', '2022_01_14_072552_create_roles_table', '0');
INSERT INTO `migrations` VALUES ('16', '2022_01_14_072552_create_users_table', '0');
INSERT INTO `migrations` VALUES ('17', '2022_01_14_072554_add_foreign_keys_to_model_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('18', '2022_01_14_072554_add_foreign_keys_to_model_has_roles_table', '0');
INSERT INTO `migrations` VALUES ('19', '2022_01_14_072554_add_foreign_keys_to_role_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('20', '2022_01_14_092610_create_category_table', '0');
INSERT INTO `migrations` VALUES ('21', '2022_01_14_092610_create_failed_jobs_table', '0');
INSERT INTO `migrations` VALUES ('22', '2022_01_14_092610_create_model_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('23', '2022_01_14_092610_create_model_has_roles_table', '0');
INSERT INTO `migrations` VALUES ('24', '2022_01_14_092610_create_password_resets_table', '0');
INSERT INTO `migrations` VALUES ('25', '2022_01_14_092610_create_permissions_table', '0');
INSERT INTO `migrations` VALUES ('26', '2022_01_14_092610_create_personal_access_tokens_table', '0');
INSERT INTO `migrations` VALUES ('27', '2022_01_14_092610_create_products_table', '0');
INSERT INTO `migrations` VALUES ('28', '2022_01_14_092610_create_role_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('29', '2022_01_14_092610_create_roles_table', '0');
INSERT INTO `migrations` VALUES ('30', '2022_01_14_092610_create_users_table', '0');
INSERT INTO `migrations` VALUES ('31', '2022_01_14_092612_add_foreign_keys_to_model_has_permissions_table', '0');
INSERT INTO `migrations` VALUES ('32', '2022_01_14_092612_add_foreign_keys_to_model_has_roles_table', '0');
INSERT INTO `migrations` VALUES ('33', '2022_01_14_092612_add_foreign_keys_to_role_has_permissions_table', '0');

-- ----------------------------
-- Table structure for `model_has_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
INSERT INTO `model_has_permissions` VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('4', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('5', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('7', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('8', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('12', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('16', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('17', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('18', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('19', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('20', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('21', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('22', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('23', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('24', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('25', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('26', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('28', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('29', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('30', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('31', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('32', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('33', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('34', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('35', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('36', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('40', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('41', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('42', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('43', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('44', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('45', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('46', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\User', '3');
INSERT INTO `model_has_permissions` VALUES ('40', 'App\\Models\\User', '3');
INSERT INTO `model_has_permissions` VALUES ('46', 'App\\Models\\User', '3');
INSERT INTO `model_has_permissions` VALUES ('1', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('4', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('5', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('7', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('8', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('12', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('16', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('17', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('18', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('19', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('20', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('21', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('22', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('23', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('24', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('25', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('26', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('28', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('29', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('30', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('31', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('32', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('33', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('34', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('35', 'App\\Models\\User', '17');
INSERT INTO `model_has_permissions` VALUES ('36', 'App\\Models\\User', '17');

-- ----------------------------
-- Table structure for `model_has_roles`
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` VALUES ('3', 'App\\Models\\User', '2');
INSERT INTO `model_has_roles` VALUES ('8', 'App\\Models\\User', '3');
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\User', '17');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限显示的名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应父类名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'system.manage', 'web', '2022-01-10 03:21:44', '2022-01-10 03:46:38', '系统管理', '0');
INSERT INTO `permissions` VALUES ('2', 'products.manage', 'web', '2022-01-10 03:24:59', '2022-01-10 03:24:59', '产品管理', '0');
INSERT INTO `permissions` VALUES ('4', 'warehouse.manage', 'web', '2022-01-10 05:53:41', '2022-01-10 05:55:48', '仓库管理', '0');
INSERT INTO `permissions` VALUES ('5', 'orders.manage', 'web', '2022-01-10 05:53:59', '2022-01-10 05:55:59', '订单管理', '0');
INSERT INTO `permissions` VALUES ('7', 'purchase.manage', 'web', '2022-01-10 05:56:34', '2022-01-10 05:56:34', '采购管理', '0');
INSERT INTO `permissions` VALUES ('8', 'admin.user', 'web', '2022-01-10 05:58:10', '2022-01-10 05:58:10', '系统用户管理', '1');
INSERT INTO `permissions` VALUES ('12', 'admin.role', 'web', '2022-01-10 06:06:56', '2022-01-10 06:06:56', '角色管理', '1');
INSERT INTO `permissions` VALUES ('16', 'admin.permission', 'web', '2022-01-11 03:45:38', '2022-01-11 03:45:38', '权限管理', '1');
INSERT INTO `permissions` VALUES ('17', 'admin.user.create', 'web', '2022-01-11 03:46:15', '2022-01-11 03:46:15', '添加用户', '8');
INSERT INTO `permissions` VALUES ('18', 'admin.user.destroy', 'web', '2022-01-11 03:47:06', '2022-01-11 03:47:06', '删除用户', '8');
INSERT INTO `permissions` VALUES ('19', 'admin.user.edit', 'web', '2022-01-11 03:47:31', '2022-01-11 03:47:31', '编辑用户', '8');
INSERT INTO `permissions` VALUES ('20', 'admin.user.assignRole', 'web', '2022-01-11 03:51:26', '2022-01-11 03:51:26', '给用户添加角色', '8');
INSERT INTO `permissions` VALUES ('21', 'admin.user.assignPermission', 'web', '2022-01-11 03:52:07', '2022-01-11 03:52:07', '给人员分配权限', '8');
INSERT INTO `permissions` VALUES ('22', 'admin.role.create', 'web', '2022-01-11 03:56:35', '2022-01-11 03:56:35', '添加角色', '12');
INSERT INTO `permissions` VALUES ('23', 'admin.role.edit', 'web', '2022-01-11 03:57:04', '2022-01-11 09:29:18', '编辑角色', '12');
INSERT INTO `permissions` VALUES ('24', 'admin.role.destroy', 'web', '2022-01-11 03:57:33', '2022-01-11 03:57:33', '删除角色', '12');
INSERT INTO `permissions` VALUES ('25', 'admin.role.assignPermission', 'web', '2022-01-11 03:58:16', '2022-01-11 03:58:16', '角色给予权限', '12');
INSERT INTO `permissions` VALUES ('26', 'admin.products', 'web', '2022-01-11 05:42:09', '2022-01-11 05:42:09', '产品列表管理', '2');
INSERT INTO `permissions` VALUES ('28', 'admin.warehouse', 'web', '2022-01-11 05:54:51', '2022-01-11 05:54:51', '仓库列表管理', '4');
INSERT INTO `permissions` VALUES ('29', 'admin.warehouse.stock', 'web', '2022-01-11 05:55:21', '2022-01-11 05:55:21', '仓库库存管理', '4');
INSERT INTO `permissions` VALUES ('30', 'admin.orders', 'web', '2022-01-11 05:55:57', '2022-01-11 05:55:57', '订单列表管理', '5');
INSERT INTO `permissions` VALUES ('31', 'admin.logistic', 'web', '2022-01-11 05:56:24', '2022-01-11 05:56:24', '订单物流管理', '5');
INSERT INTO `permissions` VALUES ('32', 'admin.purchase', 'web', '2022-01-11 05:56:45', '2022-01-11 05:56:45', '采购列表管理', '7');
INSERT INTO `permissions` VALUES ('33', 'admin.purchase.suppliers', 'web', '2022-01-11 05:57:07', '2022-01-11 05:57:07', '供应商管理', '7');
INSERT INTO `permissions` VALUES ('34', 'admin.permission.create', 'web', '2022-01-11 07:01:03', '2022-01-11 07:01:03', '添加新权限', '16');
INSERT INTO `permissions` VALUES ('35', 'admin.permission.edit', 'web', '2022-01-11 07:01:39', '2022-01-11 07:01:39', '编辑权限', '16');
INSERT INTO `permissions` VALUES ('36', 'admin.permission.destroy', 'web', '2022-01-11 08:20:11', '2022-01-11 08:20:11', '删除权限', '16');
INSERT INTO `permissions` VALUES ('40', 'admin.category', 'web', '2022-01-12 01:41:18', '2022-01-12 01:41:18', '分类管理', '2');
INSERT INTO `permissions` VALUES ('41', 'admin.products.create', 'web', '2022-01-12 01:41:49', '2022-01-12 01:41:49', '新增产品', '26');
INSERT INTO `permissions` VALUES ('42', 'admin.products.edit', 'web', '2022-01-12 01:42:17', '2022-01-12 01:42:17', '编辑产品', '26');
INSERT INTO `permissions` VALUES ('43', 'admin.products.destroy', 'web', '2022-01-12 01:42:44', '2022-01-12 01:42:44', '删除产品', '26');
INSERT INTO `permissions` VALUES ('44', 'admin.category.create', 'web', '2022-01-12 01:43:38', '2022-01-12 01:43:38', '新增产品分类', '40');
INSERT INTO `permissions` VALUES ('45', 'admin.category.edit', 'web', '2022-01-12 01:44:06', '2022-01-12 01:44:06', '编辑产品分类', '40');
INSERT INTO `permissions` VALUES ('46', 'admin.category.destroy', 'web', '2022-01-12 01:44:30', '2022-01-12 01:44:30', '删除产品分类', '40');

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `category_id` int(11) DEFAULT NULL COMMENT '·ÖÀàID',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `flag` tinyint(1) DEFAULT '1' COMMENT '1-ÆôÓÃ£¬0-¹Ø±Õ',
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `category_id` (`category_id`),
  KEY `flag` (`flag`),
  KEY `author` (`author`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='²úÆ·±í';

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'Women Turtleneck Oversized Knitted Dress Autumn Solid Long Sleeve Casual Elegant Mini Sweater Dress Plus Size Winter Clothes', 'kkkk111', 'Cheap Dresses, Buy Quality Women&#39;s Clothing Directly from China Suppliers:Women Turtleneck Oversized Knitted Dress Autumn Solid Long Sleeve Casual Elegant Mini Sweater Dress Plus Size Winter Clothes\r\nEnjoy ✓Free Shipping Worldwide! ✓Limited Time Sale ✓Easy Return.', '5', '11', 'images/20220113/20220113093121202201130931213628676.png', '1', 'admin', '2022-01-13 09:32:03', '2022-01-14 04:39:27');
INSERT INTO `products` VALUES ('2', 'Autumn Winter Women\'s Elegance Round Neck Long Sleeve Dress Solid Color Ruffle Dress Party Evening Vacation Dresses', 'kkk22222', 'Cheap Dresses, Buy Quality Women&#39;s Clothing Directly from China Suppliers:Vestido 2021 Autumn Winter Women&#39;s Elegance Round Neck Long Sleeve Dress Solid Color Ruffle Dress Party Evening Vacation Dresses\r\nEnjoy ✓Free Shipping Worldwide! ✓Limited Time Sale ✓Easy Return.', '5', '<p style=\"text-align: center;\">Pro Desc</p><p style=\"text-align: center;\"><img src=\"/images/20220114/20220114015937202201140159376044180.jpg\" title=\"\" alt=\"\"/></p>', 'images/20220113/20220113093425202201130934257390132.png', '1', 'admin', '2022-01-13 09:34:51', '2022-01-14 04:14:10');
INSERT INTO `products` VALUES ('3', '1Dulzura Solid Satin Women Long Sleeve V Neck Ruched Wrap Mini Dress Bodycon Sexy Party Elegant 2021 Autumn Winter Clothes', '2Dresses,Women\'s Clothing, Cheap Dresses,High Quality Women\'s Clothing,Dresses', '3Cheap Dresses, Buy Quality Women&#39;s Clothing Directly from China Suppliers:Dulzura Solid Satin Women Long Sleeve V Neck Ruched Wrap Mini Dress Bodycon Sexy Party Elegant 2021 Autumn Winter Clothes\r\nEnjoy ✓Free Shipping Worldwide! ✓Limited Time Sale ✓Easy Return.', '5', '<p style=\"text-align: center;\">Product Description</p><p><br/></p><p style=\"text-align: center;\"><img src=\"/images/20220113/20220113093901202201130939018067351.jpg\" title=\"\" alt=\"\"/></p><p><br/></p><p><br/></p><p style=\"text-align: center;\"><img src=\"/images/20220113/20220113093833202201130938331048296.jpg\" title=\"\" alt=\"\"/></p>', 'images/20220113/20220113093823202201130938232793434.png', '1', 'admin', '2022-01-13 09:39:12', '2022-01-14 04:36:43');
INSERT INTO `products` VALUES ('4', 'sfasd', 'sdfasdf', 'sdfasdf', '1', '<p>sdfa</p>', 'images/20220114/20220114044055202201140440558456572.png', '1', 'admin', '2022-01-14 04:37:06', '2022-01-14 04:40:56');
INSERT INTO `products` VALUES ('5', 'sdfasdf', 'sdfasdf', 'sfasdfa', '8', '<p>sdfasdf</p>', 'images/20220114/20220114044037202201140440373701196.jpg', '0', 'admin', '2022-01-14 04:37:19', '2022-01-14 04:40:39');
INSERT INTO `products` VALUES ('6', 'sdfasdf', 'sdfasdf', 'sdfasdfsdf', '10', '<p>sdfasdfsdf</p>', 'images/20220114/20220114044102202201140441027633456.jpg', '1', 'admin', '2022-01-14 04:37:28', '2022-01-14 05:54:38');
INSERT INTO `products` VALUES ('7', 'sdfasdf', 'sdfasdfsdf', 'sdfasdfsdf', '1', '<p>sdfasdfsdf</p>', 'images/20220114/20220114044046202201140440462448454.jpg', '0', 'admin', '2022-01-14 04:37:38', '2022-01-14 05:54:27');
INSERT INTO `products` VALUES ('9', 'sdfasdf', 'sdfasdfsdf', 'sdfasdf', '9', '<p>sdfasdf</p>', 'images/20220114/20220114044028202201140440284461512.jpg', '0', 'admin', '2022-01-14 04:38:11', '2022-01-14 04:40:29');
INSERT INTO `products` VALUES ('10', 'sdfasdfasdfsdf', 'sdfasdf', 'sdfasdfsdf', '13', '<p>sdfasdfsadfasdfsdf</p>', 'images/20220114/20220114044006202201140440064877611.png', '0', 'admin', '2022-01-14 04:38:24', '2022-01-14 04:40:08');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超级管理员', 'web', '2022-01-08 09:18:27', '2022-01-10 06:19:35');
INSERT INTO `roles` VALUES ('2', '产品总监', 'web', '2022-01-08 09:18:54', '2022-01-08 09:18:54');
INSERT INTO `roles` VALUES ('3', '产品经理', 'web', '2022-01-08 09:19:01', '2022-01-08 09:19:01');
INSERT INTO `roles` VALUES ('4', '仓库经理', 'web', '2022-01-08 09:19:33', '2022-01-11 05:58:24');
INSERT INTO `roles` VALUES ('5', '仓库主管', 'web', '2022-01-08 09:19:55', '2022-01-11 05:58:44');
INSERT INTO `roles` VALUES ('6', '仓库文员', 'web', '2022-01-08 09:20:13', '2022-01-11 05:58:55');
INSERT INTO `roles` VALUES ('7', '销售总监', 'web', '2022-01-08 09:20:25', '2022-01-11 05:59:15');
INSERT INTO `roles` VALUES ('8', '销售经理', 'web', '2022-01-08 09:20:58', '2022-01-11 05:59:26');
INSERT INTO `roles` VALUES ('9', '销售主管', 'web', '2022-01-08 09:21:48', '2022-01-11 05:59:39');
INSERT INTO `roles` VALUES ('11', '销售组长', 'web', '2022-01-08 09:22:16', '2022-01-11 05:59:56');
INSERT INTO `roles` VALUES ('17', '销售员工', 'web', '2022-01-11 06:00:13', '2022-01-11 06:00:13');
INSERT INTO `roles` VALUES ('18', '采购总监', 'web', '2022-01-11 06:00:39', '2022-01-11 06:00:39');
INSERT INTO `roles` VALUES ('19', '采购经理', 'web', '2022-01-11 06:00:48', '2022-01-11 06:00:48');
INSERT INTO `roles` VALUES ('20', '采购主管', 'web', '2022-01-11 06:00:56', '2022-01-11 06:00:56');
INSERT INTO `roles` VALUES ('21', '采购组长', 'web', '2022-01-11 06:01:03', '2022-01-11 06:01:03');
INSERT INTO `roles` VALUES ('22', '采购员工', 'web', '2022-01-11 06:01:11', '2022-01-11 06:01:11');
INSERT INTO `roles` VALUES ('24', '测试组', 'web', '2022-01-12 03:38:43', '2022-01-12 03:38:43');

-- ----------------------------
-- Table structure for `role_has_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('1', '1');
INSERT INTO `role_has_permissions` VALUES ('2', '1');
INSERT INTO `role_has_permissions` VALUES ('4', '1');
INSERT INTO `role_has_permissions` VALUES ('5', '1');
INSERT INTO `role_has_permissions` VALUES ('7', '1');
INSERT INTO `role_has_permissions` VALUES ('8', '1');
INSERT INTO `role_has_permissions` VALUES ('12', '1');
INSERT INTO `role_has_permissions` VALUES ('16', '1');
INSERT INTO `role_has_permissions` VALUES ('17', '1');
INSERT INTO `role_has_permissions` VALUES ('18', '1');
INSERT INTO `role_has_permissions` VALUES ('19', '1');
INSERT INTO `role_has_permissions` VALUES ('20', '1');
INSERT INTO `role_has_permissions` VALUES ('21', '1');
INSERT INTO `role_has_permissions` VALUES ('22', '1');
INSERT INTO `role_has_permissions` VALUES ('23', '1');
INSERT INTO `role_has_permissions` VALUES ('24', '1');
INSERT INTO `role_has_permissions` VALUES ('25', '1');
INSERT INTO `role_has_permissions` VALUES ('26', '1');
INSERT INTO `role_has_permissions` VALUES ('28', '1');
INSERT INTO `role_has_permissions` VALUES ('29', '1');
INSERT INTO `role_has_permissions` VALUES ('30', '1');
INSERT INTO `role_has_permissions` VALUES ('31', '1');
INSERT INTO `role_has_permissions` VALUES ('32', '1');
INSERT INTO `role_has_permissions` VALUES ('33', '1');
INSERT INTO `role_has_permissions` VALUES ('34', '1');
INSERT INTO `role_has_permissions` VALUES ('35', '1');
INSERT INTO `role_has_permissions` VALUES ('36', '1');
INSERT INTO `role_has_permissions` VALUES ('40', '1');
INSERT INTO `role_has_permissions` VALUES ('41', '1');
INSERT INTO `role_has_permissions` VALUES ('42', '1');
INSERT INTO `role_has_permissions` VALUES ('43', '1');
INSERT INTO `role_has_permissions` VALUES ('44', '1');
INSERT INTO `role_has_permissions` VALUES ('45', '1');
INSERT INTO `role_has_permissions` VALUES ('46', '1');
INSERT INTO `role_has_permissions` VALUES ('1', '3');
INSERT INTO `role_has_permissions` VALUES ('2', '3');
INSERT INTO `role_has_permissions` VALUES ('4', '3');
INSERT INTO `role_has_permissions` VALUES ('5', '3');
INSERT INTO `role_has_permissions` VALUES ('7', '3');
INSERT INTO `role_has_permissions` VALUES ('8', '3');
INSERT INTO `role_has_permissions` VALUES ('12', '3');
INSERT INTO `role_has_permissions` VALUES ('17', '3');
INSERT INTO `role_has_permissions` VALUES ('18', '3');
INSERT INTO `role_has_permissions` VALUES ('19', '3');
INSERT INTO `role_has_permissions` VALUES ('20', '3');
INSERT INTO `role_has_permissions` VALUES ('21', '3');
INSERT INTO `role_has_permissions` VALUES ('22', '3');
INSERT INTO `role_has_permissions` VALUES ('23', '3');
INSERT INTO `role_has_permissions` VALUES ('24', '3');
INSERT INTO `role_has_permissions` VALUES ('25', '3');
INSERT INTO `role_has_permissions` VALUES ('1', '8');
INSERT INTO `role_has_permissions` VALUES ('2', '8');
INSERT INTO `role_has_permissions` VALUES ('5', '8');
INSERT INTO `role_has_permissions` VALUES ('8', '8');
INSERT INTO `role_has_permissions` VALUES ('20', '8');
INSERT INTO `role_has_permissions` VALUES ('26', '8');
INSERT INTO `role_has_permissions` VALUES ('30', '8');
INSERT INTO `role_has_permissions` VALUES ('31', '8');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin@qq.com', null, '$2y$10$11EVBAN43D1K3BegO4e.0erYO3LNb6NABHHrX78g5CMey9b.X/Wty', null, '2022-01-08 02:37:45', '2022-01-08 02:37:45');
INSERT INTO `users` VALUES ('2', 'root', 'root@qq.com', null, '$2y$10$v7tZQj952WP3LKm9hdpugODmzDqTFLjGkUceaffNVrCCfd6uK9qL.', null, '2022-01-08 02:38:50', '2022-01-08 02:38:50');
INSERT INTO `users` VALUES ('3', 'lin3615', 'lin3615@qq.com', null, '$2y$10$UNlml.7ZHsAz67RlM8m7NuksPWrVrUKbK5ebcv/Mnb/3a0kZgQLaS', null, '2022-01-08 07:59:36', '2022-01-08 07:59:36');
INSERT INTO `users` VALUES ('9', '97899@qq.com', '97899@qq.com', null, '$2y$10$n0T.YAvONzU25g8CAWbYROIdnxIE0n9hie/s86YmE17JRa6vBisP2', null, '2022-01-08 08:11:58', '2022-01-08 08:11:58');
INSERT INTO `users` VALUES ('10', 'a97899@qq.com', 'a97899@qq.com', null, '$2y$10$24Vns715eDYuv37qeQZ6UuFplklpTUCk.i99s6Bny.rDigenRschO', null, '2022-01-08 08:12:12', '2022-01-08 08:12:12');
INSERT INTO `users` VALUES ('11', 'aa97899@qq.com', 'aa97899@qq.com', null, '$2y$10$qwfNktya71fafwIRl9llmOGuM2VhD7QlmOg1n1qpx.Y/WsT2BhNtu', null, '2022-01-08 08:12:29', '2022-01-08 08:12:29');
INSERT INTO `users` VALUES ('12', 'aa97899xx@qq.com', 'aa97899xx@qq.com', null, '$2y$10$k25m5Qkg8p4AK1WC2H7iBeJi4MXs2ALur8aWR/oPo.fldn9E5aruq', null, '2022-01-08 08:12:41', '2022-01-08 08:12:41');
INSERT INTO `users` VALUES ('17', 'yes_or_no', 'yesno@qq.com', null, '$2y$10$YvjS/OLHfiO3DFSbG0rdZu6HrxZkU61D6oj8lUu7kpYfbp7fPE3ze', null, '2022-01-11 09:30:24', '2022-01-11 09:31:09');
