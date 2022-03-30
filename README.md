# Sistema de gerenciamento de estágios

Seja bem vindo ao repositório do sistema de gerenciamento de estágios da UNIFIL.

Aqui estão disponíveis os arquivos com o código do sistema, para que futuramente, demais alunos possam continuar o desenvolvimento de demais funcionalidades do sistema.

## Tecnologias usadas

1. PHP 8.0
2. Laravel 9
3. MySQL 5.7
4. Docker
5. Tailwind CSS

## Configurando e iniciando o ambiente de desenvolvimento (Windows)

As instruções de instalação aqui apresentadas estão usando como base sistemas operacionais Windows, caso você utilize outro sistema operacional, adapte as instruções para o seu sistema de escolha.

Não serão dadas instruções detalhadas de como instalar todas as ferramentas, apenas direcionamentos para instruções presentes nas documentações das ferramentas.

### Instalando php e composer localmente
Para instalar o php e o composer, podemos usar duas formas:

1. Usando [chocolatey](https://chocolatey.org/install)
    - Instale o chocolatey
    - Instale o php e o composer usando o comando
    `choco install php composer`

2. Instalando manualmente
    - Acesse o site do [PHP](https://windows.php.net/download#php-8.0), baixe e o instale.
    - Acesse o site do [composer](https://getcomposer.org/download/), baixe e o instale.

### Instalando o docker

1. Para instalar o docker, o Windows Subsystem for Linux deve estar instalado previamente. Instruções de instalação do WSL estão disponíveis [aqui](https://docs.microsoft.com/pt-br/windows/wsl/install).

2. Após instalar o WSL, instale o [docker](https://www.docker.com/get-started).

### Executando o ambiente

1. Crie uma cópia do arquivo '.env.example' com o nome '.env' na pasta raiz do projeto.

2. Na região de conexão com o banco de dados, coloque o código abaixo:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gerenciamento-estagio
DB_USERNAME=root
DB_PASSWORD=
```

3. Acesse o diretório de arquivos do projeto num terminal e execute o comando:
`docker-compose-up -d`

4. Caso o comando tenha sido bem sucedido, você deve ser capaz e encontrar uma saída como abaixo ao executar o comando `docker ps`:

![resultado-docker-ps](https://github.com/walttsm/gerenciamento-estagios/blob/main/readme-images/docker-ps-result.png).

5. Alternativamente, você pode checar a criação do contêiner no aplicativo docker desktop.

6. Pegue o código do contêiner da aplicação, e rode o comando: 
`docker exec -it <código do conteiner> bash`

7. O código acima irá abrir um terminal interno no conteiner, onde você irá executar o comando para instalar as dependências do composer:

```
composer install
```

8. Agora experimente acessar localhost:8080. A aplicação deve estar funcionando para você começar a desenvolver.

9. Quando for executar os comandos de criação de componentes do composer e do php artisan, use esse terminal do contêiner.

10. Ao finalizar seus trabalhos é possível fechar o terminal usando control + d. Caso for voltar a desenvolver basta acessar o terminal do contêiner usando os comandos do item número 6.
