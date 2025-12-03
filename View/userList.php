<section>
    <h1>Utilisateurs</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        <?php if (!empty($users)):
            foreach ($users as $u): ?>
                <tr>
                    <td><?php echo htmlspecialchars($u['id']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($u['firstName']); ?></td>
                </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="4">Aucun utilisateurs</td>
            </tr>
        <?php endif; ?>
    </table>
</section>