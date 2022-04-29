import os
import gerar_declaracao_banca.content as content
from reportlab.pdfgen import canvas


def gerar_certificado(aluno, curso, titulo, banca1, banca2, banca3, coord_curso, coord_tcc, ano, nome_pdf):
    """Generates PDF files. """
    # Make the document
    c = canvas.Canvas(nome_pdf)
    content.draw_title(c)
    content.draw_content(c, aluno, curso, titulo, banca1,
                         banca2, banca3, ano)
    content.draw_coord(c, curso, coord_curso, coord_tcc)
    content.draw_signatures(c, coord_curso, coord_tcc)
    content.draw_footer(c)
    # Save document
    c.showPage
    c.save()
