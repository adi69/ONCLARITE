<!---
  scripts ends here
  HTML starts
-->
<style type="text/css">
</style>
<div id="mainwrapper">
<h1> Service Request </h1>
<div class = "error">
<?php
  echo form_open("Onclarite/result");
  echo validation_errors();
?>
</div>
<table>
    <tr>
      <!---GET NAME OF THE CATEGORY STARTS HERE-->
        <td> What Happened? </td>
        <td> 
            <?php 
                $arr = array(
                "name" => "what",
                "placeholder" => "eg: The grass is overgrown.",
                "size" => "60",
                );
                echo form_input($arr);
            ?>
        </td>
    </tr>
    <tr> <td></td> <td>&nbsp</td></tr>
    <!---___GET DESCRIPTION OF THE CATEGORY STARTS HERE-->
    <tr>
        <td> Where it happened? </td>
        <td> 
            <?php 
                $arr = array ( 
                      "name" => "where",  
                      "placeholder" => "eg: In front of CC3.", 
                      );
                echo form_input($arr);
            ?>
        </td>
    </tr>
    <tr> <td></td> <td>&nbsp</td></tr>
    <!---___GET DESCRIPTION OF THE CATEGORY STARTS HERE->
    <tr>
        <td> Name: </td>
        <td> 
            <?php 
                $arr = array ( 
                      "name" => "name",  
                      "placeholder" => "eg: Adi", 
                      );
                echo form_input($arr);
            ?>
        </td>
    </tr> -->

    <!---SUBMIT BUTTON STARTS HERE____-->
    <tr>
        <td><?php echo form_submit('submit', 'Submit'); ?></td>
    </tr> 

</table>
<h1><div id = "output"> </div></h1>