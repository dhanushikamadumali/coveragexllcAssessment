# Coveragexllc Assessment

# Laravel + Vue3 REST API with Docker

This project is a REST API built with Laravel for the backend and Vue 3 for the frontend. The application runs inside Docker containers without using Laravel Sail. This README provides instructions for setting up the development environment, building the Docker containers, and running the application.

## Table of Contents

- [Project Overview](#project-overview)
- [Installation](#installation)
- [Running the Application](#running-the-application)

## Project Overview

This project consists of:
- **Laravel REST API:** A backend API powered by Laravel.
- **Vue 3 Frontend:** A SPA built with Vue 3 that consumes the REST API.
- **Docker Environment:** Custom Docker and Docker Compose configuration to manage the containers for PHP, Node, and the database.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Git

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/your-project.git
   cd your-project
   ```
2. **up  docker container:**

      ```bash
      docker-compose up -d
      ```   
3. **Access the application**

    - API: http://localhost:8000
    - Vue Frontend: http://localhost:5173