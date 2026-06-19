@echo off
setlocal

set "PGDATA=%USERPROFILE%\scoop\persist\postgresql\data"

for /f "tokens=5" %%P in ('netstat -ano ^| findstr /R /C:":8000 .*LISTENING"') do (
    echo Stopping Laravel on port 8000...
    taskkill /PID %%P /F >nul 2>&1
)

pg_isready -h 127.0.0.1 -p 5432 -d kakeibo >nul 2>&1
if not errorlevel 1 (
    echo Stopping PostgreSQL...
    pg_ctl -D "%PGDATA%" stop
)

echo Local Kakeibo services stopped.
