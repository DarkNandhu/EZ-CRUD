<?php
$con = mysqli_connect("localhost","root","root","tester");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  function querbil($condition){
    global $con;
    $delimit='';
    $conditions='';
    $i=0;
    foreach ($condition as $key => $value) {
$i++;
      $delimit=$key;
      foreach ($value as $keyz => $valuez) {
      $conditions.=$keyz."'".$con->real_escape_string($valuez)."' ,";
    }
    if($i==sizeof($condition)){
    $conditions=rtrim($conditions,",");
         $conditions=str_replace(","," ".$delimit." ",$conditions);
    }
    else {
     $conditions=str_replace(","," ".$delimit." ",$conditions);
    }
  }
return $conditions;
  }
  function select($tablename,$columns,$conditions,$group,$order,$csrf){
    global $con;
    $sqlquery="";
      if($csrf==$_COOKIE['ibevytoken']){
if(empty($conditions)){
  $sqlquery.="SELECT ".$columns." FROM ".$tablename;
}
if(!empty($conditions)) {
$processed=querbil($conditions);
$sqlquery.="SELECT ".$columns." FROM ".$tablename." WHERE ".$processed;
  }
  $orderz="";
if(!empty($group)){
  $sqlquery.=" GROUP BY ".$group;
}
  if(!empty($order)){
    foreach ($order as $key => $value) {
      $delimit=$key;
      foreach ($value as $keyz) {
      $orderz.=$keyz." ".$delimit.",";
    }
  }
    $sqlquery.=rtrim(" ORDER BY ".$orderz,",");
  }
$res=$con->query($sqlquery);
$con->close();
return $res;

} else {
        return -1;
      }
  }
  function delete($tablename,$deletions,$csrf)
  {
    global $con;
      if($csrf==$_COOKIE['ibevytoken']){
if(!empty($deletions)){
  unset($_COOKIE['ibevytoken']);
  $conditions=querbil($deletions);
$sqlquery="DELETE FROM  ".$tablename." WHERE ".$conditions;
  if ($con->query($sqlquery) === TRUE) {
    return 1;
  } else {
  return $con->error;
}
  $con->close();
}
else {
  return 11;
}

      }
      else {
        return -1;
      }

  }
  function insert($tablename,$post){
    global $con;
  if(!empty($post)){
if($post['token']==$_COOKIE['ibevytoken']){
  unset($_COOKIE['ibevytoken']);
$column='';
$colvalue='';
$csrf='';
$i=1;
foreach ($post as $key => $value) {
  if($key=="token")
  break;
$column.=$key.',';
$colvalue.="'".$con->real_escape_string($value)."',";
}
$column=rtrim($column,",");
$colvalue=rtrim($colvalue,",");
$sqlquery="INSERT INTO ".$tablename." (".$column.") "."VALUES (".$colvalue.")";
if ($con->query($sqlquery) === TRUE) {
  return 1;
} else {
return $con->error;
}

$con->close();
}
else {
return -1;
}

}
}
function update($tablename,$updations,$conditions,$csrf){
global $con;
  if($csrf==$_COOKIE['ibevytoken']){
    unset($_COOKIE['ibevytoken']);
    if(!empty($updations)){
$updatz='';
foreach ($updations as $key => $value) {
  $updatz.=$key."='".$con->real_escape_string($value)."',";
}
  $updatz=rtrim($updatz,",");
$delimit='';
$condstatement=querbil($conditions);
$sqlquery="UPDATE ".$tablename." SET ".$updatz." WHERE ".$condstatement;
if ($con->query($sqlquery) === TRUE) {
  return 1;
} else {
return $con->error;
}
$con->close();

    }else{
      return 11;
    }
  }
  else {
    return -1;
  }
}
function joins($tablename,$columns,$valuez,$group,$order,$csrf){
  if($csrf==$_COOKIE['ibevytoken']){
    unset($_COOKIE['ibevytoken']);
$sqlquery='';
$colz='';
$sqlquery="SELECT ".$columns." FROM ".$tablename;
    foreach ($valuez as $key => $value) {
      $sqlquery.=" ".$key." JOIN ";
      foreach ($value as $keyz => $valuezz) {
        $sqlquery.=" ".$keyz." ON";
        foreach ($valuezz as $key26 => $value26) {
      $sqlquery.=" ".$key26."=".$value26;
        }
      }
    }
    if(!empty($group)){
      $sqlquery.=" GROUP BY ".$group;
    }
    $orderz="";
    if(!empty($order)){
      foreach ($order as $key => $value) {
        $delimit=$key;
        foreach ($value as $keyz) {
        $orderz.=$keyz." ".$delimit.",";
      }
    }
      $sqlquery.=rtrim(" ORDER BY ".$orderz,",");
    }
    $res=$con->query($sqlquery);
    $con->close();
    return $res;
}
else {
  return -1;
}

}
$token=md5(Date("dmyhis"));
setcookie('ibevytoken', $token, time()+900);
 ?>
