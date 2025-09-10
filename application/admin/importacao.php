<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $tmpName = $_FILES['csv_file']['tmp_name'];

    // Converte para UTF-8
    $conteudo = file_get_contents($tmpName);
    $conteudoUtf8 = mb_convert_encoding($conteudo, 'UTF-8', 'ISO-8859-1');
    file_put_contents($tmpName, $conteudoUtf8);

    if (!file_exists($tmpName)) {
        die("Erro: Arquivo não encontrado.");
    }

    try {
        $pdo = new PDO(getenv('DATABASE_URL'),
                getenv('POSTGRES_USER'),
                getenv('POSTGRES_PASSWORD'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

        $tabela = "certificados";

        $handle = fopen($tmpName, "r");
        if ($handle !== false) {
            $columns = fgetcsv($handle, 1000, ";");
            $columns[0] = preg_replace('/\x{FEFF}/u', '', $columns[0]);

            $columnsSql   = implode(", ", $columns);
            $placeholders = implode(", ", array_fill(0, count($columns), "?"));
            $query = "INSERT INTO $tabela ($columnsSql) VALUES ($placeholders)";
            $stmt = $pdo->prepare($query);

            $dateColumns = ["data_ingresso_curso", "data_conclusao_curso", "data_expedicao_diploma", "data_registro_diploma"];
            $dataPadrao  = "2000-01-01";

            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $data = array_pad($data, count($columns), null); // garante que todas colunas existam
                foreach ($columns as $index => $coluna) {
                    if (in_array($coluna, $dateColumns)) {
                        $valor = trim($data[$index]);

                        if (empty($valor) || strtoupper($valor) === "NULL") {
                            // usa data padrão
                            $data[$index] = $dataPadrao;
                        } else {
                            // converte de DD/MM/YYYY → YYYY-MM-DD
                            $dt = DateTime::createFromFormat("d/m/Y", $valor);
                            if ($dt !== false) {
                                $data[$index] = $dt->format("Y-m-d");
                            } else {
                                // se não conseguir converter, define padrão para evitar erro
                                $data[$index] = $dataPadrao;
                            }
                        }
                    }
                }
                $stmt->execute($data);
            }
            fclose($handle);

            echo "Importação realizada com sucesso via INSERT.";
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
