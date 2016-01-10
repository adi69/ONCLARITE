<!---
  scripts ends here
  HTML starts
-->
<div id="mainwrapper">
<h2> Your request seems new to us. We'll get back to you soon. Please give us your contact. </h2>
<div class = "error">
<?php
  echo form_open("Onclarite/newrequest");
  echo validation_errors();
?>
</div>
<table>

    <!---___GET DESCRIPTION OF THE CATEGORY STARTS HERE-->
    <tr>
        <td> E-mail: </td>
        <td> 
            <?php 
                $arr = array ( 
                      "name" => "email",  
                      "placeholder" => "someone@example.com", 
                      );
                echo form_input($arr);
            ?>
        </td>
    </tr>

    <!---SUBMIT BUTTON STARTS HERE____-->
    <tr>
        <td><?php echo form_submit('submit', 'Submit'); ?></td>
    </tr> 

</table>
</div>
<h1><div id = "output"> </div></h1>