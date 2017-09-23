<?php
include 'query.php';
//$val=insert('post',$_POST);
//$val=update('post',array('tname'=>$_POST['tname'],'tnamea'=>$_POST['tnamea'],'tnameb'=>$_POST['tnameb']),array('AND'=>array('sno'=>11,'tname'=>$_POST['tname'])),$_POST['token']);
//echo $val;
//$val=delete('post',array('AND'=>array('sno = '=>4,'tname = '=>10)),$_POST['token']);
//echo $val;
//variant 1
/*while($row = mysqli_fetch_array($val)) {
    echo "id: " . $row["sno"]. "<br>";
}*/
//variant 2
$val=select('post','tname,tnamea','','','',$_POST['token']);
while($row = mysqli_fetch_array($val)) {
    echo "id: " . $row["tname"]. "<br>";
    echo "id: " . $row["tnamea"]. "<br>";
}
//variant 3
/*$val=select('post','sno,tname,tnamea',array('OR'=>array('sno = '=>3,'tname = '=>10),'AND'=>array('sno = '=>3,'tname = '=>10)),'sno',array('ASC'=>array('sno'),'DESC'=>array('tname')),$_POST['token']);
while($row = mysqli_fetch_array($val)) {
    echo "id: " . $row["sno"]. "<br>";
    echo "id: " . $row["tnamea"]. "<br>";
}*/
//$val=joins('post','post.sno,post.tname',array("inner"=>array("poster"=>array('post.sno'=>'poster.sno')),"OUTER"=>array("poster"=>array('post.sno'=>'poster.sno'))),'poster.sno',array('ASC'=>array('sno'),'DESC'=>array('tname')),$_POST['token']);
//echo $val;

/*$val=select('post','sno,tname,tnamea','',array('DESC'=>array('sno')),'sno',$_POST['token']);
while($row = mysqli_fetch_array($val)) {
    echo "id: " . $row["sno"]. "<br>";
    echo "id: " . $row["tnamea"]. "<br>";
}*/
?>
