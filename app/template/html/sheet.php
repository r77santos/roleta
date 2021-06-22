<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bioma4me</title>
    </head>
    <body>
        <table border="1">
            <?php foreach(@$rows as $row): ?>
                <tr>
                    <td><?php echo $row['nome'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['telefone'] ?></td>
                    <td><?php echo $row['celular'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['created'])) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>