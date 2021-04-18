<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- saved from url=(0036)https://dompdf.net/test/demo_01.html -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <style type="text/css">
        /* Notes
-----------------------------------------------------------------------*/
        .note_form {
            display: none;
        }


        /* Page
        -----------------------------------------------------------------------*/
        .page {
            background-color: white;
            padding: 20px;
            font-size: 0.7em;
            margin-bottom: 15px;
            margin-right: 5px;
        }

        .page table.header td h1 {
            margin: 0px;
        }

        .page table.header {
            border-bottom: 1px solid black;
        }

        .page h1 {
            text-align: center;
            color: black;
            font-style: normal;
            font-size: 2em;
        }

        .page h2 {
            text-align: center;
            color: black;
        }

        .page h3 {
            color: black;
            font-size: 1em;
        }

        .page p {
            text-align: justify;
            font-size: 1em;
        }

        .page em {
            font-weight: bold;
            font-style: normal;
            text-decoration: underline;
            margin-left: 1%;
            margin-right: 1%;

        }

        .money_table {
            width: 85%;
            margin-left: auto;
            margin-right: auto;
        }

        .money {
            text-align: right;
            padding-right: 20px;
        }

        .money_field {
            text-align: right;
            padding: 0px 15px 5px 15px;
            font-weight: bold;
        }

        .total_label {
            border-top: 2px double black;
            font-weight: bold;
        }

        .total_field {
            border-top: 2px double black;
            text-align: right;
            padding: 0px 15px 5px 15px;
            font-weight: bold;
        }

        .written_field {
            border-bottom: 0.1pt solid black;
        }

        .page .indent * { margin-left: 4em; }

        .checkbox {
            border: 1px solid black;
            padding: 1px 2px;
            font-size: 7px;
            font-weight: bold;
        }

        table.fax_head {
            width: 100%;
            font-weight: bold;
            font-size: 1.1em;
            border-bottom: 1px solid black;
        }

        /* Sales-agreement specific
        -----------------------------------------------------------------------*/
        table.sa_signature_box {
            margin: 2em auto 2em auto;
        }

        table.sa_signature_box tr td {
            padding-top: 1.5em;
            vertical-align: top;
            white-space: nowrap;
        }

        .special_conditions {
            font-style: italic;
            margin-left: 2em;
            white-space: pre;
            font-weight: bold;
        }

        .page h2 {
            text-align: left;
        }

        /* Default style definitions */

        @page {
            margin: 0.25in;
        }

        /* General
        -----------------------------------------------------------------------*/
        body {
            background-color: transparent;
            color: black;
            font-family: "verdana", "sans-serif";
            margin: 0px;
            padding-top: 0px;
            font-size: 1em;
        }

        @media print {
            p { margin: 2px; }
        }

        h1 {
            font-size: 1.1em;
            font-style: italic;
        }

        h2 {
            font-size: 1.05em;
        }

        img {
            border: none;
        }

        pre {
            font-family: "verdana", "sans-serif";
            font-size: 0.7em;
        }

        ul {
            list-style-type: circle;
            list-style-position: inside;
            margin: 0px;
            padding: 3px;
        }

        li.alpha {
            list-style-type: lower-alpha;
            margin-left: 15px;
        }

        p {
            font-size: 0.8em;
        }

        a:link,
        a:visited {
            /* font-weight: bold;  */
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: underline;
        }

        #body {
            padding-bottom: 2em;
            padding-top: 5px;
        }

        #body pre {
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        #money {
            text-align: right;
            padding-right: 20px;
        }

        /* Footer
        -----------------------------------------------------------------------*/
        #footer {
            color: black;
        }

        #copyright {
            padding: 5px;
            font-size: 0.6em;
            background-color: white;
        }

        #footer_spacer_row {
            width: 100%;
        }

        #footer_spacer_row td {
            padding: 0px;
            border-bottom: 1px solid #000033;
            background-color: #F7CF07;
            height: 2px;
            font-size: 2px;
            line-height: 2px;
        }

        #logos {
            padding: 5px;
            float: right;
        }

        /* Section Header
        -----------------------------------------------------------------------*/
        #section_header {
            text-align: center;
        }

        #job_header {
            text-align: left;
            background-color: white;
            margin-left: 5px;
            padding: 5px;
            border: 1px dashed black;
        }

        #job_info {
            font-weight: bold;
        }

        .header_details td {
            font-size: 0.6em;
        }

        .header_label {
            padding-left: 20px;
        }

        .header_field {
            padding-left: 5px;
            font-weight: bold;
        }

        /* Content
        -----------------------------------------------------------------------*/
        #content {
            padding: 0.2em 1% 0.2em 1%;
            min-height: 15em;
        }

        .page_buttons {
            text-align: center;
            margin: 3px;
            font-size: 0.7em;
            white-space: nowrap;
            font-weight: bold;
            width: 74%;
        }

        .link_bar {
            font-size: 0.7em;
            text-align: center;
            margin: auto;
            /*  white-space: nowrap; */
        }

        .link_bar a {
            white-space: nowrap;
            font-weight: bold;
        }

        .page_menu li {
            margin: 5px;
            font-size: 0.8em;
        }

        /* Detail
        -----------------------------------------------------------------------*/
        .detail_table {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 3px;
            margin: 15px;
        }

        .detail_head td {
            background-color: #ddd;
            color: black;
            font-weight: bold;
            padding: 3px;
            font-size: 0.75em;
            text-align: center;
        }

        .detail_label {
            padding: 3px;
            font-size: 0.75em;
            width: 16%;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
            background-color: #ddd;
        }

        .detail_field {
            width: 33%;
            font-size: 0.8em;
            text-align: center;
            padding: 3px;
        }

        .detail_sub_table {
            font-size: 1em;
        }

        .detail_spacer_row td {
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            background-color: #999;
            font-size: 2px;
            line-height: 2px;
        }

        #narrow {
            width: 50%;
        }

        .operation {
            width: 1%;
        }

        .summary_spacer_row {
            font-size: 0.1em;
        }

        .bar {
            border-top: 1px solid black;
        }

        /* Forms
        -----------------------------------------------------------------------*/
        .form {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            margin-top: 10px;
        }

        .form td {
            padding: 3px;
        }

        .form th, .form_head td {
            background-color: #ddd;
            border-bottom: 1px solid black;
            color: black;
            padding: 3px;
            text-align: center;
            font-size: 0.65em;
            font-weight: bold;
        }

        .form_head a:link,
        .form_head a:visited {
            color: black;
        }

        .form_head a:hover {
        }

        .sub_form_head td {
            border: none;
            font-size: 0.9em;
            white-space: nowrap;
        }

        .form input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
            font-size: 1em;
        }

        .form textarea {
            color: black;
            background-color: white;
            border: 1px solid black;
            font-size: 1em;
        }

        .form select {
            color: black;
            background-color: white;
            font-size: 1em;
        }

        .button, a.button {
            color: black;
            background-color: white;
            border: 1px solid black;
            font-weight: normal;
            white-space: nowrap;
            text-decoration: none;
        }

        a.button {
            display: inline-block;
            text-align: center;
            padding: 2px;
        }

        a.button:hover {
            text-decoration: none;
            color: black;
        }

        .form_field {
            color: black;
            background-color: white;
            font-size: 0.7em;
        }

        .form_label {
            color: black;
            background-color: #ddd;
            font-size: 0.7em;
            padding: 3px;
        }

        /*
        .form_foot {
          background-color: #E5D9C3;
          font-size: 0.6em;
        }
        */

        .form_foot td {
            background-color: #ddd;
            border-bottom: 1px solid black;
            color: black;
            padding: 3px;
            text-align: center;
            font-size: 0.65em;
            font-weight: bold;
        }

        .form_foot a:link,
        .form_foot a:visited {
            color: black;
        }

        .form_foot a:hover {
            color: black;
        }

        .no_border_input input {
            border: none;
        }

        .no_wrap {
            white-space: nowrap;
        }

        tr.row_form td {
            white-space: nowrap;
        }

        /* Wizards
        -----------------------------------------------------------------------*/
        .wizard {
            font-size: 0.8em;
            border-top: 1px solid black;
        }

        #no_border {
            border: none;
        }

        .wizard p {
            text-indent: 2%;
        }

        .wizard td {
            padding: 3px;
            /*  padding-left: 3px;
              padding-right: 3px;
              padding-bottom: 3px;*/
        }

        .wizard input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
        }

        .wizard textarea {
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .wizard select {
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .wizard_head {
            color: black;
            font-weight: bold;
        }

        .wizard_buttons {
            border-top: 1px solid black;
            padding-top: 3px;
        }

        .wizard_buttons a {
            background-color: white;
            border: 1px solid black;
            padding: 2px 3px 2px 3px;
        }

        /* List
        -----------------------------------------------------------------------*/
        .list_table,
        .notif_list_table {
            color: black;
            padding-bottom: 4px;
            background-color: white;
        }

        .list_table td,
        .notif_list_table td {
            padding: 3px 5px 3px 5px;
        }

        .list_table input {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
        }

        .list_head,
        .notif_list_head {
            font-weight: bold;
            background-color: #ddd;
            font-size: 0.65em;
        }

        .list_head td,
        .notif_list_head td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            color: black;
            text-align: center;
            white-space: nowrap;
        }

        .list_head a:link,
        .list_head a:visited,
        .notif_list_head a:link,
        .notif_list_head a:visited {
            color: black;
        }

        .list_head a:hover,
        .notif_list_head a:hover {
        }

        .list_foot {
            font-weight: bold;
            background-color: #ddd;
            font-size: 0.65em;
        }

        .list_foot td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            color: black;
            text-align: right;
            white-space: nowrap;
        }

        .sub_list_head td {
            border: none;
            font-size: 0.7em;
        }

        .odd_row td {
            /* background-color: #EDF2F7;
              border-top: 2px solid #FFFFff;*/
            background-color: transparent;
            border-bottom: 0.9px solid #ddd; /* 0.9 so table borders take precedence */
        }

        .even_row td {
            /*  background-color: #F8EEE4;
              border-top: 3px solid #FFFFff;*/
            /*background-color: #f6f6f6;
            border-bottom: 0.9px solid #ddd;*/
            border-bottom: 0.9px solid #ddd;
        }

        .spacer_row td {
            line-height: 2px;
            font-size: 2px;
        }

        .phone_table td {
            border: none;
            font-size: 0.8em;
        }

        div.notif_list_text {
            margin-bottom: 1px;
            font-size: 1.1em;
        }

        .notif_list_row td.notif_list_job {
            text-align: center;
            font-weight: bold;
            font-size: 0.65em;
        }

        .notif_list_row td.notif_list_dismiss table td {
            text-align: center;
            font-size: 1em;
            border: none;
            padding: 0px 2px 0px 2px;
        }

        .notif_list_row td {
            padding: 5px 5px 7px 5px;
            border-bottom: 1px dotted #ddd;
            background-color: white;
            font-size: 0.6em;
        }

        .notif_list_row:hover td {
            background-color: #ddd;
        }

        /* Page
        -----------------------------------------------------------------------*/
        .page {
            border: none;
            padding: 0in;
            margin-right: 0.1in;
            margin-left: 0.1in;
            /*margin: 0.33in 0.33in 0.4in 0.33in; */
            background-color: transparent;
        }

        .page table.header h1{
            font-size: 12pt;
        }

        .page>h2,
        .page>p {
            margin-top: 2pt;
            margin-bottom: 2pt;
        }

        .page h2 {
            page-break-after: avoid;
        }

        .money_table {
            border-collapse: collapse;
            font-size: 6pt;
        }

        /* Tree
        -----------------------------------------------------------------------*/
        .tree_div {
            display: none;
            background-color: #ddd;
            border: 1px solid #333;
        }

        .tree_div .tree_step_bottom_border {
            border-bottom: 1px dashed #8B9DBE;
        }

        .tree_div .button, .tree_row_table .button,
        .tree_div .no_button {
            width: 110px;
            font-size: 0.7em;
            padding: 3px;
            text-align: center;
        }

        .headt td {
            height: 15px;
        }


        /*
        .tree_div .button a, .tree_row_table .button a {
          text-decoration: none;
          color: #114C8D;
        }
        */

        .tree_row_desc {
            font-weight: bold;
            font-size: 0.7em;
            text-indent: -10px;
        }

        .tree_row_info {
            font-size: 0.7em;
            width: 200px;
        }

        .tree_div_head a,
        .tree_row_desc a {
            color: #000033;
            text-decoration: none;
        }

        .tree_div_head {
            font-weight: bold;
            font-size: 0.7em;
        }

        /* Summaries
        -----------------------------------------------------------------------*/
        .summary {
            border: 1px solid black;
            background-color: white;
            padding: 1%;
            font-size: 0.8em;
        }

        .summary h1 {
            color: black;
            font-style: normal;
        }

        /* Sales-agreement specific
        -----------------------------------------------------------------------*/
        table.sa_signature_box {
            /*margin: 2em auto 0 auto;*/
        }

        table.sa_signature_box tr td {
            padding-top: 1.25em;
            vertical-align: top;
            white-space: nowrap;
        }

        .special_conditions {
            font-style: italic;
            margin-left: 2em;
            white-space: pre;
        }

        .sa_head * {
            font-size: 7pt;
        }

        /* Change order specific
        -----------------------------------------------------------------------*/
        table.change_order_items {
            font-size: 8pt;
            width: 100%;
            border-collapse: collapse;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        table.change_order_items>tbody {
            border: 1px solid black;
        }

        table.change_order_items>tbody>tr>th {
            border-bottom: 1px solid black;
        }

        table.change_order_items>tbody>tr>td {
            border-right: 1px solid black;
            padding: 0.5em;
        }

        td.change_order_total_col {
            padding-right: 4pt;
            text-align: right;
        }

        td.change_order_unit_col {
            padding-left: 2pt;
            text-align: left;
        }
    </style>
</head>

<body>

<div id="body">

    <div id="section_header">
        <table style="width: 100%;" class="header">
            <tbody>
            <tr>
                <td><h1 style="text-align: left"><img height="80" class="logo-name" src="{{ asset('images/logos/logo.png') }}" alt=""></h1></td>
                <td><h1 style="text-align: right"><img height="80" class="logo-name" src="{{ asset('images/logos/fcme.png') }}" alt=""></h1></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="content">

        <div class="page" style="font-size: 7pt">

            <table style="width: 100%; font-size: 8pt;">
                <tbody>
                <tr>
                    <td colspan="3"><h1 style="text-align: left">ORDEN DE COMPRA No. <span style="color:red;">{{$orderinfo['ORDNUMERO']}}</span></h1></td>
                </tr>
                <tr>
                    <td colspan="3">Fecha de la Orden: <strong>{{$orderinfo['ORDFECHA1']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="3">Apellidos y Nombres del cliente: <strong>{{$orderinfo['CTOCLIENTELASTNAMES']}} {{$orderinfo['CTOCLIENTEFIRSTNAMES']}}</strong></td>
                    <td colspan="1">No. Cédula cliente: <strong>{{$orderinfo['CTOCLIENTENDOCUMENTO']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="3">Dirección domiciliar del cliente: <strong>{{$orderinfo['CTODIRECCION']}}</strong></td>
                    {{--<td colspan="1">No: <strong>N-45-89</strong></td>
                    <td colspan="2">Calle Secundaria: <strong>LEOPOLDO CHAVEZ</strong></td>--}}
                </tr>
                {{--
                <tr>
                    <td colspan="3">Referencia del domicilio: <strong>Frente a casas de pedro</strong></td>
                </tr>--}}
                <tr>
                    <td colspan="3">Teléfonos del cliente: <strong>{{$orderinfo['CTOTELEFONOS']}}</strong></td>
                    {{--<td colspan="1">Celular1: <strong>0988388743</strong></td>
                    <td colspan="1">Celular2: <strong>0995036321</strong></td>
                    <td colspan="1">Convencional:<strong> 0988388743 </strong></td>--}}
                </tr>
                <tr>
                    <td colspan="5">Correo electrónico del cliente: <strong>{{$orderinfo['CTOCLIENTECORREO']}}</strong></td>
                </tr>
                {{--
                <tr>
                    <td colspan="3">Nombre de la institución en la que trabaja: <strong>Escuela Tarqui</strong></td>
                </tr>
                <tr>
                    <td colspan="2">Dirección de la institución: <strong>MARIA ANGELICA HIDROVO</strong></td>
                    <td colspan="1">No: <strong>N-45-89</strong></td>
                    <td colspan="2">Calle Secundaria: <strong>LEOPOLDO CHAVEZ</strong></td>
                </tr>--}}
                <tr>
                    <td colspan="1">Provincia: <strong>{{$orderinfo['CTOCLIENTEPRO']}}</strong></td>
                    <td colspan="1">Cantón: <strong>{{$orderinfo['CTOCLIENTECAN']}}</strong></td>
                    <td colspan="1">Parroquía: <strong>{{$orderinfo['CTOCLIENTEPAR']}}</strong></td>
                </tr>
                <tr>
                    <td>Plazo del crédito: <strong>{{$orderinfo['ORDPLAZO']}} Meses</strong></td>
                </tr>

                </tbody></table>

            <table class="change_order_items" style="width: 100%">
                <tbody>
                <tr>
                    <th colspan="1">Código <br> Producto</th>
                    <th colspan="1">Marca</th>
                    <th colspan="2">Descripción</th>
                    <th colspan="1">Cantidad</th>
                    <th colspan="1">Precio U.</th>
                    <th colspan="1">Precio Total</th>
                </tr>
                @foreach ($orderinfo['products'] as $producto)
                    <tr class="even_row headt">
                        <td colspan="1" style="text-align: center; width: 10%;">{{$producto['SKU']}}</td>
                        <td colspan="1" style="text-align: center; width: 10%;">{{$producto['BRAND']}}</td>
                        <td colspan="2" style="text-align: center; width: 40%;">{{$producto['DESCRIPTION']}}</td>
                        <td colspan="1" style="text-align: center; width: 10%;">{{$producto['QUANTITY']}}</td>
                        <td colspan="1" class="change_order_unit_col" style="text-align: right; width: 10%;">{{$producto['PRICE']}}</td>
                        <td colspan="1" class="change_order_total_col" style="text-align: right; width: 10%;">{{$producto['TOTAL']}}</td>
                    </tr>
                @endforeach
                {{--
                @for ($i = 0; $i <= 12; $i++)
                <tr class="even_row headt">
                    <td colspan="1" style="text-align: center; width: 10%;"></td>
                    <td colspan="1" style="text-align: center; width: 10%;"></td>
                    <td colspan="2" style="text-align: center; width: 40%;"></td>
                    <td colspan="1" style="text-align: center; width: 10%;"></td>
                    <td colspan="1" class="change_order_unit_col" style="text-align: right; width: 10%;"></td>
                    <td colspan="1" class="change_order_total_col" style="text-align: right; width: 10%;"></td>
                </tr>
                @endfor--}}
                </tbody>
                <tbody><tr>
                    <td colspan="4" style="text-align: left;">Notas: <strong>{{$orderinfo['ORDNOTAS']}}</strong></td>
                    <td colspan="2" style="text-align: right;"><strong>SubTotal:</strong></td>
                    <td class="change_order_total_col"></td></tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" style="text-align: right;"><strong>IVA 12%:</strong></td>
                    <td class="change_order_total_col"></td></tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" style="text-align: right;"><strong>IVA 0%:</strong></td>
                    <td class="change_order_total_col"></td></tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2" style="text-align: right;"><strong>Total:</strong></td>
                    <td class="change_order_total_col">${{$orderinfo['ORDTOTAL']}}</td></tr>
                </tbody></table>

            <table class="sa_signature_box">
                <tbody>
                <tr>
                    <td colspan="5"><b>DIBUJAR EL CROQUIS DE UBICACIÓN DEL LUGAR DONDE SE ENTREGARÁN LOS PRODUCTOS AL REVERSO DE ESTA HOJA</b></td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="2" class="written_field"><span>Firma del Comprador/a</span><br><br><img src="{{$orderinfo['signatureCliente']}}" width="250" height="100"></td>
                    <td rowspan="3" colspan="1"></td>
                    <td rowspan="2" colspan="2" class="written_field"><span>Firma del Intermediario Comercial</span><br><br><img src="{{$orderinfo['signatureAsesor']}}" width="250" height="100"></td>
                </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>



</body></html>