
	
<?php
$DesdeLetra = "a";
$HastaLetra = "z";
$DesdeNumero = 0;
$HastaNumero = 9;
$letra_num=null;
$codigo=null;
for ($i=0; $i < 8; $i++) { 
	$letra_num=rand(0, 100);
    if($letra_num%2==0){
      $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
      $codigo=$codigo."".$letraAleatoria;
    }else{
      $numeroAleatorio = rand($DesdeNumero, $HastaNumero);
      $codigo=$codigo."".$numeroAleatorio;
    }

} 
echo "<strong>El codigo generado es:</strong> ".$codigo."<br/>";

 
?>