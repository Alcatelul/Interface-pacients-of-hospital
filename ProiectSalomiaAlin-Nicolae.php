<html lang="ro">
    <head>
        <title>Aplicatie pentru gestiunea pacientilor unui spital</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

		<script type="text/javascript">
            $(document).ready( function() {

                /* afisare denumire fisier XML*/
                var xml = document.getElementById("xml_file");
                $("#xml_file").change(function(){
                    $("#xml_file_name").html(xml.files[0].name);
                });

                /* afisare denumire fisier XSL*/
                var xsl = document.getElementById("xsl_file");
                $("#xsl_file").change(function(){
                    $("#xsl_file_name").html(xsl.files[0].name);
                });
            });

            /* functie buton Parsare*/
            function parseXml() {
                $("#view_table").hide();
                $("#view_parsed_content").show();
            }

            /* functie buton Afisare tabel*/
            function viewTable() {
                $("#view_table").show();
                $("#view_parsed_content").hide();
            }
        </script>
    </head>
    <body>
        <div>
            <div>
                <span>Aplicatie pentru gestionarea pacientilor unui spital</span>
            </div>
            <!-- Formular upload fisiere-->
            <form method="post" enctype="multipart/form-data">
                <div>
                    <h4> Alege XML-ul:</h4>
                    <div id="xml_file_name">
                        <?php if (isset($_FILES['xml_file']['name']) && $_FILES['xml_file']['name'] != '' && preg_match('/^.*\.xml$/i', $_FILES['xml_file']['name']) == 1 ) {
                            echo $_FILES['xml_file']['name'];
                        }?>
                    </div>
                    <label>
                       
                        <input type="file" accept=".xml" name="xml_file" id="xml_file"/>

                    </label>
                </div>
                <div>
                    <h4>Alege XSL-ul:</h4>
                    <div  id="xsl_file_name">
                        <?php if (isset($_FILES['xsl_file']['name']) && $_FILES['xsl_file']['name'] != '' && preg_match('/^.*\.xsl$/i', $_FILES['xsl_file']['name']) == 1 ) {
                            echo $_FILES['xsl_file']['name'];
                        }?>
                    </div>
                    <label >

                        <input type="file" accept=".xsl" name="xsl_file" id="xsl_file"/>

                    </label>
                </div>
                <div>
                    <h4>Upload fisiere</h4>
                    <button type="submit" name="upload_files">Upload</button>
                </div>
            </form>

            <!-- buton pentru vederea tabelului -->
            <div id="view_xml" style="display: none;">
                <h4>&nbsp;&nbsp;Vizualizeaza tabelul dat prin intermediul XSL:</h4>
                <button type="submit"  name="view_xml"  onclick="viewTable();">Afisare Tabel</button>
            </div>

            <!-- buton parsare  XML -->
            <div id="parse_xml" style="display: none;">
                <h4 >&nbsp;&nbsp;Parseaza XML-ul:</h4>
                <button type="button"  name="parse_xml" onclick="parseXml();">Parsare</button>
            </div>

            <!-- Verificarea fisierelor -->
            <?php
                if (isset($_POST['upload_files'])) {
                   
                    /* Daca incarcarea are loc fara erori fara erori: */
                    if ($_FILES['xml_file']['name'] != '' &&
                        $_FILES['xsl_file']['name'] != '' &&
                        preg_match('/^.*\.xml$/i', $_FILES['xml_file']['name']) == 1 &&
                        preg_match('/^.*\.xsl$/i', $_FILES['xsl_file']['name']) == 1) {
                           
                        ?>
                        <!-- Afisare  butoanele de vizualizare-->
                        <script type="text/javascript">
                            $("#view_xml").show();
                            $("#parse_xml").show();
                        </script>

                        <!-- Afisarea tabelului -->
                        <div id="view_table" style="display: none;">
							<?php 
							  /* incarcare XML,incarcare XSL,procesare XSL si afisare tabel */
							  $xmlDoc = new DOMDocument();
                              $xmlDoc->load($_FILES['xml_file']['tmp_name']);
                              
							  $xslDoc = new DOMDocument();
							  $xslDoc->load($_FILES['xsl_file']['tmp_name']);
					
							  $proc = new XSLTProcessor();
							  $proc->importStylesheet($xslDoc);
					  
							  echo $proc->transformToXML($xmlDoc);
							  ?>
                        </div>

                        <!-- Afisare continut parsat -->
                        <div id="view_parsed_content" style="display: none;">
                            <?php
                                /* parsare continut fisier xml  */
                                $xml=simplexml_load_file($_FILES['xml_file']['tmp_name']) or die("Error: Cannot create object");
                                  /* Afisare XML parsat sub o forma bruta */
                                echo '<pre>' . var_export($xml, true).'</pre>'; exit;
                            ?>
                        </div>
                    <?php
                    }
                }
            ?>
        </div> 
    </body>
</html>