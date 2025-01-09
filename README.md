# Project Documentation

## Overview

This project uses Docker and Docker Compose to manage the environment and workflow. Below are the available Makefile
commands to handle the typical operations for the project.

---

## Prerequisites

Before using the Makefile, ensure the following are installed and configured on your system:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Make](https://www.gnu.org/software/make/)

---

## Usage

Use the provided `Makefile` to manage Docker containers and perform actions like building the application, running
tests, and executing commands within the containerized environment.



---

## Quick Start

Follow these steps to quickly set up and run the project:

1. **Build Docker images**
   ```bash
   make build
   ```

2. **Start Docker containers**
   ```bash
   make up
   ```

3. **Install Composer dependencies**
   ```bash
   make composer args="install"
   ```

4. **Set up the environment file**
   ```bash
   cp .env.example .env
   ```

5. **Add environment variable values**  
   Open the `.env` file and configure the necessary environment variables as per your setup.

6. **Set file and directory permissions**
   ```bash
   sudo chown -R user:user app/
   sudo chmod -R 755 database/
   sudo chmod -R 755 storage/
   ```

7. **Run database migrations**
   ```bash
   make artisan args="migrate"
   ```

### Commands

- **Build Docker images**
  ```bash
  make build
  ```
  Build the Docker images defined in the `docker-compose.yml` file.

- **Start Docker containers**
  ```bash
  make up
  ```
  Start the Docker containers in detached mode.

- **Stop Docker containers**
  ```bash
  make down
  ```
  Stop and remove the Docker containers.

- **Run Composer inside the container**
  ```bash
  make composer args="your-composer-command"
  ```
  Example:
  ```bash
  make composer args="install"
  ```
  Runs Composer commands using the `nginx` container.

- **Run PHPUnit tests**
  ```bash
  make test
  ```
  Executes PHPUnit tests from the `nginx` container.

- **Run Laravel Artisan commands**
  ```bash
  make artisan args="your-artisan-command"
  ```
  Example:
  ```bash
  make artisan args="migrate"
  ```
  Executes Laravel Artisan commands using the `nginx` container.

- **Open a shell in the Nginx container**
  ```bash
  make shell
  ```
  Opens an interactive shell session in the `nginx` container under `/var/www/html/nyt-api`.

---

## Usage
This project is configured to respond to the local domain: `nyt-api.local`.
Ensure that you add the following entry to your `/etc/hosts` file to map the domain to your local environment:

```
127.0.0.1 nyt-api.local
```

Additionally, ensure that the Nginx configuration in the Docker setup is properly set up to serve requests for
`nyt-api.local`.

You can access the application's API by navigating to the following endpoint in your browser or through an API client (
e.g., Postman):

## Notes

- The `args` option is used to pass additional arguments for the `composer` and `artisan` commands. Replace
  `"your-command"` with the appropriate subcommand or options for these tools.
- Ensure that `docker-compose.yml` is properly configured to match the project's structure.

---

## Troubleshooting

- If the Docker containers fail to start, check the logs using:
  ```bash
  docker-compose logs
  ```
- Ensure Docker and Docker Compose services are running before using the `Makefile` commands.

---