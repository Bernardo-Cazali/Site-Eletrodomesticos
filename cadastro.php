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
<br>
 <br>
  <br>
<div class="container"> 
 
   <div class="panel-heading"><font color="#000000" face="Helvetica"><center>Sessão de Cadastro</center></font></div>
      <div class="panel-body">

  <form action="#" method="POST">
      <div class="form-group">
	  <div class="row">
	    <div class="col-sm-4"></div>
	    <div class="col-sm-4">
		<label for="primeiro">Nome</label>
		<input type="text" class="form-control" name="nome" maxlenght="100" placeholder="Insira um nome" required>
	  </div>
	  </div> 
	  <br>
	  <div class="form-group">
	  <div class="row">
	  <div class="col-sm-4"></div>
	    <div class="col-sm-4">
		<label for="email">Email:</label>
		<input type="text" class="form-control" name="email" maxlenght="100" placeholder="Insira seu email" required>
	  </div>
      </div>
	  <br>
	  <div class="form-group">
	  <div class="row">
	  <div class="col-sm-4"></div>
	  <div class="col-sm-4">
		<label for="senha">Senha:</label>
		<input type="password" class="form-control" name="senha" maxlenght="30" placeholder="Insira uma senha" required>
	  </div>
	  </div>
	  <br>
	  <div class="form-group">
	  <div class="row">
	  <div class="col-sm-4"></div>
	  <div class="col-sm-4">
		<label for="email">Cpf:</label>
		<input type="text" class="form-control" name="cpf" maxlength="14" placeholder="000.000.000/00" required>
	  </div>
	  </div>
	  <br>
	 
	<div class="row">
    <div class="col-sm-4">&nbsp</div>
    <div class="col-sm-2"><a href="login.php"><button type="button" class="btn btn-primary btn-block">Voltar</button></a>
	</div>
    <div class="col-sm-2"><a href="salvar.php"> <button type="submit" class="btn btn-primary btn-block">Salvar</button></a>
	</div>
    </div>
	</form>
	<br>
	
	<?php

	if($_POST)
	{
	include_once('conexao.php');
	$nome = $_POST ['nome'];
	$email = $_POST ['email'];
	$senha = md5 ($_POST ['senha']);
	$cpf = $_POST['cpf'];
	
	$sql = "insert into cliente(nome, email, senha, cpf)
	        values ('$nome', '$email', '$senha', '$cpf')";
			
	if ($result = $conexao -> query($sql))
	{
	echo '
	<div class="col-sm-4"></div>
	 <div class="col-sm-4">
	  <div class="alert alert-success text-center">
	<strong>Sucesso! </strong> Usuário Cadastrado com Sucesso<BR>
	  </div>
	</div>';
	header("refresh: 2; url = login.php");
	}
	else
	echo '
	<div class="col-sm-4"></div>
	 <div class="col-sm-4">
	  <div class="alert alert-danger text-center">
	<strong>Erro! </strong> Falha no Cadastro de Cliente
	  </div>
	</div>';
	$conexao->close();
	}
	?>	

</body>
</html>
