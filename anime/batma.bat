@echo off
goto main

:main
setlocal enabledelayedexpansion

	for /r %%i in ( * ) do (
		echo (Null ,'%%~nxi ' ,'Download Server-1', '%%i', '%%~nxi'^),
	)
	
	endlocal
	
GOTO :EOF
batma.bat > xxxx.sql


	
