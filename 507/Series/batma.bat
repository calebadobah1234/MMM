@echo off
goto main

:main
setlocal 

	for /r %%i in ( * ) do (
		echo (Null ,'%%~nxi ' ,'Download Server-11', '%%i', '%%~nxi'^),
	)
	
	endlocal
	
GOTO :EOF
batma.bat > xxxx.sql


	
