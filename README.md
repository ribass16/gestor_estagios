# 🎓 GestãoISTEC

Aplicação web desenvolvida em **Laravel 12** com autenticação e gestão de utilizadores (Admin, Aluno, Orientador e Empresa).  
O objetivo do projeto é servir como base para o sistema de gestão de estágios do ISTEC.

---

## 🧩 Funcionalidades

- Sistema de autenticação (Laravel Breeze)  
- Perfis de utilizador:
  - 👨‍💼 **Admin** – acesso total ao sistema  
  - 🎓 **Aluno** – gestão do próprio perfil e estágios  
  - 🧑‍🏫 **Orientador** – acompanhamento de alunos  
  - 🏢 **Empresa** – gestão de propostas de estágio  
- Painéis personalizados por tipo de utilizador  
- Sistema de logout e proteção de rotas com middleware  
- Estrutura modular para futuras expansões (CRUDs, dashboards, etc.)

---

## ⚙️ Instalação do Projeto

### 1️⃣ Clonar o repositório
git clone https://github.com/ribass16/gestor_estagios.git
cd gestor_estagios

2️⃣ Instalar dependências do Laravel
composer install

3️⃣ Criar o ficheiro .env
cp .env.example .env
Atualiza as credenciais da base de dados conforme o teu ambiente local:

env
DB_DATABASE=gestaoistec
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Gerar a chave da aplicação

Copiar código
php artisan key:generate

5️⃣ Criar a base de dados e popular com dados de teste
php artisan migrate --seed

Isto cria os utilizadores iniciais:
Tipo	          Email	                Password
🧑‍💼 Admin	      admin@istec.pt	    admin123
🎓 Aluno	      aluno@istec.pt	    aluno123
🧑‍🏫 Orientador  orientador@istec.pt	orientador123
🏢 Empresa	      empresa@istec.pt	    empresa123

6️⃣ Instalar dependências do frontend
npm install

7️⃣ Iniciar os servidores
Abre dois terminais:

Laravel (backend):
php artisan serve

Vite (frontend):
npm run dev
