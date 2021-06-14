<?php
if(isset($_POST['id'])) {
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)) {
        echo 'error';
    }else {
        $todos = $pdo->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uchecked = $checked ? 0 : 1;

        $res = $pdo->query("UPDATE todos SET checked=$uchecked WHERE id=$uId");
        if($res){
            echo $checked;
        }else{
            echo 'error';
        }

        
        $pdo = null;
        exit();
    }
}else{
    header("Location: ../index.php?mess=error");
}