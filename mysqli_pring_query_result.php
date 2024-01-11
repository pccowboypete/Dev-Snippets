<?php

  $xquery = $yourqueryhere;
  
  while($row = mysqli_fetch_assoc($xquery)){
    foreach($row as $cname => $cvalue){
      print "$cname => $cvalue" . "<br>";
    }
    print "<hr><br>";
  }
