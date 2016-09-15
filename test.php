
<?php
// Complex Array Keys and Types ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionData','complexType','struct','all','',
        array(
                'id' => array('name'=>'id','type'=>'xsd:int'),
                'name' => array('name'=>'name','type'=>'xsd:string')
        )
);
// *************************************************************************

// Complex Array ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionArray','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionData[]'
            )
        )
);
// *************************************************************************

// This is where I register my method and use the notaryConnectionArray
$server->register("listNotaryConnections",
                array('token' => 'xsd:string'),
                array('result' => 'xsd:bool', 'notary_array' => 'tns:notaryConnectionArray', 'error' => 'xsd:string'),
                'urn:closingorder',
                'urn:closingorder#listNotaryConnections',
                'rpc',
                'encoded',
                'Use this service to list notaries connected to the signed-in title company.');

// In my function, I query the data and do:
$list = array();
$results = mysql_query($query);
while($row = mysql_fetch_assoc($results)) {
    array_push($list, array('id' => intval($row['na_id']), 'name' => $row['agency_name']));
}

return array("result" => true, "notary_array" => $list);

// The output is:
Array
(
    [result] => 1
    [notary_array] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Agency 1
                )

            [1] => Array
                (
                    [id] => 3
                    [name] => Agency 3
                )

            [2] => Array
                (
                    [id] => 4
                    [name] => Agency 4
                )

        )

    [error] => 
)