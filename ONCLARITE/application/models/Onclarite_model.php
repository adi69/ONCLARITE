<?php
	class Onclarite_model extends CI_Model {

		public function __construct()
        {
            EasyRdf_Namespace::set('o311', 'http://ontology.eil.utoronto.ca/open311.owl#');
            $sparql = new EasyRdf_Sparql_Client('http://localhost:8890/sparql');
        }

        public function get_action($data){
            EasyRdf_Namespace::set('o311', 'http://ontology.eil.utoronto.ca/open311.owl#');
            $sparql = new EasyRdf_Sparql_Client('http://localhost:8890/sparql');
            //SAMPLE QUERY: select * where {?sub o311:hasAddress o311:iiitCC3. ?sub o311:has311Subject o311:Waste. ?sub o311:need311Action ?action. ?sub o311:isHandledBy ?authority. ?authority o311:AgencyName ?name. ?authority o311:Phone ?phone. ?authority o311:Email ?email. ?authority o311:AddressType ?address }';
		        $str = 'SELECT * WHERE {'.
		        '?sub o311:hasAddress o311:'. $data["where"]. ". ".
		        '?sub o311:has311Subject o311:'. $data["what"]. ". ".
		        '?sub o311:isHandledBy ?authority. '.
		        '?sub o311:need311Action ?action. '.
		        '?authority o311:AgencyName ?name.'.
		        '?authority o311:Phone ?phone.'.
		        '?authority o311:Email ?email.'.
		        '?authority o311:AddressType ?address.'.
		        '} ';
		        echo "<br><i><font color = 'grey'>$str</font></i><br>";
            $result = $sparql->query($str);
   		 	return $result;
        }
        
	}

?>