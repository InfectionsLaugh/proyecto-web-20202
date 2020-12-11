<?php

require('midi/midi.class.php');
session_start();

$bpm = $_POST['bpm'];
$name = $_POST['name'];
$author = $_SESSION['user_name'];

$midi = new Midi();
// $midi->importMid('../music/Undertale_-_Megalovania (1).mid');

// echo "Tipo del archivo: " . $midi->type . "<br/>";
// echo "Cantidad de pistas: " . $midi->getTrackCount() . "<br/>";
// echo "Tempo: " . $midi->getTimebase() . "<br><br/>";

// print_r($midi->getTrack(0));


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
$midi->insertMsg(2, "0 On ch=1 n=62 v=100");
$midi->insertMsg(2, "48 Off ch=1 n=62 v=0");

$midi->insertMsg(2, "48 On ch=1 n=62 v=100");
$midi->insertMsg(2, "96 Off ch=1 n=62 v=0");

$midi->insertMsg(2, "96 On ch=1 n=74 v=100");
$midi->insertMsg(2, "192 Off ch=1 n=74 v=0");

$midi->insertMsg(2, "192 On ch=1 n=69 v=100");
$midi->insertMsg(2, "336 Off ch=1 n=69 v=0");

$midi->saveMidFile("$name.mid");


// for($i = 0; $i < count($midi->getTrack(3)); $i++) {
//     echo "Mensaje " . ($i + 1) . ': ' . $midi->getTrack(3)[$i] . '<br/>';
// }
