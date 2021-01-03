<?php

require('midi/midi.class.php');
session_start();

$bpm = $_POST['bpm'];
$name = $_POST['name'];
$notes = $_POST['notes'];

if(isset($_SESSION['user_name'])) {
    $author = $_SESSION['user_name'];
} else {
    $author = "Unknown";
}

$midi = new Midi();

$midi->open(96);

$newTrack = $midi->newTrack();
$midi->addMsg(0, "0 Meta TrkName $name");
$midi->addMsg(0, "0 Meta Copyright $author");
$midi->addMsg(0, "0 TimeSig 4/4 24 8");
$midi->addMsg(0, "0 KeySig 255 minor");
$midi->addMsg(0, "0 Meta TrkEnd");

$newTrack = $midi->newTrack();
$tempo = round(60000000 / $bpm);
$midi->addMsg(1, "0 Tempo $tempo");
$midi->addMsg(1, "0 Meta TrkEnd");

$newTrack = $midi->newTrack();

foreach($notes as $note) {
    $noteStart = $note['index'] * 24;
    $noteEnd = $noteStart + 24;
    $notePlay = $note['note'];
    $midi->insertMsg(2, "$noteStart On ch=1 n=$notePlay v=100");
    $midi->insertMsg(2, "$noteEnd Off ch=1 n=$notePlay v=0");
}

$midi->saveMidFile("$name.mid");

echo json_encode(['response' => 'success', 'song_name' => "$name"]);
