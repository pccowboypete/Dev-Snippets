<?php

date("Y-m-d H:i:s"); //date format php to mysql timestamp

date("M-d-Y h:i:s A"); //good representation of date

date("M-d-Y h:i:s A", strtotime($mysql_timestamp)); //mysql timestamp to php
