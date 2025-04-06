<div>
    <h2>Sales</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>User ID</th>
                    <th>Unit price</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $s):?>
                    <tr><?= $s['salesID']?></tr>
                    <tr><?= $s['productID'] . "-" . $s['title'] ?></tr>
                    <tr><?= $s['userID'] ?></tr>
                    <tr><?= $s['unitPrice'] ?></tr>
                    <tr><?= $s['amount'] ?></tr>
                    <tr><?= $s['total'] ?></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>