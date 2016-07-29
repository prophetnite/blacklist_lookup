<?php
//$ip = $_SERVER['REMOTE_ADDR'];
//$ip = '89.178.207.116'; // known spam server
$ip = '127.1.1.0';

$blist=array(
    array("blist_server" => "dnsbl.httpbl.org", 	"apikey" => "ucsxlknhmfpt." ),
    array("blist_server" => "cbl.abuseat.org", 		"apikey" => "" ),
    array("blist_server" => "dnsbl.sorbs.net", 		"apikey" => "" ),
    array("blist_server" => "bl.spamcop.net", 		"apikey" => "" ),
    array("blist_server" => "zen.spamhaus.org", 	"apikey" => "" ),
    array("blist_server" => "combined.njabl.org", 	"apikey" => "" )
);

// blacklist test setup
//$blist_index = 4;
//$apikey = $blist[$blist_index]["apikey"];
//$blist_server = $blist[$blist_index]["blist_server"];


foreach ($blist as &$blist_item) {

// Example : for '127.9.1.2' you should query 'abcdefghijkl.2.1.9.127.dnsbl.httpbl.org'
    $lookup = $blist_item["apikey"] . implode('.', array_reverse(explode ('.', $ip ))) . '.' . $blist_item["blist_server"];

    $result = explode( '.', gethostbyname($lookup));

    if ($result[0] == 127 && $result[3] != 0) {
        $activity = $result[1];		// Days since last activity
        $threat = $result[2];		// Threat score
        $type = $result[3];		// Search engine, suspicious, harvester or comment spammer

        if ($type & 0) $typemeaning .= 'Search Engine, ';
        if ($type & 1) $typemeaning .= 'Suspicious, ';
        if ($type & 2) $typemeaning .= 'Harvester, ';
        if ($type & 4) $typemeaning .= 'Comment Spammer, ';
	$typemeaning = trim($typemeaning,', ');

        echo "IP seems to belong to a $typemeaning ($type) with threat level $threat" . "<br>";
    } elseif ($result[3] == 0) {
        // Should only trigger if Search Engine 
        $activity = $result[1];		// Days since last activity
        $serial = $result[2];		// Search Engine Serial
        $type = $result[3];		// Search engine, should = 0 only

        if ($type == 0) $typemeaning .= 'Search Engine';
        if ($type == 1) $typemeaning .= 'Suspicious';
        if ($type == 2) $typemeaning .= 'Harvester';
        if ($type == 4) $typemeaning .= 'Comment Spammer';

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

        echo "IP seems to belong to a $typemeaning ($type) with serial $serial, $searchEngine" . "<br>";

    } else {
        echo "IP no responce" . "<br>";
    }
}
?>
