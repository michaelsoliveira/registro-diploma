<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['name'];

    if (!file_exists($file)) {
        die("Erro: Arquivo não encontrado.");
    }

    try {
        $pdo = new PDO(getenv('DATABASE_URL'),
                getenv('POSTGRES_USER'),
                getenv('POSTGRES_PASSWORD'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

        // Nome da tabela no banco de dados
        $tabela = "certificados";

        // Tenta usar o comando COPY para importação rápida
        try {
            $pdo->exec("COPY $tabela(
            nome_diplomado, 
            cpf_diplomado, 
            nome_codigo_emec_cs, 
            nome_codigo_emec_iep, 
            nome_codigo_emec_ird, 
            data_ingresso_curso, 
            data_conclusao_curso,
            data_expedicao_diploma,
            data_registro_diploma,
            identificacao_numero_expedicao,
            identificacao_numero_registro,
            numero_processo) FROM '$file' WITH CSV HEADER DELIMITER ';'");
            echo "Importação realizada com sucesso via COPY.";
        } catch (PDOException $e) {
            echo "Erro com COPY: " . $e->getMessage() . " Tentando INSERT...<br><br>";
            
            // Alternativa com INSERT se COPY não for permitido
            $handle = fopen($file, "r");
            if ($handle !== false) {
                $columns = fgetcsv($handle, 1000, ";");
                $columns[0] = preg_replace('/\x{FEFF}/u', '', $columns[0]);
                $table = "certificados";
                $columnsSql = implode(", ", $columns);
                $placeholders = implode(", ", array_fill(0, count($columns), "?"));
                $query = "INSERT INTO $table ($columnsSql) VALUES ($placeholders)";

                $stmt = $pdo->prepare($query);
                $dateColumns = ["data_ingresso_curso", "data_conclusao_curso", "data_expedicao_diploma", "data_registro_diploma"];
                $dataPadrao = "2000-01-01";
                while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                    foreach ($columns as $index => $coluna) {
                        // Se a coluna for do tipo DATE e o valor estiver vazio, definir a data padrão
                        if (in_array($coluna, $dateColumns) && (empty($data[$index]) || $data[$index] == "NULL")) {
                            $data[$index] = $dataPadrao;
                        }
                    }
                    $stmt->execute($data);
                }
                fclose($handle);
                echo "Importação realizada com sucesso via INSERT.";
            }
        }
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Importar CSV</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
