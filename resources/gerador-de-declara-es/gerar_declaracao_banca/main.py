import csv
import os
import gerar_declaracao_banca.gerar_declaracao as gerar_declaracao

# Dados Fixos:


def get_coord(curso):
    """ Busca os nomes dos coordenadores baseados no curso do aluno """
    dados_curso = csv.reader(
        open(os.path.join('gerar_declaracao_banca', 'dados', 'infoCursos.csv'), "r", encoding='utf_8'))

    for row in dados_curso:
        if curso == row[0]:
            coord_curso = row[1]
            coord_tcc = row[2]

    return (coord_curso, coord_tcc)


dados_tcc = csv.reader(
    open(os.path.join('gerar_declaracao_banca', 'dados', 'docInfo.csv'), "r", encoding='utf_8'))

for row in dados_tcc:
    aluno = row[0]
    last_name = aluno[aluno.rindex(" ") + 1:]
    curso = row[1]
    titulo = row[2]
    banca1 = row[3]
    banca2 = row[4]
    banca3 = row[5]
    ano = row[6]
    coord_curso = get_coord(curso)[0]
    coord_tcc = get_coord(curso)[1]

    nome_pdf = "declaracao-banca-" + last_name + ".pdf"

    gerar_declaracao.gerar_certificado(aluno, curso, titulo, banca1, banca2, banca3,
                                       coord_curso, coord_tcc, ano, nome_pdf)
