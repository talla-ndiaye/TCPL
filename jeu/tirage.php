<?php
    $selection=trim($_POST["selection"]);
    $numeros=explode(" ",$selection);
    $tirage=array();
    for($i=0;$i<6;$i++){
        do{
            $tr=mt_rand(1,49);
        }
        while(in_array($tr,$tirage));
        $tirage[]=$tr;
    }
    $bon=0;
    for($i=0;$i<6;$i++){
        if(in_array($tirage[$i],$numeros))
            $bon++;
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Jeu de loterie</title>
		<meta charest="UTF-8" />
		<link rel="stylesheet" href="css/style.css?t=<?php echo time()?>" />
		<meta name="viewport" content="width=device-width" />
	</head>
	<body>
		<h1>Tirage</h1>
        <h2>Numéros joués</h2>
        <?php for($i=0;$i<6;$i++) { ?>
            <div class="numeros"><?php echo $numeros[$i] ?></div>
        <?php } ?>
        <h2>Résultat du tirage</h2>
        <?php for($i=0;$i<6;$i++) { ?>
            <div class="numeros" id="<?php echo $i?>">0</div>
        <?php } ?>
        <h2 id="resultat">Vous avez eu <span><?php echo $bon?></span> bon(s) numéro(s)</h2>
        <script>
            document.body.onload=function(){
                num="<?php echo $selection?>".split(" ");
                res="<?php echo implode(" ",$tirage)?>".split(" ");
                i=0;
                j=0;
                tirer();
            }
            function tirer(){
                t=setTimeout("tirer()",40);
                if(j<res[i]){
                    j++;
                    document.getElementById(i).innerHTML=j;
                }
                else{
                    if(num.indexOf(res[i])!=-1){
                        document.getElementById(i).style.borderColor="#EA2";
                        document.getElementById(i).style.backgroundColor="#EA2";
                        document.getElementById(i).style.color="#000";
                    }
                    j=0;
                    if(i<5)
                        i++;
                    else{
                        clearTimeout(t);
                        document.getElementById("resultat").style.visibility="visible";
                    }
                }
            }
        </script>
	</body>
</html>
