 <?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

foreach (array_keys($_SESSION['carrinho']) as $chaveAntiga) {
    if (is_numeric($chaveAntiga)) {
        $chaveNova = 'produto_' . (int)$chaveAntiga;
        $_SESSION['carrinho'][$chaveNova] = $_SESSION['carrinho'][$chaveAntiga];
        unset($_SESSION['carrinho'][$chaveAntiga]);
    }
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao === 'add' || $acao === 'dell') {
    $tipo = (isset($_GET['tipo']) && $_GET['tipo'] === 'promocao')
        ? 'promocao'
        : 'produto';

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $chave = $tipo . '_' . $id;

    if ($id > 0 && $acao === 'add') {
        if (!isset($_SESSION['carrinho'][$chave])) {
            $_SESSION['carrinho'][$chave] = 1;
        } else {
            $_SESSION['carrinho'][$chave]++;
        }
    }

    if ($id > 0 && $acao === 'dell') {
        unset($_SESSION['carrinho'][$chave]);
    }
}

if ($acao === 'up' && isset($_POST['prod']) && is_array($_POST['prod'])) {
    foreach ($_POST['prod'] as $chave => $qtd) {
        if (preg_match('/^(produto|promocao)_([0-9]+)$/', (string)$chave)) {
            $qtd = (int)$qtd;

            if ($qtd > 0) {
                $_SESSION['carrinho'][$chave] = $qtd;
            } else {
                unset($_SESSION['carrinho'][$chave]);
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

foreach ($_SESSION['carrinho'] as $chave => $qtd) {
    if (!preg_match('/^(produto|promocao)_([0-9]+)$/', (string)$chave, $partes)) {
        continue;
    }

    $tipo = $partes[1];
    $id = (int)$partes[2];
    $qtd = (int)$qtd;

    if ($tipo === 'promocao') {
        $sql = "SELECT * FROM promocao WHERE id_promo = $id";
    } else {
        $sql = "SELECT * FROM produto WHERE id_prod = $id";
    }

    $result = $conexao->query($sql);
    $linha = $result ? $result->fetch_assoc() : null;

    if (!$linha) {
        unset($_SESSION['carrinho'][$chave]);
        continue;
    }

    $subtotal = $qtd * (float)$linha['preco'];

    echo '<tr>';
    echo '<td><img src="img/'.$linha['imagem'].'" width="100" height="100"></td>';
    echo '<td>'.number_format($linha['preco'], 2, ',', '.').'</td>';
    echo '<td align="center">
            <div class="form-group">
                <input type="number" class="form-control" min="1" max="1000"
                       name="prod['.$chave.']" value="'.$qtd.'">
            </div>
          </td>';
    echo '<td>'.number_format($subtotal, 2, ',', '.').'</td>';
    echo '<td><a href="carrinho.php?acao=dell&amp;tipo='.$tipo.'&amp;id='.$id.'">
            <img src="imagem/lix.png" width="50" height="50">
          </a></td>';

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