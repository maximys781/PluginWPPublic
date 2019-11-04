<?php
/*
 Plugin name: Pictures
Description: Плагин для добавления картин, фильтрации и удаления
Author: Max
 */


//хук для автоматического инсталла таблицы, когда плагин устанавливается
register_activation_hook(__FILE__,'auto_install');
function auto_install(){
    global $wpdb;
    $tblname = $wpdb->prefix . "pic1";//добавляем префикс к таблице
    $tblname2 = $wpdb->prefix . "hal1";
    if ($wpdb->get_var("SHOW TABLES LIKE '$tblname'") != $tblname) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');//если таблица отсутсвует, то подключаем файл upgrade, который поможет нам создать таблицы
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
// подключаем файл нужный для работы с bd
// запрос на создание
        $sql = "CREATE TABLE {$tblname} (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
namepic VARCHAR(45) NOT NULL,
descrpic VARCHAR(45) NOT NULL,
pricepic INT NOT NULL,
hallpic INT NOT NULL
  
 ){$charset_collate};
  UNIQUE INDEX id_UNIQUE(id ASC) ,
  UNIQUE INDEX namepic_UNIQUE(namepic ASC)
  
  CONSTRAINT fk_Pictures_Halls
    FOREIGN KEY (halls1_id , halls1_namepic )
    REFERENCES halls (id , namepic )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    ";


        dbDelta($sql);
    }
    if ($wpdb->get_var("SHOW TABLES LIKE '$tblname2'") != $tblname2) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
        $sql2= "CREATE TABLE {$tblname2} (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
namepic VARCHAR(45) NOT NULL KEY,
numhall INT NOT NULL
){$charset_collate};
UNIQUE PRIMARY KEY(id, namepic),
KEY namepic(namepic)
    ";

        dbDelta($sql2);
    }


}
//хук для деинсталла таблицы, когда плагин удаляется
register_uninstall_hook(__FILE__,'auto_deinstall');

function auto_deinstall(){
    global $wpdb;
    $tblname = $wpdb->prefix . "pic1";
    $tblname2 = $wpdb->prefix . "hall1";
    $wpdb->query('DROP TABLE IF EXISTS' .$tblname);
    $wpdb->query('DROP TABLE IF EXISTS' .$tblname2);

}

require_once plugin_dir_path(__FILE__) . 'includes/func.php'; //через функцию WP говорим о том, что в этом каталоге у нас лежит подкаталог, где хранится файл с функциями
