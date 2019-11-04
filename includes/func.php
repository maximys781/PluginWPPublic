<?php
//namespace PicPlug;
class PicPlug
{

    public function __construct()
    {
       add_action('wp_enqueue_scripts',array($this,'special_plugin_styles'));
        //add_action('admin_menu', 'func_add_admin_link');
        add_shortcode('showpic',array($this,'showpic_func'));

    }

    public function special_plugin_styles()
       {
           wp_register_style( 'my-plugin', plugins_url( 'Pictures/includes/css/style.css') );
           wp_register_style( 'my-plugin2', plugins_url( 'Pictures/includes/css/stylesearch.css') );
           wp_register_style( 'my-plugin3', plugins_url( 'Pictures/includes/css/stylefilter.css') );
           wp_register_style( 'my-plugin4', plugins_url( 'Pictures/includes/css/styledelete.css') );
           wp_enqueue_style( 'my-plugin','my-plugin2','my-plugin3','my-plugin4');
       }




    /*public  function func_add_admin_link()
      { //функция для добавления ссылки на страницу в меню
          add_menu_page( //WP функция для добавления меню
              'Плагин картины',// Название страницы
              'Плагин картины',// Текст ссылки в меню
              'manage_options',//привелегии на просмотр
              'Pictures/includes/main.php'// ссылка на файл со страницей
          );
      }*/


// Обычный шоткод
    public function showpic_func()
    {


//подключение к БД
        $host = 'localhost';
        $db = 'root';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
        try {
            $dbh = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
        /////////////////////////////////////////////////
        /*Поиск*/

        $sendsearch = $_GET['srch'];

        if (isset($sendsearch)) {
            $search = $_GET['searchpic'];
            $srchzapr = $pdo->prepare('SELECT id,namepic,descrpic,pricepic,hallpic FROM wp_pic1 WHERE namepic=:namepic');
            $srchzapr->execute([':namepic' => $search]);
            //$results2=$srchzapr-fetchAll(PDO::FETCH_OBJ);
            echo "
<table width='100%' border='3'>
<thead>
<th>№</th>
<th>Название</th>
<th>Описание картины</th>
<th>Цена картины</th>
<th>Зал</th>
</thead>
";
        }
        foreach ($srchzapr as $row2) {
            $row2['id'];
            $row2['namepic'];
            $row2['descrpic'];
            $row2['pricepic'];
            $row2['hallpic'];
            echo "<tbody>
<tr>
  <td>" . $row2['id'] . "</td>
    <td>" . $row2['descrpic'] . "</td>
      <td>" . $row2['pricepic'] . "</td>
        <td>" . $row2['hallpic'] . "</td>
  </tr>
</tbody>";
        }

        echo "<form action='' method='get'> 
 <label for='searchpic' id='search1'>Поиск </label><br> 
     <input type='text' name='searchpic' id='searchpic'>
     <button type='submit' name='srch' id='srch'>Найти</button>
    </form>";
        /*Поиск*/
////////////////////////////////////////////


        /*Фильтр*/
////////////////////////////////////////////
        $filter = $_GET['filter'];

        if (isset($filter)) { //

            $value1 = $_GET['hallnum'];

            $filterzapr = $pdo->prepare('SELECT id,namepic,descrpic,pricepic,hallpic FROM wp_pic1 WHERE hallpic=:hallpic1');
            $filterzapr->execute([':hallpic1' => $value1]);

            echo "
            <div class='filtab'>
<table width='100%' border='3'>
<thead>
<th>№</th>
<th>Название</th>
<th>Описание картины</th>
<th>Цена картины</th>
<th>Зал</th>
</thead>
";
        }
        foreach ($filterzapr as $row3) {
            $row3['id'];
            $row3['namepic'];
            $row3['descrpic'];
            $row3['pricepic'];
            $row3['hallpic'];
            echo "<tbody>
<tr>
  <td>" . $row3['id'] . "</td>
    <td>" . $row3['descrpic'] . "</td>
      <td>" . $row3['pricepic'] . "</td>
        <td>" . $row3['hallpic'] . "</td>
  </tr>
</tbody></div>";
        }

        echo " <form action='' method='get'> 

 <label for='hal' id='filter1'>Фильтр </label>
                                <select name='hallnum' id='hal'>
                                <option disabled>Выберите зал:</option>
                                    <option name='hall1num' value='1'>Зал №1</option>
                                    <option name='hallnum'  value='2'>Зал №2</option>
                                    <option name='hallnum' value='3'>Зал №3</option>
                                    <option name='hallnum' value='4'>Зал №4</option>
                                </select>
                                <button type='submit' name='filter' id='filter'>Выполнить</button>
                                </form>";


        /*Фильтр*/
////////////////////////////////////////////


        /*Отрисовка таблицы*/
        $senzapr = $pdo->query('SELECT id,namepic,descrpic,pricepic,hallpic FROM wp_pic1');
        $data = $senzapr->fetchAll(PDO::FETCH_ASSOC);

//вывод таблицы с данными
        echo "
<table width='100%' border='3'>
<thead>
<th>№</th>
<th>Название</th>
<th>Описание картины</th>
<th>Цена картины</th>
<th>Зал</th>
</thead>
";
        foreach ($data as $row1) {

            $row1['id'];
            $row1['namepic'];
            $row1['descrpic'];
            $row1['pricepic'];
            $row1['hallpic'];
            echo "<tbody>
<tr>
<td>" . $row1['id'] . "</td>
  <td>" . $row1['namepic'] . "</td>
    <td>" . $row1['descrpic'] . "</td>
      <td>" . $row1['pricepic'] . "</td>
        <td>" . $row1['hallpic'] . "</td>
  </tr>
</tbody>";

            //$ell = $array['namepic'];
        }


        /*Отрисовка таблицы*/
//////////////////////////////////////////////////////

        /* Начинается раздел вставки данных */
        $name = $_POST['namepic'];
        $descr = $_POST['descrpic'];
        $price = $_POST['pricepic'];
        $hall = $_POST['hallpic'];


        $insert = $_POST['send'];
        if (isset($insert)) {

            $insert = $pdo->exec('INSERT INTO wp_pic1 (namepic,descrpic,pricepic,hallpic) VALUES(' . $pdo->quote($name) . ',' . $pdo->quote($descr) . ',' . $pdo->quote($price) . ', ' . $pdo->quote($hall) . ')');

            //echo $insert;
        }


        echo "<div class='insaall'>

<form action='' method='post'> 
 <label for='name' id='name1'>Название картины </label><br> 
     <input type='text' name='namepic' id='name'>
     <label for='descr1' id='opisanie1'>Описание картины </label><br>
     <textarea type='text' name='descrpic' id='descr'></textarea>
     <label for='price' id='price1'>Цена картины(Руб.)</label><br>
     <input type='text' name='pricepic' id='price'>
     <label for='hall' id='hall1'>Зал</label>
    <input type='text' name='hallpic' id='hall'>

     <button type='submit' name='send' id='send'>Вставить</button>
    </form>
    </div>";

        /* Начинается раздел вставки данных */
        ///////////////////////////////////
        ///
        ///
        /* Удаление элемента */



        /* $delete = $_POST['delete'];

    if (isset($delete)) { //

        $valuedlt = $_POST['idpic'];

        $deleterzapr = $pdo->prepare('DELETE id FROM wp_pic1 WHERE id=:id');
        $deleterzapr->execute([':id' => $valuedlt]);*/ //не до конца реализовано

        echo "<div class='insaall1'>

<form action='' method='post'> 
 <label for='id' id='id1'>ID картины </label><br> 
     <input type='text' name='idpic' id='id'>
     <button type='submit' name='delete' id='delete'>Удалить</button>
    </form>
    </div>";

        /* Удаление элемента */

    }

}
function remove_sc_ver( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', 'remove_sc_ver', 15, 1 );
add_filter( 'style_loader_src', 'remove_sc_ver', 15, 1 );
new PicPlug();





