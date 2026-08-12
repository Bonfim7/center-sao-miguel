# Central São Miguel

Sistema de gestão pastoral criado em Laravel para organizar eventos, responsáveis, calendário e demandas de divulgação da comunidade.

## Recursos

- autenticação com perfis de administrador e visualização;
- dashboard com indicadores e próximos encontros;
- calendário mensal interativo;
- cadastro, edição, busca e exclusão de eventos;
- fila de eventos que precisam de divulgação;
- layout responsivo para desktop e celular.

## Instalação

```bash
composer install
copy .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --seed
php artisan serve
```

Acesse `http://127.0.0.1:8000`.

## Acessos iniciais

- Administrador: `admin@centralsaomiguel.com.br` / `1234`
- Visualização: `visitante@centralsaomiguel.com.br` / `0000`

Troque essas senhas antes de publicar em produção.

## Demonstração no Render

Crie um Web Service com runtime `Docker`. O container prepara automaticamente o banco, executa as migrações e inicia o Apache na porta fornecida pelo Render.

Para uma demonstração descartável, configure `DB_CONNECTION=sqlite` e `DB_DATABASE=/tmp/database.sqlite`. Os dados podem ser reiniciados a cada novo deploy. Em produção, use PostgreSQL.
