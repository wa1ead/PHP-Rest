<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
#--------------------------------------------------------
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
#--------------------------------------------------------
    $database= new DataBase();
    $db= $database->connect();
#--------------------------------------------------------
    $category= new Category($db);
#--------------------------------------------------------
    $result= $category->read();
#--------------------------------------------------------
    $num= $result->rowCount();
#--------------------------------------------------------
    if($num > 0){
        $catg_arr= array();
        $catg_arr['data']= array();
#--------------------------------------------------------
    while($row= $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
#--------------------------------------------------------        
        $catg_item= array(
            'id'=> $id,
            'name'=> $name
        );
#--------------------------------------------------------
    array_push($catg_arr['data'], $catg_item);
    }
#--------------------------------------------------------
    echo json_encode($catg_arr);
#--------------------------------------------------------
    }else{
        echo json_encode(array('Message'=> 'No Categories Found'));
    }
?>