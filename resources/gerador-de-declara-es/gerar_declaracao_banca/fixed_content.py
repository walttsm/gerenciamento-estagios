from reportlab.platypus import Paragraph, Frame


def draw_title(c):
    """Writes the title of the document."""
    c.saveState()
    c.setFont('Helvetica-Bold', 18)
    c.drawCentredString(PAGE_WIDTH/2.0, 240*mm, "DECLARAÇÃO")
    c.restoreState()


def draw_footer(c):
    """ Writes the footer of the document."""
    footer = Frame(25*mm, 0, 160*mm, 35*mm)
    p = Paragraph(("Credenciado - Dec: de 24/04/2001 - DOU de 25/04/2001 - Recredenciado - Portaria nº 814 - DOU de 27/08/2007<br/>"
                   "Mantenedora: <b>Instituto Filadélfia de Londrina</b>"), styles['footerStyle'])
    footer.add(p, c)

    return footer
