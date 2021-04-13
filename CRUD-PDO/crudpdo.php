<?php
try {
// Conectando ao banco    
    $pdo = new PDO("mysql:dbname=crudpdo;host=localhost","root","");
    echo "<h2 style=color:green>Conectado!<br></h2>";  
//dbname
//host
//usuario e senha
}catch (Exception $e){
//Se der erro apresente
    echo "Erro no banco de dados: ".$e->getMessage();
}
//-------------------------- INSERT -----------------------------
// criar variaveis para ficar mais facil de cadastrar no banco
//Existe duas formas de inserir
// primeira Forma

$nome ="Junior";
$telefone = "5565253426";
$email = "pepetro@gmail.com";
//Inserindo os valores no banco
$sql =$pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");

$sql->bindValue(":n",$nome);
$sql->bindValue(":t",$telefone);
$sql->bindValue(":e",$email);
$sql->execute();
echo "<h2>Usuario $nome cadastrado com sucesso!<br></h2>";
// Segunda Forma de inserir pela query

$pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES ('Joana', '00000', 'joanamaria@gmail.com')");

// --------------------------------- DELETE ------------------------

$sql =$pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$sql->bindValue(":id",7);
$sql->execute();
echo "<h2>Usuario deletado do banco!<br></h2>";

//------------------------------- UPDATE -----------------------------

$sql =$pdo->prepare("UPDATE pessoa SET nome = :n  WHERE id = :id");
$sql->bindValue(":n","Gustavo");
$sql->bindValue(":id",3);
$sql->execute();
echo "<h2>Usuario alterado com sucesso!<br></h2>";

//--------------------------- SELECT ---------------------------------

$sql =$pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$sql->bindValue(":id",1);
$sql->execute();
$resultado = $sql->fetch(PDO::FETCH_ASSOC);
echo "<h2>Informações do usuário!<br></h2>";
foreach ($resultado as $key => $value) {
    //echo $key. ": ".$value."<br>";
    echo "<fieldset style=width:175px><p style=font-size:25px;> $key : $value <p></fieldset>";
}
/*
//Função para trasformar informações que vem do banco em um array
//Quando vem apenas um registro
echo "<h2>Informações do usuário!<br></h2>";
echo "<pre>";
$resultado = $sql->fetch(PDO::FETCH_ASSOC);
echo "<br>";
//Função para verificar a estruturado array
print_r($resultado);
echo "<pre>";
////$sql->fetchall();*/

?>