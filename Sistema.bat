@echo off
REM Caminho para o diretório do XAMPP
set "xampp_path=C:\xampp"

REM Iniciar o Apache
echo Iniciando o Apache...
start "" "%xampp_path%\apache_start.bat"

REM Aguardar alguns segundos para o Apache iniciar completamente
timeout /t 5

REM Iniciar o MySQL
echo Iniciando o MySQL...
start "" "%xampp_path%\mysql_start.bat"

REM Aguardar alguns segundos para o MySQL iniciar completamente
timeout /t 5

REM URL do sistema web
set "system_url=http://localhost/school-bazaar/school-bazaar/person"

REM Abrir a URL no navegador padrão
echo Abrindo a URL do sistema web...
start "" %system_url%

REM Aguardar para manter o prompt aberto (opcional)
pause
