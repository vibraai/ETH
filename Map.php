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
ini_set('memory_limit', '2048M');
/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array('kotetszam', 'megye', 'telepulesSZTA', 'evszam', 'hivatkozas', 'adat', 'helyfajta', 'SZTAmegjegyzes', 'egyebmegjegyzes', 'nemmagyarnevvaltozat', 'Sorszam', 'szelesseg', 'hosszusag', '1913asnev', 'maitelepulesnev', 'nemmagyarnevSZTA');
$aColumnsMap = array('telepulesSZTA', 'adat', 'szelesseg', 'hosszusag');

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
$gaSql['user'] = "root";
$gaSql['password'] = "";
$gaSql['db'] = "csv_db";
$gaSql['server'] = "localhost";


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * MySQL connection
 */
$gaSql['link'] = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);
mysqli_set_charset($gaSql['link'], "utf8");

$sWhere = "";
for ($i = 0; $i < count($aColumns); $i++) {
    if ($_GET['sSearch_' . $i] != '') {

        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }

        if (strpos($_GET['sSearch_' . $i], ' OR ') !== false) {
            $arrOR = explode(" OR ", $_GET['sSearch_' . $i]);
            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrOR[0]) . "%' ";
            for ($j = 1; $j < count($arrOR); $j++) {
                if (strpos($arrOR[$j], ' NOT ') !== false) {
                    $lastOR = explode(" NOT ", $arrOR[$j])[0];
                    $arrNOTOR = explode(" NOT ", $_GET['sSearch_' . $i]);
                    $sWhere .= " OR ";
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $lastOR) . "%' ";
                    $sWhere .= ")";
                    $sWhere .= " AND ";
                    $sWhere .= "(" . $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOTOR[1]) . "%' ";
                    for ($k = 2; $k < count($arrNOTOR); $k++) {
                        $sWhere .= " AND ";
                        $sWhere .= $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOTOR[$k]) . "%' ";
                    }
                } else {
                    $sWhere .= " OR ";
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrOR[$j]) . "%' ";
                }
            }
            $sWhere .= ")";
        } else if (strpos($_GET['sSearch_' . $i], ' AND ') !== false) {
            $arrAND = explode(" AND ", $_GET['sSearch_' . $i]);
            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrAND[0]) . "%' ";
            for ($j = 1; $j < count($arrAND); $j++) {
                if (strpos($arrAND[$j], ' NOT ') !== false) {
                    $lastAND = explode(" NOT ", $arrAND[$j])[0];
                    $arrNOTAND = explode(" NOT ", $_GET['sSearch_' . $i]);
                    $sWhere .= " AND ";
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $lastAND) . "%' ";
                    $sWhere .= ")";
                    $sWhere .= " AND ";
                    $sWhere .= "(" . $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOTAND[1]) . "%' ";
                    for ($k = 2; $k < count($arrNOTAND); $k++) {
                        $sWhere .= " AND ";
                        $sWhere .= $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOTAND[$k]) . "%' ";
                    }
                } else {
                    $sWhere .= " AND ";
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrAND[$j]) . "%' ";
                }
            }
            $sWhere .= ")";
        } else if (strpos($_GET['sSearch_' . $i], ' NOT ') !== false) {
            $arrNOT = explode(" NOT ", $_GET['sSearch_' . $i]);
            if (substr($_GET['sSearch_' . $i], 0, 4) == 'NOT ') {
                $sWhere .= "(" . $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], substr($arrNOT[0], 4, strlen($arrNOT[0]))) . "%' ";
            } else {
                $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOT[0]) . "%' ";
            }
            for ($j = 1; $j < count($arrNOT); $j++) {
                $sWhere .= " AND ";
                $sWhere .= $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], $arrNOT[$j]) . "%' ";
            }
            $sWhere .= ")";
        } else if (substr($_GET['sSearch_' . $i], 0, 4) == 'NOT ') {
            $arrNOT = explode(" NOT ", $_GET['sSearch_' . $i]);
            $sWhere .= "" . $aColumns[$i] . " NOT LIKE '%" . mysqli_real_escape_string($gaSql['link'], substr($arrNOT[0], 4, strlen($arrNOT[0]))) . "%' ";
        } else if ($aColumns[$i] == "evszam") {
            $arrEvszam = explode("-", $_GET['sSearch_' . $i]);

            if (count($arrEvszam) == 2 && $arrEvszam[0] != null && strlen($arrEvszam[0]) == 4 && $arrEvszam[1] != null && strlen($arrEvszam[1]) == 4) {
                $sWhere .= $aColumns[$i] . " BETWEEN '" . $arrEvszam[0] . "' AND '" . $arrEvszam[1] . "'";
            } else {
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
            }
        } else {
            $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
        }
    }
}


/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnsMap)) . "
        FROM   $sTable
        $sWhere
";


$rResult = mysqli_query($gaSql['link'], $sQuery) or die(mysqli_error($gaSql['link']));
$results = null;
//$results[] = $aColumns;
$line = null;
while ($line = mysqli_fetch_array($rResult, MYSQL_ASSOC)) {
    $results[] = $line;
}
$rResult->close();
$gaSql['link']->close();


echo json_encode($results);
?>