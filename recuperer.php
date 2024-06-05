<?php
    try {
        $linkpdo = new PDO("mysql:host={nom_hote};dbname={nom_db}", "{utilisateur}", "{mdp}");	
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
    if (empty($_POST['lastId'])){
        $res = $linkpdo->prepare('SELECT * FROM chat ORDER BY Id DESC LIMIT 10');
        $res->execute(array());
        while ($data = $res->fetch()) {
            $message[]=$data[4];
            $auteur[]=$data[3];
            $heure[]=$data[2];
            $date[]=$data[1];
            $id[]=$data[0];
        }
        for($i = count($id)-1 ; $i >= 0 ; $i=$i-1){
                    echo ("<table class="."'msg'"."id=".$id[$i].">
                        <tr>
                            <td><img id="."'image'"." src="."'images/correspondant.png'"." alt="."'correspondant'"."/></td>
                                <td id="."'boite'".">".$message[$i]."
                            </td>
                        </tr>
                        </table>
                        <table id="."'metadata'".">
                            <tr>
                                <td>Le ".$date[$i]." à ".$heure[$i]." - ".$auteur[$i]."</td>
                            </tr>
                        </table>");
                
        }
    } else {
        $res = $linkpdo->prepare('SELECT * FROM chat ORDER BY Id DESC LIMIT 10');
        $res->execute(array());
        while ($data = $res->fetch()) {
            $message[]=$data[4];
            $auteur[]=$data[3];
            $heure[]=$data[2];
            $date[]=$data[1];
            $id[]=$data[0];
        }
        for($i = count($id)-1 ; $i >= 0 ; $i=$i-1){
            if ($id[$i]>$_POST['lastId']){
                 echo ("<table class="."'msg'"."id=".$id[$i].">
                <tr>
                    <td><img id="."'image'"." src="."'images/correspondant.png'"." alt="."'correspondant'"."/></td>
                        <td id="."'boite'".">".$message[$i]."
                    </td>
                </tr>
                </table>
                <table id="."'metadata'".">
                    <tr>
                        <td>Le ".$date[$i]." à ".$heure[$i]." - ".$auteur[$i]."</td>
                    </tr>
                </table>");
            }       
        }
    }
    
    $res->closeCursor();
?>