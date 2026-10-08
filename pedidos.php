<?php
session_start();
?>
   <!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container center-block"> 
     

     <?php
	
	 if (isset($_GET['id']))
	 {
		if($_SESSION['id'] <>  $_GET['id'])
		header("location: encerrar.php");
	 }
	 
	     include_once("conexao.php");
		 $sql = 'SELECT * FROM cliente where id='.$_GET['idcliente'];
		 $result = $conexao ->query($sql);
		 $linha  = $result ->fetch_assoc();
		 $codigo = $linha['id'];
		 $nome   = $linha['nome'];	 
     ?>
     <p><br>
     <h2><center>Cliente: <?php echo $codigo.' - '.$nome; ?></center> </h2>
     <p><br>
    
     <?php
	   
	     $sql = 'SELECT * FROM vendas where id_cliente='.$_GET['idcliente'];
		 $result = $conexao ->query($sql);
		 while ($linha  = $result ->fetch_assoc())
		 {
		 echo '<h3>'.$linha['id_ve'].' - '.$linha['total_nota'].' - Forma Pagamento: '.$linha['forma_pgto'].'<p>';	
		 $sql_item = "SELECT
					 *
				FROM
					  vendas_item,
					  produto
				where
					  id_produto = id_prod and
					  id_venda = ".$linha['id_ve']."
				order by id_venda";
				
				
				
				$result_item = $conexao ->query($sql_item);
				
				 while ($linha_item  = $result_item ->fetch_assoc())
				 {
					 echo '<img src="img/'.$linha_item['imagem'].'" width="100px" height="100px">'.
					      'Nome: '.$linha_item['nome'].' - '.
					      'Preço: '.$linha_item['preco_unitario'].' - '.
					      'Quantidade: '.$linha_item['quantidade'].' - '.
					      'Total: '.$linha_item['total_item'].'<br>';
				 }
		          echo '<center>---------------------------------------------------</center>';
		 	
		 }
	 ?>
	
</div>

</body>
</html>