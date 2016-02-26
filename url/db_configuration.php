<?php
  //Checking if we are into the OpenShift App
  if (isset($_ENV['php'])) {
    $db_user=$_ENV['adminWgsz3Nn']; //Openshift db name OPENSHIFT_MYSQL_DB_USERNAME
    $db_host=$_ENV['127.9.100.2']; //Openshift db host OPENSHIFT_MYSQL_DB_HOST
    $db_password=$_ENV['hQrsxQX2NDcE']; //Openshift db password OPENSHIFT_MYSQL_DB_PASSWORD
    $db_name="thesurfclub"; //Openshift db name
  } else {
    $db_user="root"; //my db user
    $db_host="localhost"; //my db host
    $db_password=""; //my db password
    $db_name="thesurfclub"; //my db name
  }
?>
