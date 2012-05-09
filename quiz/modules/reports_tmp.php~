<?php if(!isset($RUN)) { exit(); } ?>

<table>
    

<?php
$i = 0;
while($row=db::fetch($res_qst))
{
    ?>
    <tr>
        <td>
            <font face="tahoma" size="4"><?php echo $row['question_text'] ?></font>
        </td>
    </tr>
    <tr>
        <td>
            <?php
                $res_ans = $db->query(reports_db::GetAnswersReport($row['id'],$asg_id));
                $chart = new PieChart();
                $dataSet = new XYDataSet();                
                while ($row_ans=db::fetch($res_ans))
                {                    
                    $dataSet->addPoint(new Point($row_ans['answer_text'], $row_ans['a_count']));       
                }
                $chart->setDataSet($dataSet);
                $chart->setTitle("User agents for www.example.com");
                $chart->render("generated/".$i.".png");
            ?>
            <img src='<?php echo "generated/".$i.".png" ?>' style="border: 1px solid gray;" >
        </td>
    </tr>
   <?php
  $i++;
}

$db->close_connection();

?>

    </table>
