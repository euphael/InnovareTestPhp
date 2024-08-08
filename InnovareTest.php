<?php
// Configurações de conexão ao banco de dados
$server = 'localhost';
$username = 'root'; // Substitua pelo seu nome de usuário do banco de dados
$password = ''; // Deixe vazio se o banco de dados não tiver senha
$database = 'innovare_virtual_v2';

// Conectando ao banco de dados
$conn = new mysqli($server, $username, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
    die('Não foi possível conectar: ' . $conn->connect_error);
}

echo 'Conexão bem-sucedida<br>';

// Select sql
$sql = "SELECT * FROM questionario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th>";
    for ($i = 1; $i <= 16; $i++) {
        echo "<th>v$i</th>";
    }
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        for ($i = 1; $i <= 16; $i++) {
            $coluna = 'v' . $i;
            echo "<td>" . $row[$coluna] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 Resultados";
}

// Fechando a conexão
$conn->close();
?>