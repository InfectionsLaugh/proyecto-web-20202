<?php
require('midi/midi.class.php');

$song = basename($_GET['name']. '.mid');
$outfile = "$song";

$midi = new Midi();

$midi->downloadMidFile($outfile, $song);