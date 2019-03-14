<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt,
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'wordpress' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'c=9 *((D<_K5F^j>ROpb7roY|@RojNL<3*TE|6eIkb{~[] 8J9nB[qCL2T_{&AH=' );
define( 'SECURE_AUTH_KEY',  ') J16_?}?p[0sD*MaCU8tgJr[Yz,*af$Jo0Fui^;_R,U=r*<,vLz0:Wa/AS1=4^-' );
define( 'LOGGED_IN_KEY',    'Ft#y{kC-?r+*$!qIRz|.9Ry&F3$?p)S|] 3NL9#?C8udJ^}z)h%A!=XAhU<J!ruR' );
define( 'NONCE_KEY',        '*qPkF u&mu1S`ZbFkm@,,kS$+NAXMIGCmV=e1q3k!Q[L}-&</#-$Y!ddPSidTBT<' );
define( 'AUTH_SALT',        '[vAMD;2@%3x1V|t4bx%WULwp%4/-OyLq?ix1;<,_>qJ)!i/ZOsTq_^*ZD8irh3x;' );
define( 'SECURE_AUTH_SALT', 'J&kqc+4iW4=cdI*^1Y5>6u{xm(Sc;<6C=6hAs$@r}x,bi7<-;mNH@_5r;k`w9Ff)' );
define( 'LOGGED_IN_SALT',   'x.5wV=*H rH[$$E(U<@R)Fo=`d*{? a5ASfqd?Kh.!s{$S^apSTLycp&mR +2}Ld' );
define( 'NONCE_SALT',       'g56ZKlVQ<SBM[y(F&]83YgDqoR^F`tQ;=la1<,`y9;41-`Y*H|aAkc6#O5DSJ&T|' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
