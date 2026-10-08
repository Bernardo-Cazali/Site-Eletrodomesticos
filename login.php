<?php
 session_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>
</title>
</head>
<body>

<P>
<div class="container"> 
 <br>
  <br>
   <br>
    <br>
     <br>
      <br>
       <br>

   <div class="panel-heading"><font color="#000000" face="Helvetica"><center>Sessão de login</center></font></div>
   <div class="panel-body">
 
  <p>  
  <div class="col-sm-12">
  <form action="#" method="post">
    <div class="form-group">
	 <div class="row">
	  <div class="col-sm-4"></div>	
      <div class="col-sm-4">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  placeholder="Informe o E-mail" name="email" required>
	  </div>
	 </div>
	</div>  
    <div class="form-group">
	 <div class="form-group">
	  <div class="row">
	   <div class="col-sm-4 "></div>	
       <div class="col-sm-4">
      <label for="pwd">Senha:</label>
      <input type="password" class="form-control" placeholder="Informe a Senha" name="senha" required>
      </div>
	 </div>
	</div>
    <p>
    
  	<div class="row">
    <div class="col-sm-4">&nbsp</div>
    <div class="col-sm-2"><a href="inicio.php"><button type="button" class="btn btn-primary btn-block">Voltar</button></a>
	</div>
    <div class="col-sm-2"><button type="submit" class="btn btn-primary btn-block">Logar</button>
	</div>
    </div>

	<div class="row">
	<div class="col-sm-4">&nbsp</div>	
    <div class="col-sm-1"><u><h6><a href="cadastro.php">cadastrar</a><h6></u>
    </div>
    </div>
    </form>
	</div>
	
    <P>
	<?php
	if($_POST)
	{
	include_once('conexao.php');
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$sql = "select
	id,
				 nome
			from 
				 cliente
			where
				 email = '$email' and
				 senha = '$senha'";
	if($result = $conexao -> query($sql))
	{
	 	if($result->num_rows>0)
		{
		 $linha = $result->fetch_assoc();
		 $nome = $linha ['nome'];
		 $_SESSION['nome'] = $nome;
		 $_SESSION['id'] = $linha['id'];
		 echo '
		 <div class="col-sm-4"></div>
	     <div class="col-sm-4">
		 <div class="alert alert-success text-center">
         <strong>Sucesso! </strong> Usuário Logado com Sucesso<BR>
		 </div>
		 </div>';
		 header("refresh: 4; url=inicio.php");
		}
		else
		echo '
	    <div class="col-sm-4"></div>
	    <div class="col-sm-4">
	    <div class="alert alert-danger text-center">
  		<strong>Erro! </strong> Usuário e/ou Senha Inv�lido
		</div>
		</div>';
		}
	$conexao -> close();	
	} 
	
	?>	
</div>
</body>
</html>