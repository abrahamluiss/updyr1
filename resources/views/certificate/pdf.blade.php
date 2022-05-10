<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Autores</title>
</head>
<style>
    body {
        background-image: url("https://blogger.googleusercontent.com/img/a/AVvXsEiq0ArH6BgpCmyXTAfDuF8Iw6uslyOQAfM2-9j5i-RfKe-mBWdNBeBoebPyygtIqik9dWSjL72RktggXkabjIuaNbOnMRjeg6XOGQD3unq6ggyNS1wWu_pDOYeae82mcftsNUB9JwK7_hBxtdY3fXfEbD5ygdFSpe5Xu8fV4KuICUeV-1TDhsrOW3s_Wg");
    }
    @page { size: A4; margin: 0; }

    #title { margin-top:30%;
    margin-left: 20%;
    }
    #titleh1{
        font-size: 30px;
        color: red;

    }
    #p1{
        margin-left: 10%;
        margin-right: 10%;
    }
    #titleDoc{
        font-weight: bold;
        color: red;
    }
    #presentado{
        margin-left: 10%;
        margin-top: -3%;

    }
    #fullName{
        font-weight: bold;
        color: red;
        margin-left: 35%;
        margin-top: -3%;
    }
    #parrafo2{
        margin-left: 10%;
        margin-right: 10%;
    }
    #asesor{
        color: red;
    }
    #table{
        margin-left: 35%;
        border: 1px solid;
        border-color: black;
    }
    #tr{
        color: red;

        border: 1px solid;
        border-color: black;
    }
    #td{
        color: red;

        border: 1px solid;
        border-color: black;
    }
    #adjunto{
        margin-left: 10%;
        margin-right: 10%;
    }
    #expire{
        margin-left: 50%;
    }
    #code{
        margin-left: 10%;
        margin-top: 10%;
        color: red;

    }
</style>

<body>
    <div id="title">
        <label id="titleh1"><i>CERTIFICADO DE ORIGINALIDAD</i></label>
    </div>
<p id="p1">Por medio de este documento de Originalidad el área de Repositorio Institucional de la Universidad Nacional de Huancavelica, certifica que el trabajo de investigación titulado: <label id="titleDoc">{{ $certificate->title }}</label></p>.<label></p> <p id="presentado">Presentado por</p>
<label id="fullName">{{ $certificate->authors->full_name }}</label>
<p id="parrafo2">
    Cuyo docente asesor es: <b id="asesor">{{ $certificate->advisers->full_name }}</b>. Con la finalidad de obtener el grado académico de <b id="asesor">{{ $certificate->program }}</b> en: <b id="asesor">{{ $certificate->faculty }}</b> el Repositorio Institucional hace saber que <b>es un trabajo de investigación original</b> y no ha sido presentado ni publicado en otras revistas científicas nacionales e internacionales ni en sitio o portal electrónico.
</p>
<p id="parrafo2">
    Por tanto, basándonos en el cumplimiento del Art.4 del Reglamento del Software Anti plagio de la UNH, el área de Repositorio Institucional de la Universidad Nacional de Huancavelica dictamina que este trabajo de investigación fue analizado por el software anti plagio TURNITIN y al estar dentro de los parámetros establecidos, esta investigación es aceptado como <b id="titleDoc">original</b>.
</p>
<table id="table">

  <tr id="tr">

    <td id="td">ORIGINALIDAD</td>

    <td id="td">SIMILITUD</td>

  </tr>

  <tr id="tr">

    <td id="td" class="text-center">{{ $certificate->originality }}%</td>

    <td id="td" class="text-center">{{ $certificate->similitude }}%</td>

  </tr>
</table>
<div id="adjunto">

    <label >ADJUNTO:</label>
    <ol type=”A”>
        <li>Captura de pantalla de la revisión del trabajo de investigación en el software anti plagio - TURNITIN.</li>
      </ol>
</div>
<div id=expire>

    El presente Certificado se expide el <b id="date">{{ \Carbon\Carbon::parse($certificate->created_at)->format('d-m-Y') }}</b>
</div>
<p id="code">
    Nº {{ str_pad($certificate->id,3,'0', STR_PAD_LEFT ) }}-{{ now()->year }}
</p>
</body>

</html>
