<?php

$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

$target_dir = $root;

if(isset($_POST["customerreceipt"])) {


$target_dir = $target_dir .'/receipts/';

$target_file = $target_dir. $_REQUEST[transctionnumber].'-'. basename($_FILES["receipttoupload"]["name"]);


$url = 'http://www.jmtrax.com/receipts/'. $_REQUEST[transctionnumber].'-'. basename($_FILES["receipttoupload"]["name"]);



if (move_uploaded_file($_FILES["receipttoupload"]["tmp_name"], $target_file)) {

       
    $sql = "UPDATE transfers SET url = '$url' WHERE id = '$_REQUEST[transctionnumber]' ";



if ($conn->query($sql) === TRUE) {
	
	
	echo "<script> alert('Your receipt has beeen uploaded and can be downloaded at $url'); </script>";
	
} else {
    
    echo "Error updating record: " . $conn->error;
}


    } else {
    
       
       echo $_FILES['receipttoupload']['error'];

    }


}

function updatesender($para,$para1) {





}

?>




<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8"> 

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="styles/normal.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="icon" 
      type="image/png" 
      href="images/jmtrax_icon.png">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<title> Just Money Transfers | Edit Order </title>

</head>

<body  ng-app="justmoneytransfers"  ng-cloak>

<header ng-controller="menucontroller">

<ul class="topnav">

<li class="logo_link"> <a href="index.html"><img src="images/logo.png" class="logo" ></a> </li>

<li class="dropdown-link"> <a href="dashboard.php" class="dropbtn"> Dashboard</a>  

</li>  

<li class="dropdown-link"> <a class="dropbtn" >Administration</a> 

<div class="dropdown-content">

  <a href="banks.html" > Banks </a>  

  <a href="commission-fees.php" > Commission Fees</a>  

  <a href="customers.html" > Customers </a>

  <a href="exchange-rates.html" ng-show="reportrights"> Exchange Rates</a>  

  <a href="shops.html" > Shops </a> 

  <a href="users.html"> Users </a>   

</div>


</li>  

<li class="dropdown-link"> <a class="dropbtn" >Reports</a>  

<nav class="dropdown-content">

  <a href="banking.php"> Banking</a> 

   <a href="daily-transactions-receipients.html"> Daily Transactions Receipients </a>

  <a href="daily-transactions-senders.html"> Daily Transactions Senders</a>   

   <a href="receipients.html"> Recipients </a> 

    <a href="sales-report.html" > Sales Report </a> 

  <a href="senders.html"> Senders </a> 

   <a href="transactions.php"> Transactions </a>   <a href="transferslist.php"  ng-hide="usertype"> Transactions List</a>    

</nav>

</li>  

<li class="dropdown-link"> <a href="index.html" class="dropbtn" >Log Out</a> 


</li>  

<li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="showResponsivemenu()">  /a>
</li>

</ul> </header>

<div class="container-fluid" ng-controller="editorder"  >





<div class="row">


    <div class="col-sm-8" >


<table class="table table-bordered" style="text-align:center;">
    <thead>
     
    </thead>
    <tbody>
      <tr>
        <td><b>STAFF REFERENCE</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='staffref' name="orderreference"></td>
        <td><b>DATE</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='date' name="orderdate"></td>
      </tr>
  
<tr>
        <td><b>TRANSACTION NUMBER</b></td>
        <td><input type="text" class="form-control input-sm"  ng-model='transctionnumber' disabled name="ordernumber"  ></td>
        <td></td>
        <td></td>
      </tr>

<tr>
        <td><b>SENDER FIRST NAME </b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='senderfirstname' name="orderfirstname"></td>
        <td><b>SENDER LAST NAME</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='senderlastname' name="orderlastname"></td>
      </tr>

<tr>
        <td><b>AMOUNT</b> </td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='amount' name="orderamount"></td>
        <td><b>FEES</td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='fees' name="orderfees"></td>
      </tr>

<tr>
        <td><b>GBP TOTAL</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='gbptotal' name="ordergbptotal"></td>
        <td><b>NGN TOTAL</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='ngntotal' name="orderngntotal"></td>
      </tr>

<tr>
        <td><b>PAYMENT DATE</b></td>
        <td><input type="text" class="form-control input-sm" id="datepicker" ng-model='paymentdate' name="orderpaymentdate"></td>
      <td><b>STATUS</b></td>
        <td><input type="text" class="form-control input-sm" id="usr" ng-model='status' name="orderstatus"></td>
      </tr>

<tr>
        <td><b>SENDING BANK</b></td>
        <td><input type="text" name="recbank" class="form-control input-sm" style="position:relative; " value="{{recbank}}"  id='recbank' ng-model='recbank'/> </td>
        <td>     


          <select class="form-control input-sm"  ng-options="bank as bank.bankname for bank in banklist | filter:bank.type='receipient' "  ng-change="bankdropdownfunction()" ng-model="bankdropdown"style="position:relative; " ></select> </td>


        <td></td>

      </tr>

<tr>
        <td><b>PAYMENT METHOD</b></td>
        <td>  <input type="text" id='paymenttextfeild'  class="form-control input-sm"  name="payment"  value="{{recpaymentref}}" id='paymentref' ng-model='recpaymentref'/> </td>
        <td>   

<select  id='paymentdropdown' class="form-control input-sm"  ng-change="paymentdropdownfunction()" ng-model="paymentdropdown">


<option value='Cash' >Cash </option>

<option value='Bank' >Bank </option>

<option value='PayPal' >PayPal </option>

<option value='thirdparty' >Third Party </option>

</select> </td>
<td><button type="button"  class="btn btn-primary btn-block" ng-click='emailRecipiet()' >EMAIL</button></td>


      </tr>


<tr>
        <td><b>COMPLIANCE FORM</b></td>
        <td></td>
        <td> <span class="redtext"> {{editordererror}} </span></td>
        
        <td>TRANSACTION RECEIPT  <a href='{{transactionURL}}' target='_blank'> 
<img src='http://www.jmtrax.net/identifications/ic_launcher.png' style='position:relative; width:16px;height:16px' /> </a></td>
        
      </tr>


<tr>
        
        <td valign="middle" ><button type="button" class="btn btn-primary btn-block" ng-click='payorder()' ng-disable="status === 'paid' ">PAY</button></td>
        <td valign="middle"><button type="button" class="btn btn-primary btn-block" id="reportrights" ng-click='deleteorder()' ng-hide="reportrights" >DELETE</button> </form></td>
        <td valign="middle">

          <button type="button" class="btn btn-primary btn-block" ng-click="printorder()">

            PRINT

          </button>


        </td>
        
        <td><form action="" method="POST" enctype="multipart/form-data" id="reportrights">
    Select receipt to upload:
    <input type="file" name="receipttoupload" id="receipttoupload">
    <input type='hidden' class="transctionnumber" name='transctionnumber' ng-value="transctionnumber" />
    <input type='hidden' class="customerreceipt" name='customerreceipt' value="SUBMIT" />
    <input type="submit" value="Upload Image"  class="btn btn-primary btn-block"  >
</form></td>

      </tr>

    </tbody>

  </table>


</div>



    <div class="col-sm-4" > 




   </div>


</div>


</div>

<footer>

<div class="row">

  <div class="col-sm-6" id="footer_column_1">  


<p>Authorised User can log into JM Transfers by entering correct account information on the right hand side. The activity of authorized users may be monitored. If monitoring reveals evidence of criminal activity, systems personnel may provide the evidence to management and/or law enforcement officials. Just Computers trading as JM Transfer and JM Trax have a comprehensive compliance program within the organisation to ensure compliance with government rules, regulations and approved guidance. We do not want JM Transfer and JM Trax services to be used in illegal money laundering activities or terrorist activities. It is our policy that we follow both the letter and the spirit of the law and the regulations of both the United Kingdom and Nigeria in which JM Transfer and JM Trax operates. All remittances processed by JM Transfer and JM Trax are screened with enhanced controls to prevent money laundering and terrorist financing. It is JM Transfer and JM Trax policy to follow both the letter and spirit of the law and regulations. Throughout the world, Governments have reinforced their commitment to the fight against money laundering and terrorist financing. New laws have imposed additional obligations on firms and individuals in the financial services sector to join in the fight. JM Transfer and JM Trax has an extensive training and awareness programme, a rigorous transaction monitoring system and a robust culture of compliance. JM Transfer and JM Trax works closely with regulatory bodies.</p>


 </div>

  <div class="col-sm-6" id="footer_column_2">  

  <img src='images/Photo2_small.png' class="footerimage"/>

  </div>

   

</div>

</footer>


<section class="copywright">

<p style='color:white;'>&copy; UNIFIED DIGITAL MEDIA  - http://www.unifieddigitalmedia.co.uk</p>

  </section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" ></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-resource.js" ></script>

<script src="scripts/main.js"> </script>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">

$(function() {

    $( "#datepicker" ).datepicker({ dateFormat: "d-m-yy" });


  
  });


</script>
<script type="text/javascript">


var app = angular.module('justmoneytransfers', ['ngResource']);

app.controller('menucontroller', function($scope,$http,$resource) {


function getCookie(cname) {

    var name = cname + "=";
  
    var ca = document.cookie.split(';');
  
    for(var i=0; i<ca.length; i++) {
  
        var c = ca[i];
  
        while (c.charAt(0)==' ') c = c.substring(1);
  
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  
    }
  
    return "";

}

var init = function () {
   
$scope.reportrights = true;

if(!getCookie('agentusername') || getCookie('agenttype') == 'customer' )

{


window.location = "index.html" ;


}


if( getCookie('agenttype') == 'user'  )

{ 

$scope.usertype = true;
$scope.reportrights = false;

}
if( getCookie('agenttype') == 'supervisor'  )

{ 


$scope.reportrights = false;


}


var counter = 0;

setInterval(function(){ counter = counter + 1 ;


window.addEventListener("mousemove",function getcoords() {


counter = 0;

});

if (counter == '1800')

{




window.location = "index.html" ;



} },1000);


};

init();





});


app.factory('Editorder_Service', ['$resource', function($resource) {

var resource = $resource('api/editorder',{

id:"@id",
paymentdate : "@paymentdate",
sendingbank : "@sendingbank",
paymentmethod : "@paymentmethod",


},{ 'update': { method:'PUT' } });

return resource;


}]);





app.controller('editorder', function($scope,Editorder_Service,$http,$resource) {

var init = function () {
   
$http.get("api/banks").then(function(response) {

$scope.banklist = response.data;

});

$scope.agentid = getCookie('agentid') ;

$scope.agentusername = getCookie('agentusername') ;

$scope.agentemail = getCookie('agentemail') ;

$scope.agenttype = getCookie('agenttype') ;

$scope.creditlimit = getCookie('agentcredit') ;

$http.get("api/editorder.php?transaction_number="+ getCookie('transaction_number')).then(function(response) {

//alert(getCookie('transaction_number'));

$scope.date = response.data[0].date ;
$scope.transctionnumber = response.data[0].id;
$scope.senderfirstname = response.data[0].senderfirstname;
$scope.senderlastname = response.data[0].senderlasttname;
$scope.amount = $scope.tocurrency(response.data[0].amount);
$scope.fees = $scope.tocurrency(response.data[0].fee);
$scope.gbptotal = $scope.tocurrency(response.data[0].totalgbp);
$scope.ngntotal = $scope.tocurrency(response.data[0].totalngn);
$scope.staffref = response.data[0].agentusername;



$scope.paymentdate = response.data[0].paymentdate;
$scope.status = response.data[0].status;
$scope.recbank = response.data[0].sendingbank;
$scope.recpaymentref = response.data[0].paymentmethod;
$scope.transactionURL = response.data[0].url;

});



};

init();
$scope.tocurrency = function (para) {


var number = para.toString();

var dollars = number.split('.')[0];

var  cents = (number.split('.')[1] || '') +'00';

var dollars = dollars.split('').reverse().join('').replace(/(\d{3}(?!$))/g, '$1,').split('').reverse().join('');

var cent = cents.slice(0, 2);

var decimal = ".";

var cent2 = decimal.concat(cent);

var dollars = dollars.concat(cent2);

return dollars;




}
$scope.payorder = function () {

var sendingbank = document.getElementById("recbank").value ;

var paymentmethod = document.getElementById("paymenttextfeild").value ;

var date = document.getElementById("datepicker").value ;


if(sendingbank == '' || paymentmethod == '' || date == '')

{


$scope.editordererror = "Sending bank , Payment method and Payment Date is needed";



}
else
{


  $scope.editordererror = "";

var log = Editorder_Service.update(

{

id:getCookie('transaction_number'),
paymentdate : document.getElementById("datepicker").value,
sendingbank : document.getElementById("recbank").value ,
paymentmethod : document.getElementById("paymenttextfeild").value ,

}, function() {



alert(log.ERROR);


window.location = "daily-transactions-senders.html" ;




  });




}

  }


  $scope.printorder = function () {

document.cookie = "print_location=reports";



window.location = "receipt.html" ;

  }



$scope.transferreasonfunction = function () {

$scope.recreasonfortransfer = $scope.transferreason ;  

  }

$scope.paymentdropdownfunction = function () {

$scope.recpaymentref = $scope.paymentdropdown ;  

  }


$scope.bankdropdownfunction = function () {

$scope.recbank = $scope.bankdropdown.bankname ; 

  }




        
 $scope.emailRecipiet = function () {
 
 var r = prompt("What is the email of the person you would like to send a receipt to? ","");
    
    if (r) {
	
	//var re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";

 var res = r.match(/[a-z,A-Z,0-9,\.]{1,64}@[a-z,A-Z,0-9,\.]{1,64}/gi);

            if(res){

  

  $http.put("api/editorder.php?id="+getCookie('transaction_number')+"&agentusername="+getCookie('agentusername')+"&email="+r).then(function(response) {



alert(response.data.ERROR);

window.location = "daily-transactions-senders.html" ;



});



  
  }else{
  
  alert("Please check that your email address is correct.");
  
  
  }
}else{
  
  alert("Please check that your email address is correct.");
  
  
  }
 
 }
$scope.deleteorder = function () {



var r = prompt("You are about to delete this transfer. Please give a reason why. ","");
    
    
if (r != null) {
	
	
$http.delete("api/editorder.php?id="+getCookie('transaction_number')+"&agentusername="+getCookie('agentusername')+"&reason="+r).then(function(response) {



window.location = "daily-transactions-senders.html" ;



});


    
    
    }
    


}




function getCookie(cname) {

    var name = cname + "=";
  
    var ca = document.cookie.split(';');
  
    for(var i=0; i<ca.length; i++) {
  
        var c = ca[i];
  
        while (c.charAt(0)==' ') c = c.substring(1);
  
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  
    }
  
    return "";

}



});



$(document).ready(function(){
  



if(getCookie('agenttype') != 'administrator')

{


    $("#reportrights").hide();

}else{
	
	   $("#reportrights").show();
	
}


  
function getCookie(cname) {

    var name = cname + "=";
  
    var ca = document.cookie.split(';');
  
    for(var i=0; i<ca.length; i++) {
  
        var c = ca[i];
  
        while (c.charAt(0)==' ') c = c.substring(1);
  
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  
    }
  
    return "";

}
     

});


</script>

</body>

</html>