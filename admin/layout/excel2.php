<?php 
 //download.php page code
// `enter code here`//THIS PROGRAM WILL FETCH THE RESULT OF SQL QUERY AND WILL DOWNLOAD IT. (IF YOU HAVE ANY QUERY CONTACT:rahulpatel541@gmail.com)
//include the database file connection
include_once('connection.php');
//will work if the link is set in the indx.php page
if(isset($_GET['name']))
{

    //echo $_GET['name'];exit;
    $name=$_GET['name']; //to rename the file
    header('Content-Disposition: attachment; filename='.$name.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
    //write your query      
    $sql="select * from item";
    $res = mysql_query($sql);
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table

    $fp = fopen($name, "wb");
    echo $insert_rows='';
    echo $insert_rows.='sr'."\t";
      echo $insert_rows.='Name'."\t";
      echo $insert_rows.='desc'."\t";

      echo $insert_rows.="\n";
       fwrite($fp, $insert_rows);
    $i=0;
    $count=1; //used to print sl.no
    $insert='';
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {

        echo $insert .= $count. "\t" .$row['itemName']. "\t".$row['description'];


         echo $insert .= "\n";               //       serialize($assoc)
        fwrite($fp, $insert);

       
    }

     if (!is_resource($fp))
       {
                 //echo "cannot open excel file";
       }
       //echo "success full export";
       fclose($fp);
}
?>

<?php
//index.php page
$name="abc";
echo "<a href='excel2.php?name=".$name."'>Click to download</a>"; //link to download file
?>