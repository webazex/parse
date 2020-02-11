<html>
<head>
    <title>Парсер v. 0.8</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p class="desc">
        Парсер выкидывает 100 раз по 11 элементов, так как на странице акции присутствует ajax-пагинация,
        и за 1 раз она выводит ровно 11 записей, а максимальное количество страниц = 100. В идеале конечно еще смотреть
        через ajax максимальное количество страниц в пагинации,
        и добавлять это число в скрипт и дальше парсить. Также под конец пришла идея сделать скрипт типа portable version.
        То есть
        дасть возможность развернуть его на хосте, с указанием доступа к базе данных, соответствующими проверками на
        пустоту, наличием
        данных и прочее - но за оставшеея время вряд-ли успею толково сделать.
    </p>

    <form class="start-parser" method="POST" action="">
        <p class="start-parser__question">Запустить парсер?</p>
        <div class="start-parser__row">
            <span>
                <input type="radio" name="Y" value="Y">Да
            </span>
            <span>
                <input type="radio" name="N" value="N">Нет
            </span>            
            <button class="start-parser__btn-submit">Отправить</button>
        </div>
    </form>
    <?php
/**
 * Created by PhpStorm.
 * User: Webazex
 * Date: 07.02.2020s
 * Time: 16:19
 */
if ($_POST['N'] == "N" or empty($_POST)) {
    echo '<span class="red-alert">Парсер не запущен, ожидает команды</span>';
} elseif ($_POST['Y'] == "Y"){
    require_once('bd.php');
    $bd = new bd;

    $bd->setHost('mysql.zzz.com.ua');
    $bd->setUser('Atos');
    $bd->setPassword('BDPass*001');
    $bd->setBd('webazex');

    for ($i = 1; $i <= 100; $i++) {
        $href = 'https://rozetka.com.ua/news-articles-promotions/promotions/page=' . $i . ';scroll=true/';
        $ch = curl_init($href);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cook.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cook.txt');
        $html = curl_exec($ch);
        $connect = $bd->getConnectRezult();
        $bd->insertInTable('parser', 'akcija', $html);
        curl_close($ch);
    }

    $rezult = $bd->getFromTable('parser', 'akcija');
}
?>
</body>
</html>

