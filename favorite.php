<?
$like = $_POST['like'];
$active = $_POST['active'];
$user_id = $_POST['user_id'];
$link=mysqli_connect("localhost", "root", "root", "testbd");

// Получаем данные с БД
$sql = mysqli_query($link, "INSERT INTO favorite SET contact_id='".$like."', user_id='".$user_id."'"); 
//смотрю какой параметр передан
if($active == "0"){
        if (!isset($_SESSION['count'])){
            $number[0] = $like; 
            $_SESSION['count'] = $number;
            while ($result = mysqli_fetch_array($sql)) {
    echo "<li id='{$result['contact_id']}'>{$result['contact_name']}: {$result['contact_phone']}<a class='add-to-favorite' href='#' rel='{$result['contact_id']}' >Убрать из избранного</a></li>";
  } 
        }else{          
            array_push($_SESSION['count'], $like);

        }
    }else{  
        $key = array_search($like, $_SESSION['count']);
        $array=$_SESSION['count'];
        unset($array[$key]);
        $i = 0;
        foreach($array as $k1 => $v1){
            $newarray[$i++]= $v1;   
        }
 
        $_SESSION['count'] = $newarray;
        exit();
    }
?>