<?php

$endpoint_url = 'https://era.library.ualberta.ca/oai';
$metadata_prefix = 'ore';
$from_date = new DateTime('2017-11-01');
$to_date = null;
$set = null;
$output_dir = 'output';

require 'vendor/autoload.php';

$client = new \Phpoaipmh\Client($endpoint_url);
$endpoint = new \Phpoaipmh\Endpoint($client);

@mkdir($output_dir);

$recs = $endpoint->listRecords($metadata_prefix, $from_date, $to_date, $set);
foreach($recs as $rec) {
   $identifier = urlencode($rec->header->identifier);
   $record_path = $output_dir . DIRECTORY_SEPARATOR . $identifier . '.oai.xml';
   file_put_contents($record_path, $rec->asXML());
}
