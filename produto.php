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
<P>
<div class="container"> 
 
   <div class="panel panel-primary">
   <div class="panel-heading">Cadastro de Produto</div>
   <div class="panel-body">

  <form action="#" enctype="multipart/form-data" method="POST">
    <div class="form-group">
      <label for="arquivo">Produto</label>
      <input type="file" class="form-control" name="arquivo" accept="image/*" required>
    </div>
    <div class="form-group">
      <label for="descri��o">Nome</label>
      <input type="text" class="form-control" name="nome" required>
    </div>
	<div class="form-group">
	<label for="valor">Valor:</label>
	<input type="text" class="form-control" name="valor" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 13 || event.charCode == 44" required>
	</div>
  <a href="inicio.php"><button type="button" class="btn btn-primary"> Voltar </button></a>	
  <button type="submit" class="btn btn-primary"> Cadastar Produto </button>		
  </form>
  
  </div>
   </div>
    </div>

<p><br />

<?php
if ($_POST)
{
	include_once('conexao.php');
	$uploaddir = 'img';
	
	if(!file_exists($uploaddir))
	mkdir($uploaddir);
	
	$uploaddir = 'img/';
	
	$nome = $_POST['nome'];
	
	$valor = str_replace(",",".",$_POST['valor']);
	$image = $_FILES['arquivo']['name'];
	
	$uploadfile = $uploaddir . $image;
	if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile))
	{
		$sql = "insert into produto(nome, preco, imagem) values ('$nome',$valor,'$image')";
		
		if ($conexao->query($sql))
	{
		echo '<div class="alert alert-sucess text-center">
		<strong>sucesso!</Strong> Produto cadastrado com Sucesso.<br> Arquivo: '.$image.'
		</div>';
	}
	else
			echo "Houve um erro ao inserir no banco de dados.<br>".$conexao ->error;
	}
	else
		echo "Houve um problema no upload do arquivo.<br>";
	$conexao ->close();	
}
?>
</div>

</body>
</html>