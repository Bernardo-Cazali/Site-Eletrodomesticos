<?php 
 date_default_timezone_set('America/Sao_Paulo');
  session_start(); 
  if(!isset($_SESSION['carrinho'])){ 
    $_SESSION['carrinho'] = array(); 
  }   
  
  if(!isset($_SESSION['id'])){  
		header("location: login.php");
		exit;
    } 
  
    ?>
   <!DOCTYPE html>
<html lang="br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Untitled Document</title>
</head>
    <body>
          <div class="container">
    
       
     <?php
        if(count($_SESSION['carrinho']) == 0){
          echo '<br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">		
                <div class="panel panel-primary">
                <div class="panel-heading"><center>Nota da Compra</center></font></div>
                <div class="panel-body">';
          echo '<center><h2>N?o h? produto no carrinho.</h2></center>';
          echo '<center><img src="imagem/triste.png" width="100px" height="100px"/></center>';
          echo '</div>
                </div>
                </div>
                </div>';
		  header('refresh:3; url=inicio.php');
          } else {
					 	require_once("conexao.php");
						$total = 0;
					    $data = date("Y-m-d");
						$hora = date("H:i:s");				 	
					 
					  if (!empty($_POST["forma"])) 
						 $forma_pgto = $_POST["forma"];    
					   else
						 $forma_pgto = '';
                                
				   $id_cliente = $_SESSION['id'] ;
                   $sql_vendas = "insert into vendas(data_emissao, forma_pgto,id_cliente) values ('$data', '$forma_pgto', $id_cliente);";				   			    
				   $result     = $conexao->query($sql_vendas);  
				   
				
				   $idvenda    = $conexao -> insert_id;   
             
                $total_qtd = 0;
                foreach($_SESSION['carrinho'] as $id => $qtd)
				{
                        $sql   = "SELECT *  FROM produto WHERE id_prod= $id";
                        $qr    = $conexao->query($sql);
                        $ln    = $qr ->fetch_assoc();
                        $id_produto  = $ln['id_prod'];  
                        $preco_unitario = $ln['preco'];                      
                        $total_item   = $preco_unitario * $qtd;// TOTAL DO ITEM
                        $total_qtd   += $qtd;
                        //$total_qtd   = $total_qtd + $qtd;
                        $total       +=  $total_item;
//inser??o
                       
						$sql = "insert into vendas_item (id_produto, quantidade,preco_unitario, id_venda, total_item) values (
						$id_produto, $qtd, $preco_unitario, $idvenda, $total_item)";
						
						$qr    = $conexao ->query($sql);
      
                }

$sql = "update vendas set total_nota = $total, numero_itens = $total_qtd where id_ve = $idvenda";
                        
						$qr    = $conexao ->query($sql);
						
						unset($_SESSION['carrinho']);

echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';	
echo '<div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">';					
echo '<div class="panel panel-primary">
      <div class="panel-heading"><center>Nota da Compra</center></font></div>
      <div class="panel-body">';

echo "<h2> Compra Realizada Com Sucesso!<br>Compra N?mero: $idvenda</h2><br>";
echo '<center><font color="#006400"><h4>Total da Compra: R$ '.number_format($total, 2, ',', '.').'</h4></center><br>';
echo '<a href=pedidos.php?idcliente='. $id_cliente.'><button type="submit" class="btn btn-primary btn-block"> Meus Pedidos </button></a>';
               
echo '</div>
      </div>';              
          }
                   ?>
     


 
</body>
</html>