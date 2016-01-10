<?php


	echo "Results that match your query: ";
	foreach ($result as $row) {
    	echo "<h2> $row->name </h2>".
    	"<li> <b> Contact : </b> $row->phone </li>".
    	"<li> <b> E-mail : </b> $row->email </li>".
    	"<li> <b> Address : </b> $row->address</li>".
    	"<li><b> Authority IRI: </b>".$row->authority." </li>". 
    	"<li><b> Action IRI: </b>".$row->action." </li>";
    	echo "<br><br><i> <b> Your Request has been forwarded to the Authority. </b> </i>";
    }
?>