
<table id="products" border="1">
    <thead>
       <tr>
            <th>Code</th>
            <th>Désignation</th>
            <th>Prix Unitaire</th>
            <th>stock</th>
       </tr>
    </thead>
    <tbody>
       <?php foreach($products as $product): ?>
        <tr>
            <td><? echo $product['code'] ?></td>
            <td><? echo $product['désignation'] ?></td>
            <td><? echo $product['prix unitaire'] ?></td>
            <td><? echo $product['stock'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>