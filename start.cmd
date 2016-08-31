@echo off
TITLE T-STAR server software for Minecraft: Pocket Edition
cd /d %~dp0

if exist bin\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)

if exist T-STAR*.phar (
	set POCKETMINE_FILE=T-STAR*.phar
) else (
	if exist PocketMine-MP.phar (
		set POCKETMINE_FILE=PocketMine-MP.phar
	) else (
	    if exist src\pocketmine\PocketMine.php (
	        set POCKETMINE_FILE=src\pocketmine\PocketMine.php
		) else (
			if exist T-STAR.phar (
				set POCKETMINE_FILE=T-STAR.phar
			) else (
		        echo "[ERROR] Couldn't find a valid T-STAR installation."
		        pause
		        exit 8
		    )
	    )
	)
)
