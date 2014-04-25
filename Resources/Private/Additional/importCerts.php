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
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    $zeile = fgetcsv( $fp  , NULL , ";"  );

    $query = "INSERT INTO fe_users (pid,username,password,usergroup,first_name,last_name,email,country,certificates,tx_extbase_type,public_email_address,allow_listing) VALUES ";
    $query .= " ('774','#".$zeile[2].".".$zeile[1]."', '".$randomString."','30','".$zeile[2]."','".$zeile[1]."','".$zeile[0]."','".$zeile[3]."','1','Tx_Certifications_FeUsers','0','1' )";
    $query = substr($query, 0, -1);
    mysql_query($query);

    $expirationDate = $zeile[4] + 3Years;
    $certificationDate = $zeile[4];
    if ($zeile[6] == 'Version 4.x') {
        $expired = '1';
    } else {
        $expired = '0';
    }
    $mmQuery = "INSERT INTO tx_certifications_domain_model_certificate (pid,feusers,certification_date,allow_listing,expired,certificate_type,expiration_date) VALUES";
    $mmQuery .= " ('774','".mysql_insert_id()."','".$certificationDate."', '1',EXPRITEIF,'1','".$expirationDate."')";
    $mmQuery = substr($query, 0, -1);
    mysql_query($query);

}

fclose($fp);


