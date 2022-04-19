# Gerador de declarações para bancas de tcc

## Sobre

Este projeto serve para a geração de declarações que comprovem a apresentação de tccs da instituição UNIFIL. 
Os dados são obtidos através de arquivos .csv e as declarações podem ser geradas com ou sem assinaturas.

## Requisitos

Para utilizar este projeto, você deve ter instalado em seu sistema:
1. Python >= 3.8.2
2. ReportLab
3. gender_guesser

Para facilitar o processo, vou explicar como instalar as bibliotecas utilizando o Poetry, uma ferramenta de gerenciamento de dependências para python. No entanto é possível reproduzir o processo usando o virtualenv, basta instalar as bibliotecas no seu ambiente virtual.

## Instalação e execução

1. Primeiramente, entre no site oficial do Python, baixe e instale a versão mais recente (caso já não tenha python instalado no seu sistema).
2. Em seguida acesse https://python-poetry.org e instale o Poetry.
3. Terminada a instalação, abra a pasta do projeto no seu terminal de preferência e rode o comando 
   
   ```console
    poetry install
    ```
    Isto instalará todas as dependências usadas no projeto em um ambiente virtual.
<br>
4. Com seu ambiente virtual em execução, execute o arquivo "exec.py" com o comando:
    ```console
    python exec.py
    ```

## Observações de utilização

### Colocando dados para geração das declarações

No interior da pasta 'gerar_declaracao_banca/dados' temos dois arquivos .csv (lembrando que os valores de cada informação deve estar separeda por vírgula, e de preferÊncia sem espaços após a vírgula):

1. docInfo.csv: Aqui é onde devem estar as informações para preencher o conteudo do documento, na seginte ordem: Nome do aluno, curso, título do TCC, Orientador e integrantes da banca.
2. infoCursos.csv: Aqui ficarão armazenadas as informações dos cursos para gerar a declaração: Nome do curso, coordenador do curso e coordenador de TCCs. 
   
### Assinaturas
Para incluir as assinaturas, coloque-as com imagem .jpg na pasta assinaturas dentro de dados. O nome do arquivo deve ser o nome completo do autor da assinatura com todos os caracteres minúsculos e com os nomes separados por hífen (-). 
Caso o programa não encontre uma assinatura correspondente com o nome do assinante, o documento será gerado sem assinatura para que esta seja feita depois da impressão do documento.