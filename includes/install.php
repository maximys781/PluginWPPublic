<?php

register_activation_hook(__FILE__,'auto_install');
function auto_install(){
    global $wpdb;
    $tblname = $wpdb->prefix . "onlyone111";
    $tblname2 = $wpdb->prefix . "halls1";
    if ($wpdb->get_var("SHOW TABLES LIKE '$tblname'") != $tblname) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
// подключаем файл нужный для работы с bd
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
// запрос на создание
        $sql = "CREATE TABLE {$tblname} (
id int(11) unsigned NOT NULL auto_increment,
name varchar(255) NOT NULL default '',
price int(11) unsigned NOT NULL default '0',
PRIMARY KEY  (id),
KEY price (price)
) {$charset_collate};";
       /* $sql = "CREATE TABLE " .$tblname. " (
	  id int(45) NOT NULL AUTO_INCREMENT,
namepic varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  descrpic varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  pricepic int(45) NOT NULL
	);";*/
	
	/*ALTER TABLE .$tblname
	ADD PRIMARY KEY (id),
	ADD KEY pic_index(namepic)
	
	CREATE TABLE " . $tblname2 . " (
	  id int(45) NOT NULL AUTO_INCREMENT,
namepic varchar(45) CHARACTER SET utf8mb4 NOT NULL,
numhall int(11) NOT NULL
	);
	
	ALTER TABLE .$tblname2
	ADD PRIMARY KEY (id,namepic),
	ADD KEY namepic(namepic)
	
	ALTER TABLE .$tblname2
  ADD CONSTRAINT Halls_ibfk_1 FOREIGN KEY (namepic) REFERENCES .$tblname.(namepic),
COMMIT*/
	


        dbDelta($sql);

    }
}



register_uninstall_hook(__FILE__,'auto_deinstall');

function auto_deinstall(){
    global $wpdb;
    $tblname = $wpdb->prefix . "pictures1";
    $tblname2 = $wpdb->prefix . "halls1";
    $wpdb->query('DROP TABLE IF EXISTS' .$tblname);
    $wpdb->query('DROP TABLE IF EXISTS' .$tblname2);

}
