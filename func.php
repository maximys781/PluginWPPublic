<?php
//namespace PicPlug;
class PicPlug
{

    public function __construct()
    {
       add_action('wp_enqueue_scripts',array($this,'special_plugin_styles'));
        //add_action('admin_menu', 'func_add_admin_link');
        add_shortcode('showpic',array($this,'showpic_func'));
/*$a->special_plugin_styles();
$b->func_add_admin_link();
$c->showpic_func();*/
    }
    public function special_plugin_styles()
       {
           wp_register_style( 'my-plugin', plugins_url( 'Pictures/includes/css/style.css') );
           wp_enqueue_style( 'my-plugin');
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

         $sendsearch=$_GET['srch'];

        if(isset($sendsearch)) {
            $search=$_GET['searchpic'];
            $srchzapr = $pdo->prepare('SELECT namepic,descrpic,pricepic,hallpic FROM wp_pic1 WHERE namepic=:namepic');
            $srchzapr->execute([':namepic'=>$search]);
            //$results2=$srchzapr-fetchAll(PDO::FETCH_OBJ);
            echo "
<table width='100%' border='3'>
<thead>
<th>Название</th>
<th>Описание картины</th>
<th>Цена картины</th>
<th>Зал</th>
</thead>
";
        }
     foreach ($srchzapr as $row2)
        {
            $row2['namepic'];
            $row2['descrpic'];
            $row2['pricepic'];
            $row2['hallpic'];
            echo "<tbody>
<tr>
  <td>" . $row2['namepic'] . "</td>
    <td>" . $row2['descrpic'] . "</td>
      <td>" . $row2['pricepic'] . "</td>
        <td>" . $row2['hallpic'] . "</td>
  </tr>
</tbody>";
        }

        echo "<form action='' method='get'> 
 <label for='search' id='search1'>Поиск </label><br> 
     <input type='text' name='searchpic' id='search'>
   

     <button type='submit' name='srch' id='srch'>Найти</button>
    </form>";
        /*Поиск*/
////////////////////////////////////////////


        /*Фильтр*/
////////////////////////////////////////////


        /*Фильтр*/
////////////////////////////////////////////


        /*Отрисовка таблицы*/
        $senzapr = $pdo->query('SELECT namepic,descrpic,pricepic,hallpic FROM wp_pic1');
        $data = $senzapr->fetchAll(PDO::FETCH_ASSOC);

//вывод таблицы с данными
        echo "
<table width='100%' border='3'>
<thead>
<th>Название</th>
<th>Описание картины</th>
<th>Цена картины</th>
<th>Зал</th>
</thead>
";
        foreach ($data as $row1) {

            $row1['namepic'];
            $row1['descrpic'];
            $row1['pricepic'];
            $row1['hallpic'];
            echo "<tbody>
<tr>
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


        echo "<form action='' method='post'> 
 <label for='name' id='name1'>Название картины </label><br> 
     <input type='text' name='namepic' id='name'>
     <label for='descr1' id='opisanie1'>Описание картины </label><br>
     <textarea type='text' name='descrpic' id='descr'></textarea>
     <label for='price' id='price1'>Цена картины(Руб.)</label><br>
     <input type='text' name='pricepic' id='price'>
     <label for='hall' id='hall1'>Зал</label>
    <input type='text' name='hallpic' id='hall'>

     <button type='submit' name='send' id='send'>Вставить</button>
    </form>";

        /* Начинается раздел вставки данных */

    }
}
new PicPlug();








