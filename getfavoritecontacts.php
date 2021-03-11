<?
$contact_id = $_POST['contact_id'];

$contact_id = explode('""', $contact_id);
//$totalKeywords = count($contact_id);

//print_r ($contact_id);
// Соединямся с БД
//echo $iname;
$link=mysqli_connect("localhost", "root", "root", "testbd");
// Получаем данные с БД
foreach ($contact_id as $key => $keyword) {
 //echo $keyword;
 $keyword = str_replace('"', '', $keyword);
 //echo $keyword;
 $sql = mysqli_query($link, "SELECT contact_id, contact_name, contact_phone FROM contact WHERE contact_id='".$keyword."'");
  while ($result = mysqli_fetch_array($sql)) {
    echo "<li id='{$result['contact_id']}'>{$result['contact_name']}: {$result['contact_phone']}</li>";
 }
  }

  
//   $sql = mysqli_query($link, "SELECT contact_id, contact_name, contact_phone FROM contact WHERE contact_id='".$keyword."'");
//   while ($result = mysqli_fetch_array($sql)) {
//    echo "<li id='{$result['contact_id']}'>{$result['contact_name']}: {$result['contact_phone']}<a class='add-to-favorite' href='#' rel='{$result['contact_id']}' >Добавить в избранное</a></li>";
//  }

?>