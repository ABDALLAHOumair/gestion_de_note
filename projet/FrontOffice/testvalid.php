<?php  
$age = $_GET['age'];

if ($age>= 18){
    echo '<img src="https://img.freepik.com/vecteurs-libre/coche-verte-double-cercle_78370-1749.jpg?semt=ais_hybrid&w=740&q=80"/>';
}
else{
    echo '<img src="https://static.vecteezy.com/system/resources/previews/008/506/384/non_2x/red-x-icons-invalid-access-denied-failed-wrong-deny-fail-free-png.png"/>';
}
?>