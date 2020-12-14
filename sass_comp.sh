#!/bin/bash

if [ "$1" == "watch" ];
then
    sass sass/main.sass css/main.css --watch --style compressed
fi

if [ "$2" == "build" ];
then
    sass sass/main.sass css/main.css --style compressed
fi