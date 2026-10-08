<?php
	session_start();
?>
<html>
<head>
<title>
</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<div class = "container">
<div id="raio">
<img src="imagem/r2.png" width="110px" height="110px"/>
</div>

<div id="colorw">
<width="100px" height="100px">
</div>

<div id="carrinho">
<a href="carrinho.php"><img src="imagem/ss.png" width="100px" height="100px"/></a>
</div>

<div id="barra">
<form action="#" method="get">
<input type="text" class="form-control" id="volta" placeholder="Pesquisar" name="produto">
</form>
</div>

<div id="elemax">
<h1> ELEMAX <h1>
</div>

<div id="cabecalho">
<ul>
 <li><a href="inicio.php"> Início </a></li>
 <li><a href="#"> Produtos </a>
  <ul>
  <li><a href="menu.php"> Melhores Ofertas </a></li>
  </li>
  </ul>
  
  <?php
  if(isset($_SESSION['nome']))
  echo '<li><a href="encerrar.php">Olá, '.$_SESSION['nome'].' (Sair)</a></li>';
  else
  echo '<li><a href="login.php"><img src="imagem/login.png" width="60px" height="40px"/></a></li>';
  ?>
</ul>
</div>

<table class="table" align="center" width="100%">
<tdody>
<?php
 include_once("conexao.php");
 if(isset($_GET['promocao']))
 
 $produto = $_GET['promocao'];
 else
 $produto='';
 $sql = "select * from promocao where nome like '%$produto%' order by rand()";
 
 $result = $conexao -> query($sql);
 $linha = 1;
  
 echo '<tr>';
 while($row = $result->fetch_assoc())
 {
 echo '<td align="center">';
 echo '<br>';
 echo '<h3><font color="#0000ff" face="Georgia">'.$row['nome'].'</font></h3><br>';
 echo '<img id="imagem-produto-'.$row['id_promo'].'" src="img/'.$row['imagem'].'" width="150" height="150" />';
 echo '<br><font color="#FF0000"> R$ '.number_format($row['preco'], 2, ',', '.').'</font>';
 echo '<a href="carrinho.php?acao=add&id='.$row['id_promo'].'"><br>
     <img src="imagem/mais.png" widht="15px" height="35px"></a>';
     echo '<br>';
       echo '<br>';
	 echo '</td>';
	 if ($linha==3)
	 {
	 $linha = 0;
	 echo '</tr><tr>';
	 }
	 $linha++;
	 }
	 $conexao ->close();
?>
<P>
<table>

<div id="info">
 <h4>Fique ligado nas redes socias!<h4>
</div>

<div id="logo">
<img src="imagem/facebook.png" width="50px" height="50px"/>
<img src="imagem/instagram.png" width="50px" height="50px"/>
<img src="imagem/twiter.png" width="50px" height="50px"/>
</div>

<div id="sobre">
<a href="sobre.html"> <img src="imagem/exclamacao.png" width="50px" height="50px"/></a>
</div>

<div id="rodape">
</div>

<script src="js.js"> </script>
</table>
</body>
</html>

