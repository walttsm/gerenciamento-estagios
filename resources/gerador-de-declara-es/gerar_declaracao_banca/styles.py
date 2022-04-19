from reportlab.lib.styles import ParagraphStyle
from reportlab.rl_config import canvas_basefontname as _baseFontName
from reportlab.rl_config import defaultPageSize

PAGE_WIDTH = defaultPageSize[0]
PAGE_HEIGHT = defaultPageSize[1]

paragraphStyle = ParagraphStyle(name='text',
                                fontName=_baseFontName,
                                fontSize=12,
                                leading=22,
                                firstLineIndent=40,
                                alignment=4,
                                strikeWidth=15
                                )

dateStyle = ParagraphStyle(name='date',
                           fontName=_baseFontName,
                           fontSize=12,
                           leading=22,
                           firstLineIndent=0,
                           alignment=2,
                           strikeWidth=15
                           )

coordStyle = ParagraphStyle(name='coord',
                            fontName=_baseFontName,
                            fontSize=10,
                            alignment=1,
                            strikeWidth=15
                            )

footerStyle = ParagraphStyle(name='footer',
                             fontName=_baseFontName,
                             fontSize=8,
                             alignment=1,
                             strikeWidth=15
                             )
