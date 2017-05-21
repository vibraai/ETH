<?php
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	ini_set('max_execution_time', 300);
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'Sorszam','kotetszam','megye','telepulesSZTA','evszam','hivatkozas','adat','helyfajta','SZTAmegjegyzes','egyebmegjegyzes','szelesseg','hosszusag','1913asnev','maitelepulesnev','nemmagyarnevvaltozat','nemmagyarnevSZTA' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "Sorszam";
	/* DB table to use */
	$sTable = "eth";
//	
	/* Database connection information */
        /*
	$gaSql['user']       = "p_eha";
	$gaSql['password']   = "qUQHT2K7CBUSwGRA";
	$gaSql['db']         = "p_eha";
	$gaSql['server']     = "mysql.caesar.elte.hu";
        */
//	/* DB table to use */
//	$sTable = "eth";
	
//	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "";
	$gaSql['db']         = "csv_db";
	$gaSql['server']     = "localhost";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);
mysqli_set_charset($gaSql['link'], "utf8");

/* Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayStart'] ).", ".
			mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
        /*
         * ideiglenesen kikommentezve, h gyorsabb legyen. Egyeztetni, mert lehet h felesleges, mert nincs ra igeny
         * lent, az sOrder is ki lett szedve az $sWhere es a $sLimit közül
         *  
         */
//	if ( isset( $_GET['iSortCol_0'] ) )
//	{
//		$sOrder = "ORDER BY  ";
//		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
//		{
//			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
//			{
//				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
//				 	".mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_'.$i] ) .", ";
//			}
//		}
//		
//		$sOrder = substr_replace( $sOrder, "", -2 );
//		if ( $sOrder == "ORDER BY" )
//		{
//			$sOrder = "";
//		}
//	}
//	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
                    
                    if ( $_GET['checkKotetszam'] == "false" && $aColumns[$i] == "kotetszam"){
                                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'], $_GET['sSearch'] )."%' OR ";
                            }
                    else {
                        $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'], $_GET['sSearch'] )."%' AND ";
                    }
			
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
                   
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
                            
                            if ( $_GET['checkKotetszam'] == "false" && $aColumns[$i] == "kotetszam"){
                                $sWhere .= " OR ";
                            }
                            else {
                                $sWhere .= " AND ";
                            }
				
			}
                        if (strpos($_GET['sSearch_'.$i], ' VAGY ') !== false) {
                            $arrOR=explode(" VAGY ",$_GET['sSearch_'.$i]);
                            $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'],$arrOR[0])."%' ";
                            for ($j=1;$j<count($arrOR);$j++){
                                $sWhere .= " OR ";
                                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'],$arrOR[$j])."%' ";
                            }
                           
                        }
                        else if ($aColumns[$i] == "evszam"){
                            $arrEvszam=explode("-",$_GET['sSearch_'.$i]);
                            
                            if (count($arrEvszam)==2 && $arrEvszam[0]!=null && strlen($arrEvszam[0])==4 && $arrEvszam[1] != null && strlen($arrEvszam[1])==4) {
                            $sWhere .= $aColumns[$i]." BETWEEN '".$arrEvszam[0]."' AND '".$arrEvszam[1]."'";
                            }
                            else {
                                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'],$_GET['sSearch_'.$i])."%' ";
                            }
                        }
                        else {
                            $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'],$_GET['sSearch_'.$i])."%' ";
                        }
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sLimit
	";
        
       
          $file = 'queries.txt';
       $current = file_get_contents($file);
// Append a new person to the file
$current .= $sQuery;
// Write the contents back to the file
file_put_contents($file, $current);  
         
	$rResult = mysqli_query( $gaSql['link'],$sQuery  ) or die(mysqli_error($gaSql['link']));
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query( $gaSql['link'],$sQuery ) or die(mysqli_error($gaSql['link']));
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysqli_query(  $gaSql['link'],$sQuery ) or die(mysqli_error($gaSql['link']));
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>