<?php
 // Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : "";
	$rg = (isset($_POST["rg"]) && $_POST["rg"] != null) ? $_POST["rg"] : "";
	$email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
	$maritial_status = (isset($_POST["maritial_status"]) && $_POST["maritial_status"] != null) ? $_POST["maritial_status"] : "";
	$birth_date = (isset($_POST["birth_date"]) && $_POST["birth_date"] != null) ? $_POST["birth_date"] : "";
	$gender = (isset($_POST["gender"]) && $_POST["gender"] != null) ? $_POST["gender"] : "";
    $obs = (isset($_POST["obs"]) && $_POST["obs"] != null) ? $_POST["obs"] : NULL;
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
	$cpf = NULL;
	$rg = NULL;
	$email = NULL;
	$maritial_status = NULL;
	$birth_date = NULL;
	$gender = NULL;
    $obs = NULL;
}
 try {
    $conexao = new PDO("mysql:host=localhost; dbname=crud", "teste", "teste102030");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try { 
	if ($id != "") {
		$stmt = $conexao->prepare("UPDATE people SET nome=?, cpf=?, rg=?, email=?, maritial_status=?, birth_date=?, gender=?, obs=? WHERE id = ?");
		$stmt->bindParam(9, $id);
	}
    else{    $stmt = $conexao->prepare("INSERT INTO people (nome, cpf, rg, email, maritial_status, birth_date, gender, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	}
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $rg);
        $stmt->bindParam(3, $cpf);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $maritial_status);
		$stmt->bindParam(6, $birth_date);
        $stmt->bindParam(7, $gender);
		$stmt->bindParam(8, $obs);
         
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
				$rg = null;
                $cpf = null;
                $email = null;
                $maritial_status = null;
                $birth_date = null;
                $gender = null;
				$obs = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
} 
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {	
        $stmt = $conexao->prepare("SELECT * FROM people WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $rg = $rs->rg;
            $cpf = $rs->cpf;
			$email = $rs->email;
            $maritial_status = $rs->maritial_status;
            $birth_date = $rs->birth_date;
            $gender = $rs->gender;
			$obs = $rs->obs;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Pessoas</title>
    </head>
    <body>
        <form action="?act=save" method="POST" name="form1" >
            <h1>Cadastro de Pessoas</h1>
            <hr>
            <input type="hidden" name="id" <?php
            // Preenche o id no campo id com um valor "value"
            if (isset($id) && $id != null || $id != "") {
                echo "value=\"{$id}\"";
            }
            ?> />
            Nome:
            <input type="text" name="nome" <?php
            // Preenche o nome no campo nome com um valor "value"
            if (isset($nome) && $nome != null || $nome != ""){
                echo "value=\"{$nome}\"";
            }
            ?> />
			CPF:
            <input type="text" name="cpf" <?php
            // Preenche o cpf no campo cpf com um valor "value"
            if (isset($cpf) && $cpf != null || $cpf != ""){
                echo "value=\"{$cpf}\"";
            }
            ?> />
			RG:
            <input type="text" name="rg" <?php
            // Preenche o rg no campo rg com um valor "value"
            if (isset($rg) && $rg != null || $rg != ""){
                echo "value=\"{$rg}\"";
            }
            ?> />
            E-mail:
            <input type="text" name="email" <?php
            // Preenche o email no campo email com um valor "value"
            if (isset($email) && $email != null || $email != ""){
                echo "value=\"{$email}\"";
            }
            ?> />
            Estado Civil:
            <input type="text" name="maritial_status" <?php
            // Preenche o maritial_status no campo maritial_status com um valor "value"
            if (isset($maritial_status) && $maritial_status != null || $maritial_status != ""){
                echo "value=\"{$maritial_status}\"";
            }
            ?> />
			Data de Nascimento:
            <input type="date" name="birth_date" <?php
            // Preenche a data no campo birth_date com um valor "value"
            if (isset($birth_date) && $birth_date != null || $birth_date != ""){
                echo "value=\"{$birth_date}\"";
            }
            ?> />
			Gênero:
            <input type="text" name="gender" <?php
            // Preenche o genero no campo gender com um valor "value"
            if (isset($gender) && $gender != null || $gender != ""){
                echo "value=\"{$gender}\"";
            }
            ?> />
			Obs:
            <input type="text" name="obs" <?php
            // Preenche o obs no campo obs com um valor "value"
            if (isset($obs) && $obs != null || $obs != ""){
                echo "value=\"{$obs}\"";
            }
            ?> />
           <input type="submit" value="salvar" />
           <input type="reset" value="Novo" />
           <hr>
        </form>
		<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>RG</th>
        <th>CPF</th>
        <th>E-mail</th>
		<th>Estado Civil</th>
        <th>Data de Nasc</th>
        <th>Gênero</th>
        <th>Obs</th>
    </tr>
	<?php
try {
 
    $stmt = $conexao->prepare("SELECT * FROM people");
 
        if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>".$rs->nome."</td><td>".$rs->rg."</td><td>".$rs->cpf."</td><td>".$rs->email."</td><td>"
						   .$rs->maritial_status."</td><td>".$rs->birth_date."</td><td>".$rs->gender."</td><td>".$rs->obs
                           ."</td><td><center><a href=\"?act=upd&id=" . $rs->id ."\">[Alterar]</a>"
                           ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                           ."<a href=\?act=del&id=" . $rs->id . "\">[Excluir]</a></center></td>";
                echo "</tr>";
            }
        } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
?>
</table>
    </body>
</html>