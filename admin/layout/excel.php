 <?php
          include("connection.php");
          $filename = "excelwork.xls";

          header('Content-Disposition: attachment; filename='.$filename.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
          $exists = file_exists('excelwork.xls');
          if($exists)
          {
                   unlink($filename);
          }
                   $filename = "excelwork.xls";
                   $fp = fopen($filename, "wb");
                   $sql = "select * from item";
                   $result = mysql_query($sql);
                   $schema_insert = "";
                   $schema_insert_rows = "";
                   $insert_rows='';
                   for ($i = 1; $i < mysql_num_fields($result); $i++)
                   {
                   //$insert_rows .= mysql_field_name($result,$i) . "\t";
                   }
                   echo $insert_rows.='aaa'."\t";
                  echo $insert_rows.='bbb'."\t";
                  echo $insert_rows.='ccc'."\t";
              
                  echo $insert_rows.="\n";
                   fwrite($fp, $insert_rows);
                   while($row = mysql_fetch_row($result))
                   {

                   // echo $row[1];
//$insert = $row[1]. "\t" .$row[2]. "\t" .$row[3]. "\t" .$row[4]. "\t" .$row[5];
echo $insert = "sddsd". "\t" ."nnn". "\t"."mmm";

echo $insert = "sddsd". "\t" ."nnn". "\t"."mmm";

                  echo $insert .= "\n";               //       serialize($assoc)
                   fwrite($fp, $insert);
                   }
                   if (!is_resource($fp))
                   {
                             echo "cannot open excel file";
                   }
                   echo "success full export";
                   fclose($fp);
?>