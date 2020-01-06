<table>
    <thead>
    <tr>
        <td>Username</td>
        <td>Password</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($decoded_array as $input_data => $row): ?>
        <tr>
            <?php foreach($row as $value): ?>
                <td><?php print $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>