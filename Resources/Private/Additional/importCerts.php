<?php
$dbname="devt345";
$dbhost="localhost";
$dbuser="root";
$dbpass="basic";
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);

$fp = fopen("certs.csv", "r");

while( !feof($fp) ) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-_?/()&%$§<>#+';
    $randomString = '';
    $length = 10;
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    $zeile = fgetcsv( $fp  , NULL , ";"  );

    $query = "INSERT INTO fe_users (pid,username,password,usergroup,first_name,last_name,email,country,certificates,tx_extbase_type,public_email_address) VALUES ";
    $query .= " ('774','#".$zeile[2].".".$zeile[1]."', '".$randomString."','30','".$zeile[2]."','".$zeile[1]."','".$zeile[0]."','".$zeile[3]."','1','Tx_Certifications_FeUsers','0'); ";
    $query = substr($query, 0, -1);
    echo $query.'<br />-----<br/>';
    mysql_query($query) or die(mysql_error());

    $expirationDate = date("U",strtotime($zeile[4]));
    $expirationDate = $expirationDate + (3 * 31556926);
    $certificationDate = date("U",strtotime($zeile[4]));
    if ($zeile[6] == 'Version 4.x') {
        $expired = '1';
    } else {
        $expired = '0';
    }
    $mmQuery = "INSERT INTO tx_certifications_domain_model_certificate (pid,feusers,certification_date,allow_listing,expired,certificate_type,expiration_date) VALUES";
    $mmQuery .= " ('774','".mysql_insert_id()."','".$certificationDate."', '1','".$expired."','1','".$expirationDate."');";
    $mmQuery = substr($mmQuery, 0, -1);
    echo $mmQuery.'<br />=====<br />';
    mysql_query($mmQuery) or die(mysql_error());

}

fclose($fp);


