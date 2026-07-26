# 🧠 MindsHub  

**MindsHub** é uma plataforma desenvolvida com foco em colaboração educacional, utilizando uma stack moderna com Laravel, Node.js, MySQL, Nginx e Docker. O projeto é containerizado para facilitar a configuração, desenvolvimento e deploy. 

## 📌 Tecnologias Utilizadas  

- **Laravel**
- **PHP** 
- **Nginx**
- **PostgreSQL** (Supabase deploy)
- **MySQL** (local Docker Compose)
- **Render**
- **Docker Compose**   

## 🚀 Como Rodar o Projeto  

### 🔧 Pré-requisitos  

Antes de começar, instale os seguintes programas na sua máquina:  

- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/) (Recomendado: LTS)

### ▶️ Rodando o Projeto  

1. **Configurar o ambiente**  
   - Copie e cole o arquivo `.env.example` e renomeie para `.env`.  
   - Copie e cole o seguinte código dentro do arquivo `.env`:  

```env

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

```

2. **Subir os containers do projeto**  
   ```bash
   docker-compose up --build -d
   ```

3. **Acessar o container do back-end**  
   ```bash
   docker exec -it laravel_app bash   
   ```

4. **Instalar as dependências do Laravel**  
   ```bash
   composer install
   ```

5. **Gerar a chave do projeto Laravel**  
   ```bash
   php artisan key:generate
   ```

6. **Criar as tabelas no banco de dados**  
   ```bash
   php artisan migrate
   ```

7. **Instalar as dependências do front-end**  
   ```bash
   npm install
   ```
8. **Instalar as dependências do front-end**  
   ```bash
   npm run build
   ```

9. **Compilar os assets do front-end**  
   ```bash
   npm run dev
   ```

### 🎯 Acesse o Projeto  

- **Front-end:** [http://localhost/](http://localhost/)  
- **phpMyAdmin:** [http://localhost:8082](http://localhost:8082)

## 🚀 Deploy no Render com Supabase  

1. Faça push do repositório para o GitHub, GitLab ou Bitbucket.  
2. No Render, crie um novo serviço web usando o repositório e mantenha o ambiente em `docker`.  
3. Use o `Dockerfile` existente e defina estas variáveis de ambiente:  
   - `APP_ENV=production`  
   - `APP_DEBUG=false`  
   - `APP_KEY` com o valor gerado por `php artisan key:generate --show`  
   - `APP_URL` com a URL do serviço Render  
   - `DB_CONNECTION=pgsql`  
   - `DB_URL` com a URL do Supabase (recomendado) ou `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`  
   - `DB_SSLMODE=require`  
   - `LOG_CHANNEL=stderr`  
4. O arquivo `render.yaml` já está configurado para rodar no Render e suporta conexão PostgreSQL/Supabase.  
5. No primeiro deploy, o container executará `php artisan migrate --force` automaticamente pelo `entrypoint.sh`.  

## ➕ Comandos Úteis  

### 🔄 Limpar o cache e imagens do Docker
   ```bash
   docker system prune -a
   ```
### Subir os containers 
   ```bash
   docker-compose up -d
   ```
### Remover containers
   ```bash
   docker-compose down
   ```
