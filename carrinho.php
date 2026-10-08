 <?php
  date_default_timezone_set('America/Sao_Paulo'); 
  session_start(); 
  if(!isset($_SESSION['carrinho'])){ 
     $_SESSION['carrinho'] = array(); 
  } 
  
  if(isset($_GET['acao'])){ 
  
    if($_GET['acao'] == 'add'){ 
      $id = $_GET['id']; 
      if(!isset($_SESSION['carrinho'][$id]))
        $_SESSION['carrinho'][$id] = 1; 
      else  
        $_SESSION['carrinho'][$id] += 1; 
      } 
	
	if($_GET['acao']=='dell') {
		$id = $_GET['id']; 
		 unset($_SESSION['carrinho'][$id]);
		}
	 
    if($_GET['acao'] == 'up'){ 
	 if(isset($_POST['prod']))
      if(is_array($_POST['prod']))
	  { 
        foreach($_POST['prod'] as $id => $qtd){
            if(!empty($qtd) || $qtd <> 0)
              $_SESSION['carrinho'][$id] = $qtd;
            else
              unset($_SESSION['carrinho'][$id]);    
        }
      }
    }  
   }              
   
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Untitled Document</title>
</head>
<body>

<div class = "container">
<br>
 <br>
<?php
include_once('conexao.php');
  
  echo '
  <div class="panel panel-primary">
  <div class="panel-heading"><center>Carrinho de Produtos</center></div>
  <div class="panel-body">
  <table class="table table-striped">
	    <thead>
		<tr>
		<td>Produto</td>
		<td>Valor</td>
		<td>Quantidade</td>
		<td>Subtotal</td>
		<td>Remover</td>
		</tr>
		</thead>
		<tbody>';
echo '<form action="?acao=up" method="post">';
$total = 0;
foreach($_SESSION['carrinho'] as $id => $qtd)
{

 echo '<tr>';
 $sql = "select * from produto where id_prod = $id";
 $result = $conexao -> query($sql);
 $linha = $result -> fetch_assoc();
 $subtotal = $qtd * $linha['preco'];
 
 echo '<td><img src="img/'.$linha['imagem'].'" widht="100px" height="100px"></td>';
 echo '<td>'.number_format($linha['preco'], 2, ',' , '.').'</td>';
 
 echo '<td align="center">
				      <div class="form-group">	
					  <input type="number" class="form-control" min="1" max="1000" name="prod['.$id.']" value="'.$qtd.'" >
					  </div>
	   </td>';
 
 echo '<td>'.number_format($subtotal, 2, ',' , '.').'</td>';
 echo '<td><a href = ?acao=dell&id='.$linha['id_prod'].'> <img src="imagem/lix.png" widht="50px" height="50px"></a></td>';	
 $total += $subtotal;
 echo '</tr>';
}
 echo '<tr>';
 echo '<td>Total</td>';
 echo '<td></td>';
 echo '<td></td>';
 echo '<td>'.number_format($total, 2, ',' , '.').'</td>';
 echo '<td></td>';
      '</tr>';
	  
echo'<tr>';
				echo'<td colspan="2">';
				echo'<a href="inicio.php"><button type="button" class="btn btn-primary btn-block">Continuar Comprando</button></a>';
				echo'</td>';
				echo'<td colspan="6">';
				echo'<button type="submit" class="btn btn-primary btn-block">Atualizar Carrinho</button>';
				echo'</td>';
				echo'</tr>';
				echo'</tbody>';
				echo'</table>';
				echo '</form>   
	   
        </div>
          </div>'; 

	   echo '<div class="panel panel-primary">
	   
						  <div class="panel-heading text-center">Opção de Pagamento</div>
						  <div class="panel-body">						  
						  <form action="finalizar.php" method="post">
							  <div class="form-group">
								  <label for="sel1">Forma de Pagamento:</label>
								  <select class="form-control" name="forma">
									<option value="CARTAO MASTERCARD">CARTAO MASTERCARD</option>
									<option value="CARTAO VISA">CARTAO VISA</option>
									<option value="PIX">PIX</option>
									<option value="BOLETO">BOLETO</option>
									<option value="DEPOSITO">DEPOSITO</option>
								  </select>
								</div>							
							  <button type="submit" class="btn btn-primary btn-block">Finalizar Venda</button>
						  </form>';					  
						    
						    	  
 $conexao->close();
?>
</body>
</html>