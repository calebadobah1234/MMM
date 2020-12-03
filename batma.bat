@echo off
goto main

:main
setlocal

	for /r %%i in ( * ) do (
		echo 1234url5678
		echo	1234loc5678%%i1234/loc5678
		echo	1234changefreq5678daily1234/changefreq5678
		echo 1234priority567811234/priority5678
		echo 1234/url5678
	)
	
	endlocal

goto :eof
batma.bat > xxxx.sql	

pause	
	
