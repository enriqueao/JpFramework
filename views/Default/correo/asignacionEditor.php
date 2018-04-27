<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Invitación Editor Plataforma Investigadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0; font-family: 'segoe-ui', sans-serif;">
    <table border-collapse="collapse" align="center" cellpadding="0" cellspacing="0" width="600">
        <tr>
            <td align="center" bgcolor="#0075DB" height="100" style="padding: 30px 0 30px 0; display: flex; justify-content: space-around;">
                <img src="<?=IMG?>logo.png" alt="unescoLogo" width="130"/>
                <img src="<?=IMG?>PHI.png" alt="" width="100">
                <img src="<?=IMG?>aqua-lac.png" alt="" width="250">
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 0px 30px 30px 30px;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.2);">
                            <h2>Hola, <?=$data['nombre'].' '.$data['apellidoPaterno'].' '.$data['apellidoMaterno']?></h2>
                        </td>
                    </tr>
                    <br><br><br>
                    <tr>
                        <td style="padding: 30px 10px 30px 10px;">
                            Bienvenido has sido asignado con el Cargo de Editor, a partir de ahora podras realizar asignaciones de articulos
                            <p style="color: rgba(0, 0, 0, 0.5); margin-top: 50px;">Este correo ha sido generado de manera automática, favor de no responderlo</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#0075DB" style="padding: 10px; color: white; text-align: right;">
                Plataforma de Investigadores | UNESCO
            </td>
        </tr>
    </table>
</body>
</html>
