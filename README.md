Project "File Parser" for GitHub demonstration by Alena Mokhova.

##Used technologies:
- PHP 8.1
- Composer
- psalm
- php-lint
- Docker

##How to use that service:
1) Download that repository
2) In your console go to the directory where you installed this repository (via `cd <path>`)
3) Type in console `make build`. It will start docker container on 9000 port.
4) Type in console `make sh`. It will bring you into the docker container.
5) Type in console `php parser.php`. See results of parsing of files.

##How to use additional components
Open `Makefile` file in root directory of this project. It has commands for command line.

Go to command line, go into docker container of project via `make sh`, type `make psalm`, for example, to start psalm checking process.