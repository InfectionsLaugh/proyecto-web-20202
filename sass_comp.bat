@echo off

if "%1%" == "watch" (sass sass/main.sass css/main.css --watch --style compressed)
if "%1%" == "build" (sass sass/main.sass css/main.css --sastyle compressed)
