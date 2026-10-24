# BiblioSys - Sistema de Gestão de Acervo (Avaliação II)

Este projeto consiste em uma aplicação web completa para o gerenciamento de uma biblioteca, desenvolvida como requisito para a Avaliação II da disciplina de Linguagem de Programação PHP. O sistema foi construído utilizando os conceitos mais modernos da linguagem, aplicando a arquitetura MVC (Model-View-Controller) de forma estrita e um banco de dados simulado em sessão.

## 🎯 Funcionalidades Implementadas

O sistema atende a todos os requisitos propostos na avaliação, destacando-se por:
- **CRUD Completo:** Gestão total (Criação, Leitura, Atualização e Exclusão) para duas entidades: Livros e Categorias.
- **Relacionamento de Dados (1:N):** Vinculação visível entre Categorias e Livros. Ao acessar os detalhes de uma categoria, o sistema exibe dinamicamente o acervo de livros pertencente a ela.
- **Listagem com Busca:** Filtro de pesquisa em tempo real na tela de livros (por título ou autor).
- **API JSON:** Rotas dedicadas para consumo externo dos dados (consulta, inserção e exclusão).
- **Segurança e Validação:** Sistema de login para proteção de rotas internas, além de validações de formulário com mensagens de sucesso e erro amigáveis.
- **Interface Premium:** Design focado na experiência do usuário (UX), apresentando um tema Dark (Black Theme) moderno, responsivo e com animações suaves.

## 🛠️ Arquitetura e Tecnologias

- **PHP 8+**: Utilização de tipagem estrita (`declare(strict_types=1)`), namespaces, arrow functions e padrões de projeto modernos.
- **Padrão MVC:** 
  - `index.php`: Front Controller responsável pelo roteamento e configuração do ambiente.
  - `app/Controllers`: Regras de negócio e controle de fluxo.
  - `app/Views`: Camada de visualização separada em layouts, formulários e listagens.
- **Autoloader PSR-4:** Implementação manual para carregamento automático de classes, otimizando a performance do sistema.
- **Banco de Dados em Sessão:** Persistência de dados gerenciada via `$_SESSION`, conforme exigido no escopo do projeto, sem a necessidade de um SGBD externo.
- **Front-end:** HTML5, CSS3 puro e design system próprio com variáveis (CSS Variables).

## 🚀 Como Executar o Projeto

1. Certifique-se de ter um servidor local ativo (XAMPP, Laragon, WAMP ou o servidor embutido do PHP).
2. Se estiver utilizando o XAMPP, mova a pasta do projeto para o diretório `htdocs`.
3. Inicie o serviço do Apache.
4. Abra o navegador e acesse:
   👉 `http://localhost/nome_da_pasta/index.php`
5. **Credenciais de Acesso:**
   - **E-mail:** `admin@email.com`
   - **Senha:** `123456`

## 🔗 Documentação da API (Rotas JSON)

Para testar as rotas da API, você pode utilizar o navegador (para GET) ou ferramentas como Postman e Insomnia (para POST):

- **Consultar Livros (GET):** `http://localhost/nome_da_pasta/index.php?route=api/livros`
- **Inserir Livro (POST):** `http://localhost/nome_da_pasta/index.php?route=api/inserir`
  *(Enviar no Body: `{"titulo": "Nome", "autor": "Autor", "categoria_id": 1}`)*
- **Excluir Livro (GET):** `http://localhost/nome_da_pasta/index.php?route=api/excluir&id=1`

## 📝 Estrutura de Pastas
```text
/
├── index.php               # Roteador principal e Front Controller
├── README.md               # Documentação do projeto
├── public/
│   └── style.css           # Folha de estilos global (Tema Dark)
└── app/
    ├── Controllers/        # Controladores do sistema (Auth, Livro, Categoria, Api)
    └── Views/              # Telas do sistema
        ├── auth/           # Tela de Login
        ├── categorias/     # Telas de Categorias
        ├── layouts/        # Cabeçalho e Rodapé
        └── livros/         # Telas de Livros