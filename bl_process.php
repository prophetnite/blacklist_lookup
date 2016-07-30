<?php
/*  script:  bl_process.php
    author:  Sebastian R. Usami <sebastianusami@gmail.com>
    license: GPLv3

    description:
        Performs DNS lookup from public DNS Blacklist services
        Parses return responce and generates table of repsonces
    usage:
        usage: php bl_process.php [ip]
    todo:
        Replace table with return array
        Generate seperate php to create table from array
        Generate proper responces from each blacklist, they differ :(
        Fix $_POST[server] VS $argv[1], its just sloppy
*/

if ( isset($argv[1]) ) { $ip = $argv[1];
} elseif ( isset($_POST['server']) ) { $ip = $_POST['server'];
} else {$ip = "69.30.196.250";}

//#$ip = ($_POST['server']) ? $_POST['server'] : '69.30.196.250';
//$ip = ($argv[1]) ? $argv[1] : '69.30.196.250';

echo "<b>IP: " . $ip . "</b><br><br>";

    $table = "<table border=1>";
    $table .= "<tr><th>BLACKLIST</th>    <th>RESPONCE</th></tr>";

$blist=array(
    array("blist_server" => "dnsbl.httpbl.org", 	"apikey" => "ucsxlknhmfpt." ),
    array("blist_server" => "cbl.abuseat.org", 		"apikey" => "" ),
    array("blist_server" => "dnsbl.sorbs.net", 		"apikey" => "" ),
    array("blist_server" => "bl.spamcop.net", 		"apikey" => "" ),
    array("blist_server" => "zen.spamhaus.org", 	"apikey" => "" ),
    array("blist_server" => "combined.njabl.org", 	"apikey" => "" )
);

foreach ($blist as &$blist_item) {

    $lookup = $blist_item["apikey"] . implode('.', array_reverse(explode ('.', $ip ))) . '.' . $blist_item["blist_server"];
    echo $lookup . "<br>"; // FOR TESTING
    $result = explode( '.', gethostbyname($lookup));  // Perform actual lookup
    
    if ($result[0] == 127 && $result[3] != 0) {
    // If result POSITIVE (127) and NOT a search engine 
        $activity = $result[1];		// Days since last activity
        $threat = $result[2];		// Threat score
        $type = $result[3];		// Search engine, suspicious, harvester or comment spammer

        if ($type & 0) $typemeaning .= 'Search Engine, ';
        if ($type & 1) $typemeaning .= 'Suspicious, ';
        if ($type & 2) $typemeaning .= 'Harvester, ';
        if ($type & 4) $typemeaning .= 'Comment Spammer, ';
	$typemeaning = trim($typemeaning,', ');

        $responce =  "IP seems to belong to a $typemeaning ($type) with threat level $threat" . "<br>";
        $table .= "<tr><td>" . $blist_item["blist_server"] . "</td><td>" . $responce . "</td></tr>";

        
    } elseif ($result[0] == 127 && $result[3] == 0) {
    // If result is TRUE for SearchEngine
        $activity = $result[1];		// Days since last activity
        $serial = $result[2];		// Search Engine Serial
        $type = $result[3];		// Search engine, should = 0 only

        if ($type == 0) $typemeaning .= 'Search Engine'; // condition not required, for uniformity only
        //if ($type == 1) $typemeaning .= 'Suspicious';
        //if ($type == 2) $typemeaning .= 'Harvester';
        //if ($type == 4) $typemeaning .= 'Comment Spammer';

	if ($serial == 0) $searchEngine .= 'undocumented, ';
	if ($serial == 1) $searchEngine .= 'AltaVista, ';
	if ($serial == 2) $searchEngine .= 'Ask, ';
	if ($serial == 3) $searchEngine .= 'Baidu, ';
	if ($serial == 4) $searchEngine .= 'Excite, ';
	if ($serial == 5) $searchEngine .= 'Google, ';
	if ($serial == 6) $searchEngine .= 'Looksmart, ';
	if ($serial == 7) $searchEngine .= 'Lycos, ';
	if ($serial == 8) $searchEngine .= 'MSN, ';
	if ($serial == 9) $searchEngine .= 'Yahoo, ';
	if ($serial == 10) $searchEngine .= 'Cuil, ';
	if ($serial == 11) $searchEngine .= 'InfoSeek, ';
	if ($serial == 12) $searchEngine .= 'Misc, ';
	$searchEngine = trim($searchEngine,', ');

        $responce = "IP seems to belong to a $typemeaning ($type) with serial $serial, $searchEngine" . "<br>";
        $table .= "<tr><td>" . $blist_item["blist_server"] . "</td><td>" . $responce . "</td></tr>";

    } else {
    // If no result found or nxdomain
        $responce = "IP no responce" . "<br>";
        $table .= "<tr><td>" . $blist_item["blist_server"] . "</td><td>" . $responce . "</td></tr>";
    }

}

$table .= "</table>";
echo $table;



?>
