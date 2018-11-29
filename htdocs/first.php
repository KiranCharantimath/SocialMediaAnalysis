<?php
 echo "Hello World";
 $dbServername="localhost";
 $dbUsername="root";
 $dbPassword="";
 $dbName="Youtube";

 $conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
 $sql="select * from tabs;";
 $result=mysqli_query($conn,$sql);
 echo $result;
 /*
 $resultCheck=mysqli_num_rows($result)
 if($resultCheck>0)
 {
 	while ($row = mysqli_fetch_assoc($result)) {
 		echo $row['VideoId'];
 	}
 }
*/

?>