<?

$user_id = $_POST['user_id'];
// Соединямся с БД
$link=mysqli_connect("localhost", "root", "root", "testbd");
// Получаем данные с БД
$sql = mysqli_query($link, "SELECT favorite_id, contact_id, user_id FROM favorite WHERE user_id='".$user_id."'");
$arr = [];
while ($result = mysqli_fetch_array($sql)) {
   //print_r($result[contact_id]);
   array_push($arr, $result[contact_id]);
   
  }
  //print_r($arr);
  $result = array_unique($arr);
  foreach ($result as $key => $keyword) {
    echo json_encode($keyword);
    }
	
?>