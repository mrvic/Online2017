<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ovo je moja prva php stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <h3>PHP zbroj</h3>

        <div style="color: crimson"> 
            <?php
            /*
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            echo "uskrs pada " . easter_days(2018) . " dana nakon 21.03..<br>";
            echo "uskrs za 2018 je " . easter_date(2018);
//echo date_format(easter_date(2018), "Y/m/d");

            echo "prvi txt" . " drugi" . " trećiphp";
            $var; //ovo je ok
            $VAR; //nečitljivo i rezervirano za konstante
//$12greska; // ne mozemo nazvati varijablu brojem
# linijski
// linijski
            /*
             * 
             * 
             * Blok komentar
             * */

            /**
             * ovo je rezervirano za dokumentaciju
             */
            $a = 5;
            $b = 7;
            $c = $a + $b;
            echo "<br>zbroj broja<br> " 
            . $a 
            . "</b> i broja " 
            . $b 
            . " </i> je " 
            . $c;
            ?>
            
        </div>
        <table>
            <tr>
                <td>123</td><td>344</td><td>345</td>
            </tr>
            <tr>
                <td>123</td><td>344</td><td>345</td>
            </tr>
            <tr>
                <td>123</td><td>344</td><td>345</td>
            </tr>
        </table>
        <hr>
        <ol>
            <li>prvi</li>
            <li>drugi</li>
            <li>treći</li>
        </ol>
        Ovo je neki inline text<br>
        novi red <br>
        jios jedan red <br>
        bez novog reda
        bio bi 
        kolaps
        sustava
        i tko bi to čitao?
        <!-- Ovo je komentar -->


    </body>
</html>


