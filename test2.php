<?php
	require_once('../config.php');
    require_once('../lib/nusoap.php');
    // Create the server instance
    $server = new soap_server();

    // Initialize WSDL support
    $server->configureWSDL('villaQuoter.bookings', 'urn:villaQuoter.bookings');

	//Define a STRUCT for 'simple quote details' conatins a minimum set of fields including:
	//	state, bookingRef, customerId, startDate, endDate, bookingDate, Customer Full Name, Total Cost, Amount Owing    	
    $server->wsdl->addComplexType(
    	'basicBookingDetails',		//Name of Type
    	'complexType',				//Type Class (Complex)
    	'struct',					//php Type (Struct)
    	'all',						//Compisitor??
    	'',							//Restriction Base
    	array(
			'state' => array('name' => 'state', 'type' => 'xsd:int'),
    		'bookingRef' => array('name' => 'bookingRef', 'type' => 'xsd:string'),
    		'customerId' => array('name' => 'customerId', 'type' => 'xsd:string'),
    		'customerFullName' => array('name' => 'customerFullName', 'type' => 'xsd:string'),
    		'startDate' => array('name' => 'startDate', 'type' => 'xsd:string'),
    		'endDate' => array('name' => 'endDate', 'type' => 'xsd:string'),
    		'bookingDate' => array('name' => 'bookingDate', 'type' => 'xsd:string'),
    		'totalCost' => array('name' => 'totalCost', 'type' => 'xsd:string'),
    		'amountOwing' => array('name' => 'amountOwing', 'type' => 'xsd:string')
    	)		
    );

	//Create an ARRAY of data type BasicBookingDetails (this will be returned by the Web Service)
    $server->wsdl->addComplexType(
    	'arrBasicBookingDetails',		//Name of Array
    	'complexType',					//Type Class (Complex)
    	'array',						//Php Type (Array)
    	'',								//Compistor??
    	'SOAP-ENC:Array',				//Restriction Base
    	array(),
    	array(
    		array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:basicBookingDetails[]') //link back to complexType via namespace
    		),
    	'tns:basicBookingDetails'
    );

    //Define Web Service
    $server->register('ws_retrieveBasicBookingDetailsList',
    	array('history' => 'xsd:int'),											//Input Parameters (Integer: Days)
    	array('return' => 'tns:arrBasicBookingDetails'),						//Output Paraemters, an Array of BasicBookingDetails
    		'urn:villaQuoter.bookings',											//Namespace
	        'urn:villaQuoter.bookings#ws_retrieveBasicBookingDetailsList',   	//soapaction
    		'document',																//style  rpc or document
    		'literal',															//use encoded or literal
    		'This method returns basic details for bookings / quotes, define number of days of history to return. 0 = future only.'	//documentation	
    	);

	function ws_retrieveBasicBookingDetailsList($days)
	{// Called by Web Service of Same Name.
    	$link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    	if(mysqli_connect_errno())
    	{	
    		//Raise SOAP Fault if Database Connection fails
			return new soap_fault('SQL-ERROR: '.mysqli_connect_error());
    	}

		$result = $link->query("call sr_RetrieveBasicBookingDetailsList(".$days.")");
		if(mysqli_errno($link))
		{	
    		//Raise SOAP Fault if Stored Routine Call Fails
			return new soap_fault('SQL-ERROR: '.mysqli_error($link));
    	}

		//Create bookings array (holds multiple bookings of STRUCT Type basicBookingDetails	
		$bookings = array();

		while($row = mysqli_fetch_row($result))
		{// Loop throu each booking and Load into 'bookings' array
			$booking = array(
	 			bookingRef => $row[0],
	 			customerId => $row[1],
	 			customerFullName => $row[2],
	 			state => $row[3],
	 			startDate => $row[4],
	 			endDate => $row[5],
	 			bookingDate => $row[6],
	 			totalCost => $row[7],		
	 			amountOwing => $row[8]
			);
	  		$bookings[] = $booking;
		}
		//Close Database Connection (results now in $bookings array)
		mysqli_close($link);

	return $bookings;
	}

    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);