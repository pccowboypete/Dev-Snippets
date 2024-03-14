<?php

  $xquery = mysqli_query($con, "SELECT affiliate_id FROM wp_kma_affiliates LIMIT 1");
  
  while($row = mysqli_fetch_assoc($xquery)){
    foreach($row as $cname => $cvalue){
      print "$cname => $cvalue" . "<br>";
    }
    print "<hr><br>";
  }
