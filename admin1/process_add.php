<?php
include("../connect/connect.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["MaTL"]) && isset($_POST["TenTL"])){
        $id=$_POST["MaTL"];
        $name=trim($_POST["TenTL"]);
        $sql="Select * from theloai where ma_tloai=? or ten_tloai=?";
        $stmt=$connect->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$name);
        $stmt->execute();
        if($stmt->rowCount()>0){
            header("Location:../../admin1/add_category.php?exist={$id}");
        }
        else{
            $sql="INSERT INTO theloai(ma_tloai,ten_tloai) VALUES
            (
                ?,?
            );";
            $stmt=$connect->prepare($sql);
            $stmt->bindParam(1,$id);
            $stmt->bindParam(2,$name);
            $stmt->execute();
            header("Location:../admin1/category.php?success={$id}");
        }
    }
    else{
        header("Location:..admin1/category.php");
    }
}
?>