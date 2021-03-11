<?

// Соединямся с БД
$link=mysqli_connect("localhost", "root", "root", "testbd");
// Получаем данные с БД
$sql = mysqli_query($link, 'SELECT `contact_id`, `contact_name`, `contact_phone` FROM `contact`');

while ($result = mysqli_fetch_array($sql)) {
    echo "<li id='{$result['contact_id']}'>{$result['contact_name']}: {$result['contact_phone']}<a class='add-to-favorite' href='#' rel='{$result['contact_id']}' >Добавить в избранное</a></li>";
  }
?>