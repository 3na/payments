<?php
function check_txnid($tnxid){
	global $link;
	return true;
	$valid_txnid = true;
    //get result set
    $sql = mysql_query("SELECT * FROM `wp_payments` WHERE `txnid` = '{$tnxid}'", $link);		
	if($row = mysql_fetch_array($sql)) {
        $valid_txnid = false;
	}
    return $valid_txnid;
}

function check_price($price, $id){
    $valid_price = false;
    //you could use the below to check whether the correct price has been paid for the product
    
	$sql = mysql_query("SELECT payment_amount FROM wp_payments WHERE id = '$id'");
    if (mysql_numrows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['payment_amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
    }
	return $valid_price;
}

function updatePayments($data){	
    global $link;
	if(is_array($data)){				
        $sql = mysql_query("INSERT INTO `wp_payments`
			(txnid, payment_amount, payment_status, itemid, createdtime, itemname, firstname, lastname, address, city, zip, email) VALUES (
                '".$data['txn_id']."' ,
                '".$data['payment_amount']."' ,
                '".$data['payment_status']."' ,
                '".$data['item_number']."' ,
                '".date("Y-m-d H:i:s")."',
				'".$data['item_name']."',
				'".$data['first_name']."',
				'".$data['last_name']."',
				'".$data['address']."',
				'".$data['city']."',
				'".$data['zip']."',
				'".$data['payer_email']."'
                )", $link);
    }
	return mysql_insert_id($link);
}
?>