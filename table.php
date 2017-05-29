<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        
                <table id="example" class="display"  >
 <thead id="cucc">
                <tr>
                    <th>Kötet</th>
                    <th>Megye</th>
                    <th>Település</th>
                    <th>Évszám</th>
                    <th>Hivatkozás</th>
                    <th>Adat</th>
                    <th>Helyfajta</th>
                    <th>SZTA megjegyzés</th>
                    <th>Egyéb megjegyzés</th>
                    <th>Nem magyar névváltozat</th>
                </tr>
            </thead>
                       <thead id="real">
                <tr>
                    <th>Kötet</th>
                    <th>Megye</th>
                    <th>Település</th>
                    <th>Évszám</th>
                    <th>Hivatkozás</th>
                    <th>Adat</th>
                    <th>Helyfajta</th>
                    <th>SZTA megjegyzés</th>
                    <th>Egyéb megjegyzés</th>
                    <th>Nem magyar névváltozat</th>
                    <th style="display:none">Sorszám</th>
                    <th style="display:none">Szélesség</th>
                    <th style="display:none">Hosszúság</th>
                    <th style="display:none">1913-as név</th>
                    <th style="display:none">Mai településnév</th>
                    <th style="display:none">Nem magyar név</th>
                </tr>
            </thead>
           
        </table>

        <input type="button" id="startMap" name="getAllPlace" value="Találatok megjelenítése"></input>
        <input type="button" id="export" name="export" value="Exportálás Excelbe"></input>
        <input type="button" id="removeInputValues" name="removeInputValues" value="Keresőmezők törlése"></input>
        <h3>Találatok térképen</h3>
        <div id="map"></div>
           <script src="./js/table.js"></script>
            

