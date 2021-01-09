<?php

require_once('dbc.php');

// $dbc = new Dbc();
$blogData = getAllBlog();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>
<body>
    <h2>ブログ一覧</h2>
    <p><a href="/blog_app/form.html">新規作成</a></p>
    <table>
    <tr>
        <th>NO.</th>
        <th>タイトル</th>
        <th>カテゴリ</th>
    </tr>
    <?php foreach($blogData as $column):?>
    <tr>
        <td><?php echo $column['id'] ?></td>
        <td><?php echo $column['title'] ?></td>
        <td><?php echo setCategoryName($column['category']) ?></td>
        <td><a href="/blog_app/detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
    </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>