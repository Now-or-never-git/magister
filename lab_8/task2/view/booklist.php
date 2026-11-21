<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Бібліотека MVC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f4f4f4;
        }

        img {
            max-width: 60px;
            height: auto;
            display: block;
        }

        form {
            margin-bottom: 15px;
        }

        input[type="text"] {
            padding: 6px;
            width: 280px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Каталог книг</h2>

    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Пошук за назвою або автором..."
            value="<?php echo htmlspecialchars($searchQuery ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">Знайти</button>
        <a href="index.php"><button type="button">Скинути</button></a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Обкладинка</th>
                <th>Назва</th>
                <th>Автор</th>
                <th>Країна</th>
                <th>Рік</th>
                <th>Сторінок</th>
                <th>Короткий опис</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <img src="images/<?php echo htmlspecialchars($book->getCoverPhoto()); ?>"
                                alt="<?php echo htmlspecialchars($book->getTitle()); ?>">
                        </td>
                        <td>
                            <a href="index.php?id=<?php echo $book->getId(); ?>">
                                <b><?php echo htmlspecialchars($book->getTitle()); ?></b>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($book->getAuthor()->getFullName()); ?></td>
                        <td><?php echo htmlspecialchars($book->getAuthor()->getCountry()); ?></td>
                        <td><?php echo $book->getPublishYear(); ?></td>
                        <td><?php echo $book->getPages(); ?></td>
                        <td><?php echo htmlspecialchars($book->getShortDescription()); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Книг за вашим запитом не знайдено.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>