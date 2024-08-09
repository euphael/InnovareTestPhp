<?php
// Configurações de conexão ao banco de dados
$server = 'localhost';
$username = 'root';
$password = '';
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
    echo "<th>Erros</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        $errors = [];

        for ($i = 1; $i <= 16; $i++) {
            $coluna = 'v' . $i;
            echo "<td>" . $row[$coluna] . "</td>";
        }

        // Verifica se v15 e v16 são iguais
        if ($row['v15'] == $row['v16']) {
            $errors[] = 'Erro: v15 é a mesma resposta de v16.';
        }
        if ($row['v1'] == 2) {
            // Se v1 for 2, verifica se v2 a v6 são NULL
            for ($i = 2; $i <= 6; $i++) {
                $coluna = 'v' . $i;
                if (!is_null($row[$coluna])) {
                    $errors[] = 'Erro: v1 é 2, mas v' . $i . ' não é NULL';
                }
            }
        }
        if ($row['v1'] == 1 && is_null($row['v2'])) {
            // Se v1 for 1, verifica se v2 está preenchido
            $errors[] = 'Erro: v1 é 1, mas v2 não está preenchido.';
        }
        if ($row['v2'] == 2) {
            // Se v2 for 2, verifica se v3 a v6 são NULL
            for ($i = 3; $i <= 6; $i++) {
                $coluna = 'v' . $i;
                if (!is_null($row[$coluna])) {
                    $errors[] = 'Erro: v2 é 2, mas v' . $i . ' não é NULL';
                }
            }
        }
        if ($row['v2'] == 1) {
            // Se v2 for 1, verifica se v3 e v4 estão preenchidos
            if (is_null($row['v3']) || is_null($row['v4'])) {
                $errors[] = 'Erro: v2 é 1, mas v3 ou v4 não estão preenchidos.';
            }
        }
        if ($row['v4'] == 2 && !is_null($row['v5'])) {
            // Se v4 for 2, verifica se v5 é NULL
            $errors[] = 'Erro: v4 é 2, mas v5 não é NULL';
        }
        if ($row['v5'] == 1) {
            // Se v5 for 1, verifica se v6 e v7 são NULL
            for ($i = 6; $i <= 7; $i++) {
                $coluna = 'v' . $i;
                if (!is_null($row[$coluna])) {
                    $errors[] = 'Erro: v5 é 1, mas v' . $i . ' não é NULL';
                }
            }
        }
        if ($row['v5'] == 2 || $row['v5'] == 3) {
            // Se v5 for 2 ou 3, verifica se v6 está preenchido
            if (is_null($row['v6'])) {
                $errors[] = 'Erro: v5 é ' . $row['v5'] . ', mas v6 não está preenchido.';
            }
        }
        if ($row['v7'] == 2) {
            // Se v7 for 2, verifica se v8 e v9 são NULL
            for ($i = 8; $i <= 9; $i++) {
                $coluna = 'v' . $i;
                if (!is_null($row[$coluna])) {
                    $errors[] = 'Erro: v7 é 2, mas v' . $i . ' não é NULL';
                }
            }
        }
        if ($row['v8'] == 2) {
            // Se v8 for 2, verifica se v9 a v13 são NULL
            for ($i = 9; $i <= 13; $i++) {
                $coluna = 'v' . $i;
                if (!is_null($row[$coluna])) {
                    $errors[] = 'Erro: v8 é 2, mas v' . $i . ' não é NULL';
                }
            }
        }

        echo "<td>" . implode('<br>', $errors) . "</td>"; // Exibição das mensagens de erro acumuladas
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 Resultados";
}

// Fechando a conexão
$conn->close();
?>