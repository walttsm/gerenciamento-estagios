import os
from datetime import date as Date

from reportlab.lib.units import mm
# from reportlab.platypus import Paragraph, Frame, Spacer
from reportlab.platypus import *

from gender_guesser import detector as gender_guesser

import gerar_declaracao_banca.styles as styles
from gerar_declaracao_banca.dados.assinaturas import *
from gerar_declaracao_banca.styles import PAGE_WIDTH


def draw_title(c):
    """Writes the title of the document."""
    c.saveState()
    c.setFont('Helvetica-Bold', 18)
    c.drawCentredString(PAGE_WIDTH / 2.0, 240 * mm, "DECLARAÇÃO")
    c.restoreState()


def get_gender_flex(name):
    """ Gets gender based on the name and returns the portuguese word gender flex character """
    first_name = name[0: name.index(" ")]
    d = gender_guesser.Detector()
    gender = d.get_gender(first_name)

    if gender == "female":
        gender_flex = "a"
    else:
        gender_flex = "o"

    return gender_flex


def write_paragraph(aluno, curso, titulo, banca1, banca2, banca3, ano):
    """ Writes the paragraph based onthe gender of the student, and the 3 teachers """
    student_flex = get_gender_flex(aluno)
    banca1_flex = get_gender_flex(banca1)
    banca2_flex = get_gender_flex(banca2)
    banca3_flex = get_gender_flex(banca3)

    if banca1_flex == "a":
        professor_flex = "professora"
        orientador_flex = "orientadora"
    else:
        professor_flex = "professor"
        orientador_flex = "orientador"

    if banca2_flex == "a" and banca3_flex == "a":
        banca_flex = "as professoras"
    else:
        banca_flex = "os professores"

    p = ("Declaramos a realização, em " + ano + ", da banca de avaliação"
                                                " do Trabalho de Conclusão de Curso (TCC) entitulado "
                                                '<b>“' + titulo + '”</b>, de autoria de <b>' + aluno +
         "</b>, alun" + student_flex + " do curso de " + curso + ", "
                                                                  "orientad" + student_flex + " pel" + banca1_flex +
         " " + professor_flex + " " + "<b>" + banca1 + "</b>."
                                                       " Além do " + orientador_flex + ", a banca "
                                                                                       "teve em sua composição de avaliação " + banca_flex +
         " <b>" + banca2 + '</b> e <b>' + banca3 + '.</b>')

    return p


def get_date():
    """ Generates the text with the document's date """
    date = Date.today()
    # Data do documento
    dia_string = date.day.__str__()
    mes_string = {1: 'janeiro', 2: 'fevereiro', 3: 'março', 4: 'abril', 5: 'maio', 6: 'junho', 7: 'julho', 8: 'agosto',
                  9: 'setembro',
                  10: 'outubro', 11: 'novembro', 12: 'dezembro'}
    ano_string = date.year.__str__()
    date_text = ("Londrina, " + dia_string + " de " +
                 mes_string[date.month] + " de " + ano_string + ".")

    return date_text


def draw_content(c, aluno, curso, titulo, banca1, banca2, banca3, ano):
    """ Writes the content of the document. """
    # Makes the text
    textFrame = Frame(25 * mm, 100 * mm, 160 * mm, 110 * mm)
    paragraph = Paragraph(write_paragraph(
        aluno, curso, titulo, banca1, banca2, banca3, ano), styles.paragraphStyle)
    textFrame.add(paragraph, c)
    textFrame.add(Spacer(1 * mm, 20 * mm), c)
    date_paragraph = Paragraph(get_date(), styles.dateStyle)
    textFrame.add(date_paragraph, c)
    return textFrame


def draw_coord(c, curso, coord_curso, coord_tcc):
    """ Writes the names of the people who will sign the document."""
    sign_lines = [(30 * mm, 90 * mm, 100 * mm, 90 * mm),
                  (110 * mm, 90 * mm, 180 * mm, 90 * mm)]
    c.lines(sign_lines)
    frame1 = Frame(25 * mm, 65 * mm, 80 * mm, 25 * mm)
    frame2 = Frame(105 * mm, 65 * mm, 80 * mm, 25 * mm)
    c1 = Paragraph(("<b>" + coord_curso + "</b> <br/>"
                                          "Coord. do Curso<br/>"
                                          "Colegiado de " + curso + "<br/>"
                                                                    "Instituto Filadélfia de Londrina | UniFil"),
                   styles.coordStyle)
    frame1.add(c1, c)
    c2 = Paragraph(("<b>" + coord_tcc + "</b> <br/>"
                                        "Coord. dos Trabalhos de Conclusão de Curso<br/>"
                                        "Colegiado de " + curso + "<br/>"
                                                                  "Instituto Filadélfia de Londrina | UniFil"),
                   styles.coordStyle)
    frame2.add(c2, c)

    return frame1, frame2


def draw_signatures(c, coord_curso, coord_tcc):
    """ Inserts the signatures onto the document, if there is not a signature in the signatures folder, it generates a file without signatures"""
    key1 = coord_curso.strip()
    key1 = key1[key1.index(" ") + 1:]
    key1 = key1.lower()
    key1 = key1.replace(" ", "-")
    path1 = "gerar_declaracao_banca/dados/assinaturas/{}.jpg".format(key1)
    key2 = coord_tcc.strip()
    key2 = key2[key2.index(" ") + 1:]
    key2 = key2.lower()
    key2 = key2.replace(" ", "-")
    path2 = "gerar_declaracao_banca/dados/assinaturas/{}.jpg".format(key2)
    frame1 = Frame(25 * mm, 90 * mm, 80 * mm, 30 * mm)
    frame2 = Frame(105 * mm, 90 * mm, 80 * mm, 30 * mm)
    try:
        signature1 = Image(os.path.join(path1), 75 * mm, 25 * mm)
        frame1.add(signature1, c)
    except:
        pass

    try:
        signature2 = Image(os.path.join(path2), 75 * mm, 25 * mm)
        frame2.add(signature2, c)
    except:
        pass

    return frame1, frame2


def draw_footer(c):
    """ Writes the footer of the document."""
    footer = Frame(25 * mm, 0, 160 * mm, 35 * mm)
    p = Paragraph(("Credenciado - Dec: de 24/04/2001 - DOU de 25/04/2001 - Recredenciado - Portaria nº 814 - DOU de "
                   "27/08/2007<br/> "
                   "Mantenedora: <b>Instituto Filadélfia de Londrina</b>"), styles.footerStyle)
    footer.add(p, c)

    return footer
