<?php

$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$sql = "SELECT COUNT(SendersFirstName) AS OrdersFromCustomerID7 FROM senderslist WHERE SendersMobile NOT IN (SELECT Mobile FROM users)";

//$sql="INSERT INTO `users`(`username`, `SendersFirstName`, `SendersLastName`, `Line1`, `Line2`, `Line3`, `Town`, `Postcode`, `County`, `Country`, `Mobile`, `Email`,`Enabled`) SELECT SendersMobile,SendersFirstName,SendersLastName,Line1,Line2,Line3,SenderTown,SendersPostcode,County,SenderCountry,SendersMobile,SendersEmail,Enabled FROM senderslist WHERE SendersMobile NOT IN (SELECT Mobile FROM users)";

/*UPDATE recipientslist INNER JOIN senderslist ON recipientslist.senders_ID = senderslist.senders_ID SET recipientslist.Mobile = senderslist.SendersMobile


INSERT INTO receipients (ReceipientFirstName, ReceipientLastName, ReceipientBank,ReceipientAccountNumber,ReceipientReasonForTransfer,ReceipientPaymentReference, ReceipientPhone, ReceipientPayPal, ReceipientShopAccount, sendersID)
SELECT ReceipientFirstName,ReceipientLastName,ReceipientBank,ReceipientAccountNumber,ReasonForTransfer, PaymentRef, RecipientsPhone,PayPalEmail,ShopAcc,newsendersID FROM recipientslist WHERE (ReceipientFirstName,ReceipientLastName,ReceipientBank,ReceipientAccountNumber) NOT IN (SELECT ReceipientFirstName,ReceipientLastName,ReceipientBank,ReceipientAccountNumber FROM receipients)


*/

/*INSERT INTO `transfers`(`senderfirstname`, `senderlasttname`, `line1`, `line2`, `line3`, `town`, `sendercounty`, `postcode`, `senderphone`, `sendermobile`, `senderemail`, `recipientsurname`, `recipientfirstname`, `recipientphone`, `bankac`, `bankname`, `recmobilephoneprex`, `paymentref`, `shopacc`, `paypalemail`, `reasonfortransfer`, `agentusername`, `remittance`, `ngn`, `amount`, `totalgbp`, `fee`, `date`, `shop`, `customeref`, `rate`, `status`, `paymentdate`, `sendingbank`, `paymentmethod`, `cash`, `change`) SELECT `SendersFirstName`, `SendersLastName`, `Line1`, `Line2`, `Line3`, `SenderTown`, `County`, `SendersPostcode`, `SendersPhone`, `SendersMobile`, `SendersEmail`, `RecipientsFirstName`, `RecipientsLastName`, `RecipientsPhone`, `NigeriaBankAccount`, `BankAddress`, `Recmobilephoneprex`, `PaymentRef`, `ShopAcc`,`PayPalEmail`, `ReasonForTransfer`,`Agency`,`Remittance`,`AmountNGN`, `AmountSterling`, `TotalDueGBP`, `CommissionCharged`,`Date`,`Shop`, `customerref`,`ExchangeRate`,`Status`,`PaymentDate`,`SendingBank`,`paymentmethod`,`CashTenured`, `ChangeGiven` FROM moneyorder


*/
/*$result1 = $conn->query($sql);

while($row = $result1->fetch_assoc()) {


echo $row['SendersFirstName'];







}*/

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


?>